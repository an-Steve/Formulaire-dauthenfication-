<?php
// Test de connexion à la base de données
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Test de connexion à la base de données</h2>";

// Tester la connexion
try {
    $conn = new PDO("mysql:host=localhost;dbname=auth_secure", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p style='color: green;'>✓ Connexion à la base de données réussie !</p>";
    
    // Vérifier si la table users existe
    $stmt = $conn->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() > 0) {
        echo "<p style='color: green;'>✓ La table 'users' existe</p>";
        
        // Compter les utilisateurs
        $stmt = $conn->query("SELECT COUNT(*) as total FROM users");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "<p style='color: blue;'>Nombre d'utilisateurs : " . $result['total'] . "</p>";
        
        // Afficher les utilisateurs (sans mot de passe)
        echo "<h3>Liste des utilisateurs :</h3>";
        $stmt = $conn->query("SELECT id, username, created_at FROM users");
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>ID</th><th>Identifiant</th><th>Date création</th></tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
    } else {
        echo "<p style='color: red;'>✗ La table 'users' n'existe pas !</p>";
        echo "<p>Vous devez exécuter le fichier database.sql dans phpMyAdmin</p>";
    }
    
} catch(PDOException $e) {
    echo "<p style='color: red;'>✗ Erreur de connexion : " . $e->getMessage() . "</p>";
    echo "<h3>Vérifications à faire :</h3>";
    echo "<ul>";
    echo "<li>WAMP est-il démarré ? (icône verte)</li>";
    echo "<li>La base de données 'auth_secure' existe-t-elle ?</li>";
    echo "<li>Avez-vous exécuté le fichier database.sql ?</li>";
    echo "</ul>";
}
?>
