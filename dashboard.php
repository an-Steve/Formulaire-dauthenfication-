<?php
session_start();
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: index.html');
    exit;
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Espace Sécurisé</title>
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --success-color: #10b981;
            --error-color: #ef4444;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --background: #f9fafb;
            --white: #ffffff;
            --border-color: #e5e7eb;
        }

        /* Mode sombre */
        body.dark-mode {
            --text-primary: #f9fafb;
            --text-secondary: #d1d5db;
            --background: #111827;
            --white: #1f2937;
            --border-color: #374151;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            padding-bottom: 80px;
            position: relative;
            overflow: hidden;
            transition: background 0.3s ease;
        }

        body.dark-mode {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        }

        /* Contrôles (thème et langue) */
        .controls {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 100;
            display: flex;
            gap: 12px;
        }

        .control-btn {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 600;
            font-size: 14px;
        }

        .control-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .lang-text {
            font-family: 'Inter', sans-serif;
            letter-spacing: 0.5px;
        }

        /* Animation de l'arrière-plan */
        .background-animation {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.3;
            animation: float 20s infinite ease-in-out;
        }

        .shape-1 {
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            top: -250px;
            left: -250px;
        }

        .shape-2 {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #f093fb, #f5576c);
            bottom: -200px;
            right: -200px;
            animation-delay: 7s;
        }

        .shape-3 {
            width: 350px;
            height: 350px;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: 14s;
        }

        body.dark-mode .shape-1 {
            background: linear-gradient(135deg, #312e81, #1e1b4b);
        }

        body.dark-mode .shape-2 {
            background: linear-gradient(135deg, #7c2d12, #991b1b);
        }

        body.dark-mode .shape-3 {
            background: linear-gradient(135deg, #0c4a6e, #164e63);
        }

        @keyframes float {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            33% {
                transform: translate(30px, -30px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .dashboard {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 48px 40px;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 100%;
            text-align: center;
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: background 0.3s ease, border 0.3s ease;
        }

        body.dark-mode .dashboard {
            background: rgba(31, 41, 55, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .success-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 24px;
            position: relative;
            animation: scaleIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.3s both;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .success-icon svg {
            filter: drop-shadow(0 8px 16px rgba(16, 185, 129, 0.3));
        }

        .checkmark-circle {
            animation: fillCircle 0.4s ease-in-out 0.3s both;
        }

        .checkmark-path {
            stroke-dasharray: 60;
            stroke-dashoffset: 60;
            animation: drawCheck 0.4s ease-in-out 0.5s both;
        }

        @keyframes fillCircle {
            to {
                fill-opacity: 1;
            }
        }

        @keyframes drawCheck {
            to {
                stroke-dashoffset: 0;
            }
        }

        .welcome {
            color: var(--text-primary);
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
            transition: color 0.3s ease;
        }

        .subtitle {
            color: var(--text-secondary);
            font-size: 16px;
            margin-bottom: 32px;
            transition: color 0.3s ease;
        }

        .user-info {
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
            padding: 28px;
            border-radius: 16px;
            margin: 28px 0;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        body.dark-mode .user-info {
            background: linear-gradient(135deg, #374151 0%, #4b5563 100%);
        }

        .info-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 0;
            border-bottom: 1px solid var(--border-color);
            transition: border-color 0.3s ease;
        }

        .info-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-row:first-child {
            padding-top: 0;
        }

        .info-label {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .info-label svg {
            color: var(--primary-color);
        }

        .info-value {
            color: var(--text-primary);
            font-size: 15px;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        body.dark-mode .status-badge {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.3), rgba(16, 185, 129, 0.2));
            color: #6ee7b7;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.7;
                transform: scale(1.2);
            }
        }

        .success-message {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: var(--success-color);
            font-size: 16px;
            font-weight: 600;
            margin: 24px 0;
            padding: 16px;
            background: #d1fae5;
            border-radius: 12px;
            border-left: 4px solid var(--success-color);
            transition: all 0.3s ease;
        }

        body.dark-mode .success-message {
            background: rgba(16, 185, 129, 0.2);
            color: #6ee7b7;
        }

        .success-message svg {
            flex-shrink: 0;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 32px;
        }

        .btn {
            flex: 1;
            padding: 14px 24px;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .logout-btn {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }

        .logout-btn:active {
            transform: translateY(0);
        }

        /* Footer fixe */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding: 20px;
            z-index: 50;
            transition: background 0.3s ease, border 0.3s ease;
        }

        body.dark-mode .footer {
            background: rgba(0, 0, 0, 0.3);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .footer-content p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            font-weight: 400;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .footer-content strong {
            font-weight: 700;
            color: white;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .controls {
                top: 12px;
                right: 12px;
                gap: 8px;
            }

            .control-btn {
                width: 42px;
                height: 42px;
                font-size: 12px;
            }

            .dashboard {
                padding: 36px 28px;
            }

            .welcome {
                font-size: 26px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .footer-content p {
                font-size: 12px;
            }

            body {
                padding-bottom: 70px;
            }
        }
    </style>
</head>
<body>
    <!-- Contrôles de thème et langue -->
    <div class="controls">
        <button id="themeToggle" class="control-btn" aria-label="Changer de thème">
            <svg class="sun-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="5"></circle>
                <line x1="12" y1="1" x2="12" y2="3"></line>
                <line x1="12" y1="21" x2="12" y2="23"></line>
                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                <line x1="1" y1="12" x2="3" y2="12"></line>
                <line x1="21" y1="12" x2="23" y2="12"></line>
                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
            </svg>
            <svg class="moon-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: none;">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
            </svg>
        </button>
        
        <button id="langToggle" class="control-btn" aria-label="Changer de langue">
            <span class="lang-text">FR</span>
        </button>
    </div>

    <!-- Arrière-plan animé -->
    <div class="background-animation">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

    <div class="dashboard">
        <!-- Icône de succès animée -->
        <div class="success-icon">
            <svg width="100" height="100" viewBox="0 0 100 100">
                <circle class="checkmark-circle" cx="50" cy="50" r="45" fill="#10b981" fill-opacity="0.2" stroke="#10b981" stroke-width="3"/>
                <path class="checkmark-path" d="M28 52 L42 66 L72 34" stroke="#10b981" stroke-width="6" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        
        <h1 class="welcome" data-fr="Bienvenue !" data-en="Welcome!">Bienvenue !</h1>
        <p class="subtitle" data-fr="Vous êtes connecté à votre espace sécurisé" data-en="You are connected to your secure area">Vous êtes connecté à votre espace sécurisé</p>
        
        <div class="user-info">
            <div class="info-row">
                <div class="info-label">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span data-fr="Utilisateur" data-en="User">Utilisateur</span>
                </div>
                <div class="info-value"><?php echo htmlspecialchars($username); ?></div>
            </div>
            
            <div class="info-row">
                <div class="info-label">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <span data-fr="Statut" data-en="Status">Statut</span>
                </div>
                <span class="status-badge">
                    <span class="status-dot"></span>
                    <span data-fr="Connecté" data-en="Connected">Connecté</span>
                </span>
            </div>

            <div class="info-row">
                <div class="info-label">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <span data-fr="Connexion" data-en="Login">Connexion</span>
                </div>
                <div class="info-value"><?php echo date('d/m/Y H:i'); ?></div>
            </div>
        </div>

        <div class="success-message">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            <span data-fr="Connexion réussie !" data-en="Login successful!">Connexion réussie !</span>
        </div>

        <div class="action-buttons">
            <form action="logout.php" method="POST" style="flex: 1;">
                <button type="submit" class="btn logout-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span data-fr="Déconnexion" data-en="Logout">Déconnexion</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Footer fixe -->
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 <strong>ANTON NELSON Steve</strong> - <span data-fr="Tous droits réservés" data-en="All rights reserved">Tous droits réservés</span></p>
        </div>
    </footer>

    <script>
        // Langue actuelle
        let currentLang = localStorage.getItem('lang') || 'fr';
        
        // Thème actuel
        let isDarkMode = localStorage.getItem('darkMode') === 'true';
        
        // Initialisation au chargement
        document.addEventListener('DOMContentLoaded', function() {
            // Appliquer le thème sauvegardé
            if (isDarkMode) {
                document.body.classList.add('dark-mode');
                toggleThemeIcons(true);
            }
            
            // Appliquer la langue sauvegardée
            if (currentLang === 'en') {
                changeLanguage('en');
            }
        });
        
        // Gestion du changement de thème
        document.getElementById('themeToggle').addEventListener('click', function() {
            isDarkMode = !isDarkMode;
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', isDarkMode);
            toggleThemeIcons(isDarkMode);
        });
        
        function toggleThemeIcons(isDark) {
            const sunIcon = document.querySelector('.sun-icon');
            const moonIcon = document.querySelector('.moon-icon');
            
            if (isDark) {
                sunIcon.style.display = 'none';
                moonIcon.style.display = 'block';
            } else {
                sunIcon.style.display = 'block';
                moonIcon.style.display = 'none';
            }
        }
        
        // Gestion du changement de langue
        document.getElementById('langToggle').addEventListener('click', function() {
            currentLang = currentLang === 'fr' ? 'en' : 'fr';
            changeLanguage(currentLang);
            localStorage.setItem('lang', currentLang);
        });
        
        function changeLanguage(lang) {
            // Mettre à jour le texte du bouton
            document.querySelector('.lang-text').textContent = lang.toUpperCase();
            
            // Mettre à jour tous les éléments avec data-fr et data-en
            document.querySelectorAll('[data-fr]').forEach(element => {
                const key = `data-${lang}`;
                if (element.hasAttribute(key)) {
                    element.textContent = element.getAttribute(key);
                }
            });
            
            // Mettre à jour la langue du document
            document.documentElement.lang = lang;
        }
    </script>
</body>
</html>
