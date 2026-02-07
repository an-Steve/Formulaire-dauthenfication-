#  Formulaire d'Authentification Sécurisé
Réalisé par ANTON NELCON Steve 
<img width="1902" height="915" alt="image" src="https://github.com/user-attachments/assets/d1c36756-ff5f-48cc-8aac-9e95fcb61d25" />


Un système de connexion et d'inscription sécurisé développé dans le cadre  du **Master Informatique et Big Data** du module **Théorie de l'Information et Sécurité des Systèmes** .


##  À propos

Ce projet est un formulaire d'authentification web sécurisé développé dans le cadre d'un projet académique pour le module **"Théorie de l'Information et Sécurité des Systèmes"**. 

##  Fonctionnalités

###  Connexion sécurisée
<img width="1200" height="400" alt="image" src="https://github.com/user-attachments/assets/75d0518a-909e-45ab-8b8a-71749de6f727" />

- Formulaire de connexion avec validation des champs
- Gestion des sessions utilisateur
- Messages d'erreur informatifs

###  Création de compte
<img width="1200" height="400" alt="image" src="https://github.com/user-attachments/assets/ed0127bb-9517-43ed-af8c-356f6c0d85dd" />

- Inscription de nouveaux utilisateurs
- Validation du format des identifiants
- Confirmation du mot de passe
- Exigences de complexité pour les mots de passe

###  Sécurité
- Chiffrement des mots de passe
- Validation côté client et serveur
- Sessions sécurisées

###  Interface utilisateur
- Design moderne et responsive
- Mode sombre élégant
- Animations fluides
- Expérience utilisateur intuitive
- Support multilingue (FR/EN)

##  Technologies utilisées

## 🛠️ Technologies utilisées

| Technologie | Description |
|------------|-------------|
| **HTML5** | Structure de la page |
| **CSS3** | Styles et animations |
| **JavaScript** | Logique de validation et interactivité |
| **PHP** | Traitement côté serveur et gestion des requêtes |
| **MySQL** | Base de données SQL pour le stockage des utilisateurs |
| **WAMP Server 64** | Environnement de développement (Windows, Apache, MySQL, PHP) |


  ##  Installation

### Prérequis
- **WAMP Server 64** - Pour la base de données MySQL et le serveur Apache
- Un navigateur web moderne (Chrome, Firefox, Safari, Edge)
- Un éditeur de code (VS Code recommandé)

### Étapes d'installation

1. **Installer WAMP Server**
   - Téléchargez et installez [WAMP Server 64 bits](https://www.wampserver.com/)
   - Lancez WAMP et assurez-vous que l'icône est verte

2. **Cloner le dépôt**
```bash
git clone https://github.com/an-Steve/Formulaire-dauthenfication-.git
```

3. **Déplacer le projet dans le dossier WAMP**
```bash
# Copiez le dossier dans le répertoire www de WAMP
# Exemple : C:\wamp64\www\Formulaire
```

4. **Configurer la base de données**
   - Accédez à phpMyAdmin : `http://localhost/phpmyadmin`
   - Créez une nouvelle base de données (ex: `formulaire_auth`)
   - Importez le fichier SQL fourni (si disponible) ou créez les tables nécessaires

5. **Accéder à l'application**
   - Ouvrez votre navigateur à l'adresse : `http://localhost/Formulaire/index.html`
   - Assurez-vous que WAMP est en cours d'exécution
  
##  Utilisation

### Se connecter

**Compte de démonstration :**
- **Identifiant :** `admin`
- **Mot de passe :** `password`
- Cliquez sur **"Se connecter"** (2 fois) 

### Créer un nouveau compte

1. Cliquez sur **"Créer un compte"**
2. Remplissez les champs :
   - Identifiant (minimum 3 caractères)
   - Mot de passe (minimum 8 caractères, avec majuscules, minuscules et chiffres)
   - Confirmation du mot de passe
3. Cliquez sur **"Créer mon compte"**

##  Sécurité

Ce projet implémente plusieurs mesures de sécurité :

### Validation des entrées
- Vérification du format des identifiants
- Exigences de complexité pour les mots de passe
- Protection contre les caractères spéciaux dangereux

  #  Structure du projet

```
Formulaire-dauthenfication-/
│
├── index.html              # Page principale de connexion
├── register.html           # Page d'inscription (si séparée)
├── style.css              # Feuille de styles
├── script.js              # Logique JavaScript côté client
├── logosite.png           # Logo du site
├── README.md              # Documentation
│
├── php/                   # Scripts PHP backend
│   ├── connexion.php      # Traitement de la connexion
│   ├── inscription.php    # Traitement de l'inscription
│   ├── deconnexion.php    # Déconnexion de l'utilisateur
│   └── config.php         # Configuration de la base de données
│
├── database/              # Scripts de base de données
│   └── schema.sql         # Structure de la base de données
│
└── assets/                # Ressources supplémentaires
    ├── fonts/            # Polices personnalisées
    └── images/           # Images et icônes
```
