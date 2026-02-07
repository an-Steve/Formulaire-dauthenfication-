<?php
session_start();
header('Content-Type: application/json');

// Configuration de la base de données
require_once 'config.php';

// Fonction pour se connecter à la base de données
function getConnection() {
    try {
        $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        die(json_encode([
            'success' => false, 
            'message' => 'Erreur de connexion à la base de données',
            'error' => $e->getMessage()
        ]));
    }
}

// Récupération de l'action
$action = isset($_POST['action']) ? $_POST['action'] : '';

// ----------------------
// CONNEXION
// ----------------------
if ($action === 'login') {

    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($username) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Veuillez remplir tous les champs']);
        exit;
    }

    try {
        $conn = getConnection();

        // Recherche de l'utilisateur (insensible à la casse)
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE LOWER(username) = LOWER(:username)");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Vérification du mot de passe
            if (password_verify($password, $user['password'])) {
                // Connexion réussie
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                echo json_encode(['success' => true, 'message' => 'Connexion réussie !']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Mot de passe incorrect']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Identifiant introuvable']);
        }

    } catch(PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Erreur lors de la connexion',
            'error' => $e->getMessage()
        ]);
    }
}

// ----------------------
// INSCRIPTION
// ----------------------
elseif ($action === 'register') {

    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($username) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Veuillez remplir tous les champs']);
        exit;
    }

    // Validation du nom d'utilisateur
    if (strlen($username) < 3) {
        echo json_encode(['success' => false, 'message' => 'L\'identifiant doit contenir au moins 3 caractères']);
        exit;
    }

    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        echo json_encode(['success' => false, 'message' => 'L\'identifiant ne peut contenir que des lettres, chiffres et underscores']);
        exit;
    }

    // Validation du mot de passe
    if (strlen($password) < 6) {
        echo json_encode(['success' => false, 'message' => 'Le mot de passe doit contenir au moins 6 caractères']);
        exit;
    }

    try {
        $conn = getConnection();

        // Vérifier si l'utilisateur existe déjà (insensible à la casse)
        $stmt = $conn->prepare("SELECT id FROM users WHERE LOWER(username) = LOWER(:username)");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->fetch()) {
            echo json_encode(['success' => false, 'message' => 'Cet identifiant est déjà utilisé']);
            exit;
        }

        // Hachage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insertion du nouvel utilisateur
        $stmt = $conn->prepare("INSERT INTO users (username, password, created_at) VALUES (:username, :password, NOW())");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Compte créé avec succès !']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de la création du compte']);
        }

    } catch(PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Erreur lors de la création du compte',
            'error' => $e->getMessage()
        ]);
    }
}

// ----------------------
// ACTION INVALIDE
// ----------------------
else {
    echo json_encode(['success' => false, 'message' => 'Action non valide']);
}

// ----------------------
// Id :admin / mdp  : password / https://an-steve.github.io/Formulaire-dauthenfication-/
// ----------------------
?>

