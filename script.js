// Gestion du formulaire de connexion
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const submitBtn = this.querySelector('button[type="submit"]');
    
    // Validation côté client
    if (!username || !password) {
        showMessage('Veuillez remplir tous les champs', 'error');
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
        showMessage('Erreur de connexion au serveur', 'error');
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
        showRegisterMessage('Veuillez remplir tous les champs', 'error');
        return;
    }
    
    if (password !== confirmPassword) {
        showRegisterMessage('Les mots de passe ne correspondent pas', 'error');
        return;
    }
    
    if (password.length < 6) {
        showRegisterMessage('Le mot de passe doit contenir au moins 6 caractères', 'error');
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
        showRegisterMessage('Erreur de connexion au serveur', 'error');
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

// Animation de fade out
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-10px);
        }
    }
    
    @keyframes fadeOutDown {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(20px);
        }
    }
`;
document.head.appendChild(style);