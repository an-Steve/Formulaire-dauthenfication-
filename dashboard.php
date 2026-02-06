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
            position: relative;
            overflow: hidden;
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
        }

        .subtitle {
            color: var(--text-secondary);
            font-size: 16px;
            margin-bottom: 32px;
        }

        .user-info {
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
            padding: 28px;
            border-radius: 16px;
            margin: 28px 0;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .info-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 0;
            border-bottom: 1px solid var(--border-color);
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
        }

        .info-label svg {
            color: var(--primary-color);
        }

        .info-value {
            color: var(--text-primary);
            font-size: 15px;
            font-weight: 600;
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

        .secondary-btn {
            background: white;
            color: var(--primary-color);
            border: 2px solid var(--border-color);
        }

        .secondary-btn:hover {
            border-color: var(--primary-color);
            background: #f9fafb;
        }

        /* Responsive */
        @media (max-width: 480px) {
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
        }
    </style>
</head>
<body>
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
        
        <h1 class="welcome">Bienvenue !</h1>
        <p class="subtitle">Vous êtes connecté à votre espace sécurisé</p>
        
        <div class="user-info">
            <div class="info-row">
                <div class="info-label">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Utilisateur
                </div>
                <div class="info-value"><?php echo htmlspecialchars($username); ?></div>
            </div>
            
            <div class="info-row">
                <div class="info-label">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    Statut
                </div>
                <span class="status-badge">
                    <span class="status-dot"></span>
                    Connecté
                </span>
            </div>

            <div class="info-row">
                <div class="info-label">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    Connexion
                </div>
                <div class="info-value"><?php echo date('d/m/Y H:i'); ?></div>
            </div>
        </div>

        <div class="success-message">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            Connexion réussie !
        </div>

        <div class="action-buttons">
            <form action="logout.php" method="POST" style="flex: 1;">
                <button type="submit" class="btn logout-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Déconnexion
                </button>
            </form>
        </div>
    </div>
</body>
</html>