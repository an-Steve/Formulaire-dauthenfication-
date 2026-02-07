// Traductions
const translations = {
    fr: {
        // Messages d'erreur et de succès
        fillAllFields: 'Veuillez remplir tous les champs',
        passwordMismatch: 'Les mots de passe ne correspondent pas',
        passwordTooShort: 'Le mot de passe doit contenir au moins 6 caractères',
        serverError: 'Erreur de connexion au serveur'
    },
    en: {
        // Messages d'erreur et de succès
        fillAllFields: 'Please fill in all fields',
        passwordMismatch: 'Passwords do not match',
        passwordTooShort: 'Password must be at least 6 characters',
        serverError: 'Server connection error'
    }
};

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
        if (element.tagName === 'INPUT') {
            // Pour les placeholders
            const placeholderKey = lang === 'fr' ? 'data-placeholder-fr' : 'data-placeholder-en';
            if (element.hasAttribute(placeholderKey)) {
                element.placeholder = element.getAttribute(placeholderKey);
            }
        } else {
            // Pour le texte normal
            const key = `data-${lang}`;
            if (element.hasAttribute(key)) {
                element.textContent = element.getAttribute(key);
            }
        }
    });
    
    // Mettre à jour la langue du document
    document.documentElement.lang = lang;
}

// Gestion du formulaire de connexion
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const submitBtn = this.querySelector('button[type="submit"]');
    
    // Validation côté client
    if (!username || !password) {
        showMessage(translations[currentLang].fillAllFields, 'error');
        return;
    }
    
    // Ajouter l'état de chargement
    submitBtn.classList.add('loading');
    submitBtn.disabled = true;
    
    // Envoi des données au serveur
    const formData = new FormData();
    formData.append('action', 'login');
    formData.append('username', username);
    formData.append('password', password);
    
    fetch('auth.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        submitBtn.classList.remove('loading');
        submitBtn.disabled = false;
        
        if (data.success) {
            showMessage(data.message, 'success');
            // Redirection après 1.5 secondes
            setTimeout(() => {
                window.location.href = 'dashboard.php';
            }, 1500);
        } else {
            showMessage(data.message, 'error');
        }
    })
    .catch(error => {
        submitBtn.classList.remove('loading');
        submitBtn.disabled = false;
        showMessage(translations[currentLang].serverError, 'error');
        console.error('Erreur:', error);
    });
});

// Gestion du formulaire d'inscription
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const username = document.getElementById('newUsername').value;
    const password = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const submitBtn = this.querySelector('button[type="submit"]');
    
    // Validation côté client
    if (!username || !password || !confirmPassword) {
        showRegisterMessage(translations[currentLang].fillAllFields, 'error');
        return;
    }
    
    if (password !== confirmPassword) {
        showRegisterMessage(translations[currentLang].passwordMismatch, 'error');
        return;
    }
    
    if (password.length < 6) {
        showRegisterMessage(translations[currentLang].passwordTooShort, 'error');
        return;
    }
    
    // Ajouter l'état de chargement
    submitBtn.classList.add('loading');
    submitBtn.disabled = true;
    
    // Envoi des données au serveur
    const formData = new FormData();
    formData.append('action', 'register');
    formData.append('username', username);
    formData.append('password', password);
    
    fetch('auth.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        submitBtn.classList.remove('loading');
        submitBtn.disabled = false;
        
        if (data.success) {
            showRegisterMessage(data.message, 'success');
            // Retour au formulaire de connexion après 1.5 secondes
            setTimeout(() => {
                showLoginForm();
                document.getElementById('registerForm').reset();
            }, 1500);
        } else {
            showRegisterMessage(data.message, 'error');
        }
    })
    .catch(error => {
        submitBtn.classList.remove('loading');
        submitBtn.disabled = false;
        showRegisterMessage(translations[currentLang].serverError, 'error');
        console.error('Erreur:', error);
    });
});

// Afficher le formulaire d'inscription
function showRegisterForm() {
    const loginBox = document.querySelector('.login-box');
    const registerBox = document.getElementById('registerBox');
    
    loginBox.style.animation = 'fadeOutDown 0.4s ease';
    
    setTimeout(() => {
        loginBox.style.display = 'none';
        registerBox.style.display = 'block';
        registerBox.style.animation = 'fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1)';
    }, 400);
    
    document.getElementById('message').style.display = 'none';
}

// Afficher le formulaire de connexion
function showLoginForm() {
    const loginBox = document.querySelector('.login-box');
    const registerBox = document.getElementById('registerBox');
    
    registerBox.style.animation = 'fadeOutDown 0.4s ease';
    
    setTimeout(() => {
        registerBox.style.display = 'none';
        loginBox.style.display = 'block';
        loginBox.style.animation = 'fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1)';
    }, 400);
    
    document.getElementById('registerMessage').style.display = 'none';
}

// Afficher un message pour le formulaire de connexion
function showMessage(message, type) {
    const messageDiv = document.getElementById('message');
    messageDiv.textContent = message;
    messageDiv.className = 'message ' + type;
    messageDiv.style.display = 'block';
    
    // Masquer le message après 5 secondes
    setTimeout(() => {
        messageDiv.style.animation = 'fadeOut 0.3s ease';
        setTimeout(() => {
            messageDiv.style.display = 'none';
        }, 300);
    }, 5000);
}

// Afficher un message pour le formulaire d'inscription
function showRegisterMessage(message, type) {
    const messageDiv = document.getElementById('registerMessage');
    messageDiv.textContent = message;
    messageDiv.className = 'message ' + type;
    messageDiv.style.display = 'block';
    
    // Masquer le message après 5 secondes
    setTimeout(() => {
        messageDiv.style.animation = 'fadeOut 0.3s ease';
        setTimeout(() => {
            messageDiv.style.display = 'none';
        }, 300);
    }, 5000);
}

// Gestion du bouton Reset
document.querySelectorAll('button[type="reset"]').forEach(button => {
    button.addEventListener('click', function() {
        document.getElementById('message').style.display = 'none';
        document.getElementById('registerMessage').style.display = 'none';
    });
});
