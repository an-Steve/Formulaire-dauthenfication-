#  Formulaire d'Authentification Sécurisé


Un système de connexion et d'inscription sécurisé développé dans le cadre du module **Théorie de l'Information et Sécurité des Systèmes**.

## 📸 Aperçu

![Aperçu du formulaire](https://raw.githubusercontent.com/an-Steve/Formulaire-dauthenfication-/main/screenshot.png)

🔗 **[Démo en ligne](https://an-steve.github.io/Formulaire-dauthenfication-/)**

## 📋 Table des matières

- [À propos](#-à-propos)
- [Fonctionnalités](#-fonctionnalités)
- [Technologies utilisées](#-technologies-utilisées)
- [Installation](#-installation)
- [Utilisation](#-utilisation)
- [Sécurité](#-sécurité)
- [Structure du projet](#-structure-du-projet)
- [Auteur](#-auteur)
- [License](#-license)

## 🎯 À propos

Ce projet est un formulaire d'authentification web sécurisé développé dans le cadre d'un projet académique pour le module **"Théorie de l'Information et Sécurité des Systèmes"**. L'objectif est de mettre en pratique les concepts de sécurité appris en cours, notamment :

- La validation des données
- Le chiffrement des mots de passe
- La protection contre les attaques courantes (XSS, injection SQL, CSRF)
- Les bonnes pratiques de conception d'interfaces sécurisées

## ✨ Fonctionnalités

### 🔑 Connexion sécurisée
- Formulaire de connexion avec validation des champs
- Gestion des sessions utilisateur
- Messages d'erreur informatifs

### 📝 Création de compte
- Inscription de nouveaux utilisateurs
- Validation du format des identifiants
- Confirmation du mot de passe
- Exigences de complexité pour les mots de passe

### 🛡️ Sécurité
- Chiffrement des mots de passe
- Protection contre les attaques XSS
- Validation côté client et serveur
- Sessions sécurisées

### 🎨 Interface utilisateur
- Design moderne et responsive
- Mode sombre élégant
- Animations fluides
- Expérience utilisateur intuitive
- Support multilingue (FR)

## 🛠️ Technologies utilisées

- **HTML5** - Structure de la page
- **CSS3** - Styles et animations
- **JavaScript** - Logique de validation et interactivité
- **LocalStorage** - Stockage local des données (à des fins de démonstration)

## 📦 Installation

### Prérequis
- Un navigateur web moderne (Chrome, Firefox, Safari, Edge)
- Un éditeur de code (VS Code recommandé)
- Un serveur local (optionnel pour le développement)

### Étapes d'installation

1. **Cloner le dépôt**
```bash
git clone https://github.com/an-Steve/Formulaire-dauthenfication-.git
```

2. **Accéder au répertoire du projet**
```bash
cd Formulaire-dauthenfication-
```

3. **Ouvrir le fichier index.html**
   - Double-cliquez sur `index.html`, ou
   - Utilisez un serveur local :
   ```bash
   # Avec Python 3
   python -m http.server 8000
   
   # Avec Node.js (http-server)
   npx http-server
   ```

4. **Accéder à l'application**
   - Ouvrez votre navigateur à l'adresse `http://localhost:8000`

## 💻 Utilisation

### Créer un nouveau compte

1. Cliquez sur **"Créer un compte"**
2. Remplissez les champs :
   - Identifiant (minimum 3 caractères)
   - Mot de passe (minimum 8 caractères, avec majuscules, minuscules et chiffres)
   - Confirmation du mot de passe
3. Cliquez sur **"Créer mon compte"**

### Se connecter

1. Entrez votre identifiant
2. Entrez votre mot de passe
3. Cliquez sur **"Se connecter"**

### Réinitialiser le mot de passe

1. Cliquez sur **"Réinitialiser"**
2. Suivez les instructions pour récupérer votre compte

## 🔒 Sécurité

Ce projet implémente plusieurs mesures de sécurité :

### Validation des entrées
- Vérification du format des identifiants
- Exigences de complexité pour les mots de passe
- Protection contre les caractères spéciaux dangereux

### Protection des données
- Chiffrement des mots de passe avec algorithmes sécurisés
- Pas de stockage en clair des informations sensibles
- Utilisation de tokens de session

### Bonnes pratiques
- Séparation des préoccupations (HTML/CSS/JS)
- Code commenté et maintenable
- Respect des standards W3C
- Accessibilité WCAG

### ⚠️ Note importante
Ce projet est à **but pédagogique**. Pour une utilisation en production, il faudrait :
- Implémenter un backend sécurisé (Node.js, PHP, Python)
- Utiliser une base de données (MySQL, PostgreSQL, MongoDB)
- Ajouter l'authentification à deux facteurs (2FA)
- Implémenter HTTPS
- Ajouter des limitations de tentatives de connexion
- Utiliser des bibliothèques de hachage robustes (bcrypt, Argon2)

## 📁 Structure du projet

```
Formulaire-dauthenfication-/
│
├── index.html              # Page principale
├── style.css              # Feuille de styles
├── script.js              # Logique JavaScript
├── logosite.png           # Logo du site
├── README.md              # Documentation
└── assets/                # Ressources supplémentaires
    ├── fonts/            # Polices personnalisées
    └── images/           # Images et icônes
```

## 🚀 Améliorations futures

- [ ] Intégration d'un backend (Node.js/Express)
- [ ] Base de données pour la persistance des utilisateurs
- [ ] Authentification à deux facteurs (2FA)
- [ ] Récupération de mot de passe par email
- [ ] Support OAuth (Google, Facebook, GitHub)
- [ ] Tests unitaires et d'intégration
- [ ] CI/CD avec GitHub Actions
- [ ] Tableau de bord utilisateur

## 🤝 Contribution

Les contributions sont les bienvenues ! Pour contribuer :

1. Forkez le projet
2. Créez une branche pour votre fonctionnalité (`git checkout -b feature/AmazingFeature`)
3. Committez vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Poussez vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrez une Pull Request

## 👨‍💻 Auteur

**ANTON NELCON Steve**

- GitHub: [@an-Steve](https://github.com/an-Steve)
- Projet: [Formulaire d'authentification](https://github.com/an-Steve/Formulaire-dauthenfication-)

## 📝 License

Ce projet est sous licence MIT - voir le fichier [LICENSE](LICENSE) pour plus de détails.

## 🙏 Remerciements

- Professeurs du module "Théorie de l'Information et Sécurité des Systèmes"
- Communauté open-source pour les ressources et l'inspiration
- MDN Web Docs pour la documentation

---

⭐ N'hésitez pas à mettre une étoile si ce projet vous a été utile !

**Développé avec ❤️ dans le cadre d'un projet académique**
