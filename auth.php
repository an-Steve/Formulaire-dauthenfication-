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
    
    // AMÉLIORATION : Limite maximale pour éviter les abus
    if (strlen($username) > 30) {
        echo json_encode(['success' => false, 'message' => 'L\'identifiant ne peut pas dépasser 30 caractères']);
        exit;
    }
    
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        echo json_encode(['success' => false, 'message' => 'L\'identifiant ne peut contenir que des lettres, chiffres et underscores']);
        exit;
    }
    
    // AMÉLIORATION : Validation du mot de passe renforcée (8 caractères minimum + complexité)
    if (strlen($password) < 8) {
        echo json_encode(['success' => false, 'message' => 'Le mot de passe doit contenir au moins 8 caractères']);
        exit;
    }
    
    // AMÉLIORATION : Vérifier la complexité du mot de passe
    if (!preg_match('/[a-z]/', $password)) {
        echo json_encode(['success' => false, 'message' => 'Le mot de passe doit contenir au moins une minuscule']);
        exit;
    }
    
    if (!preg_match('/[A-Z]/', $password)) {
        echo json_encode(['success' => false, 'message' => 'Le mot de passe doit contenir au moins une majuscule']);
        exit;
    }
    
    if (!preg_match('/[0-9]/', $password)) {
        echo json_encode(['success' => false, 'message' => 'Le mot de passe doit contenir au moins un chiffre']);
        exit;
    }
    
    if (!preg_match('/[@$!%*?&#]/', $password)) {
        echo json_encode(['success' => false, 'message' => 'Le mot de passe doit contenir au moins un caractère spécial (@$!%*?&#)']);
        exit;
    }
    
    try {
        $conn = getConnection();
        
        // Vérifier si l'utilisateur existe déjà (insensible à la casse)
        $stmt = $conn->prepare("SELECT id FROM users WHERE LOWER(username) = LOWER(:username)");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        
        if ($stmt->fetch()) {
            echo json_encode(['success' => false, 'message' => 'Cet identifiant est déjà utilisé']);
            exit;
        }
        
        // AMÉLIORATION : Hachage du mot de passe avec ARGON2ID ou BCRYPT renforcé
        if (defined('PASSWORD_ARGON2ID')) {
            $hashedPassword = password_hash($password, PASSWORD_ARGON2ID, [
                'memory_cost' => 65536,  // 64 MB
                'time_cost' => 4,
                'threads' => 3
            ]);
        } else {
            // Fallback : BCRYPT avec coût élevé si ARGON2ID non disponible
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        }
        
        // Insertion du nouvel utilisateur
        $stmt = $conn->prepare("INSERT INTO users (username, password, created_at) VALUES (:username, :password, NOW())");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Compte créé avec succès !']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de la création du compte']);
        }
        
    } catch(PDOException $e) {
        // AMÉLIORATION : Ne jamais exposer les détails techniques en production
        error_log("Erreur inscription: " . $e->getMessage());
        echo json_encode([
            'success' => false,
            'message' => 'Erreur lors de la création du compte'
            // RETIRÉ : 'error' => $e->getMessage() pour la sécurité
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
// Id :admin / mdp  : password
//Id : Stevetest / mdp : Steve05@ 

// site :  https://an-steve.github.io/Formulaire-dauthenfication-/
// ----------------------
?>

