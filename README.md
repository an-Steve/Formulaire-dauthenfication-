<div align="center">

#  Formulaire d'Authentification Sécurisé

</div>

<p align="left">
→ Projet réalisé par **Anton Nelcon Steve**
</p>




<img width="1902" height="915" alt="image" src="https://github.com/user-attachments/assets/d1c36756-ff5f-48cc-8aac-9e95fcb61d25" />

Un système de connexion et d'inscription sécurisé développé dans le cadre  du **Master Informatique et Big Data** du module **Théorie de l'Information et Sécurité des Systèmes** .~

##  → Accès au Formulaire

**Lien du projet :** https://an-steve.github.io/Formulaire-dauthenfication-/

>  **Important :** Ce projet nécessite un serveur local (**WAMP**) pour fonctionner correctement.  
> Assurez-vous que votre serveur est activé avant d’accéder au formulaire.


##  À propos

Ce projet est un formulaire d'authentification web sécurisé développé dans le cadre d'un projet académique pour le module **"Théorie de l'Information et Sécurité des Systèmes"**. 

##  Fonctionnalités

###  Connexion sécurisée
| Aperçu | Fonctionnalités |
|--------|---------------|
| <img src="https://github.com/user-attachments/assets/75d0518a-909e-45ab-8b8a-71749de6f727" width="500"/> | • **Formulaire de connexion** avec validation des champs<br>  • **Gestion des sessions utilisateur**<br>  • **Messages d'erreur informatifs** |

###  Création de compte
| Aperçu | Fonctionnalités |
|--------|---------------|
| <img src="https://github.com/user-attachments/assets/ed0127bb-9517-43ed-af8c-356f6c0d85dd" width="500"/> | • **Inscription de nouveaux utilisateurs**<br>• **Validation du format des identifiants**<br>• **Confirmation du mot de passe**<br>• **Exigences de complexité pour les mots de passe** |

###  Le compte (Dashboard)

| Aperçu | Détails |
|--------|--------|
| <img src="https://github.com/user-attachments/assets/b95508ff-ac51-42ae-83b1-6e2e9803e693" width="500"/> | • **Informations sur l'utilisateur**<br> • **Connecté ou non**<br>• **Heure et date de la dernière connexion** |

## Interface utilisateur

| 🌙 Aperçu — Mode sombre | ☀️ Aperçu — Mode clair |
|------------------------|----------------------|
| <img src="https://github.com/user-attachments/assets/fba1a6a3-d034-474d-a444-5d386fa3a371" width="500"/> | <img src="https://github.com/user-attachments/assets/3a7a6f1c-4887-4e6e-a99a-fffe8dc110b6" width="500"/> |

<br>

##  Support multilingue

| 🇫🇷 Aperçu — Français | 🇬🇧 Aperçu — Anglais |
|----------------------|--------------------|
| <img src="https://github.com/user-attachments/assets/4fe11940-6239-4004-a5b5-88f7f6434594" width="500"/> | <img src="https://github.com/user-attachments/assets/3bc5f3ef-26c3-42b9-b8f5-1e98431283d9" width="500"/> |


##  Technologies utilisées

| Technologie | Description |
|------------|-------------|
| **HTML5** | Structure de la page |
| **CSS3** | Styles et animations |
| **JavaScript** | Logique de validation et interactivité |
| **PHP** | Traitement côté serveur et gestion des requêtes |
| **MySQL** | Base de données SQL pour le stockage des utilisateurs |
| **WAMP Server 64** | Environnement de développement (Windows, Apache, MySQL, PHP) |

##  Base de données

<img width="1913" height="917" alt="image" src="https://github.com/user-attachments/assets/442eb37e-e26a-424d-af0d-eb910d166013" />

→ Utilisation avec WampServer pour la gestion de la base de données.

### Accès à phpMyAdmin 
Une fois WampServer lancé, accédez à phpMyAdmin via le lien suivant :  
http://localhost/phpmyadmin/

### Informations de connexion →  
- Identifiant : `root`  
- Mot de passe : *(laisser vide)*  

### Configuration de la base de données →  
- Nom de la base de données : `auth_secure`  
- Nom de la table : `user`

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
