# Test Technique - Henri Trip

# Contexte 

Ce test technique est composé de deux exercices : un exercice pour la partie Frontend et un autre pour la partie Backend.

## Exercice 1 : Test Frontend

Les utilisateurs ont besoin de consulter et d'interagir avec les guides qu'ils ont créés ou auxquels ils ont été invités. Ce projet consiste en la création d'une web app en React qui permettra aux utilisateurs de visualiser et de naviguer à travers ces guides.

### Objectifs

  - Créer une interface utilisateur intuitive pour afficher et naviguer à travers les guides accessibles par l’utilisateur.
  - Afficher une liste des guides, avec un accès aux détails de chaque guide, incluant les jours et les activités associées.
  - Assurer une navigation fluide entre les différentes sections (jours, activités).
  - Interagir avec notre API pour récupérer les données des guides.

### Architecture et Organisation des Composants

- **`App.js`** : Point d’entrée de l’application pour définir le routage global.
- **Composants principaux** :
  1. **GuideList** : Affiche la liste des guides.
  2. **GuideDetail** : Vue détaillée d’un guide, avec ses sections spécifiques.
  3. **DayView** : Affiche les jours pour un guide spécifique.
  4. **ActivityView** : Affiche les activités d’un jour donné.
- Utilisation de **React Router** pour gérer la navigation entre les composants.
- Utilisation de **Axios** pour consommer l'API.

### Structure des Données et Consommation de l’API

- Prévoir des requêtes pour récupérer la liste des guides et les détails d'un guide avec les activités associées.
- Gérer les erreurs et le chargement pour assurer une expérience utilisateur fluide.

### Organisation du Code

- **`src/components`** : Contient tous les composants réutilisables, tels que `GuideList`, `GuideDetail`, `DayView`, `ActivityView`.
- **`src/services`** : Centralise les appels API avec Axios.
- **`src/styles`** : Fichiers CSS pour styliser chaque composant de manière modulaire.

### Structure du Projet

Voici la structure du projet pour organiser efficacement cette application React en respectant les bonnes pratiques :

```plaintext
web-app/
├── public/
│   ├── index.html             # Fichier HTML principal pour injecter l'application React
│   └── ...                    # Autres fichiers publics
├── src/
│   ├── components/            # Composants React individuels
│   │   ├── GuideList.js       # Composant pour afficher la liste des guides
│   │   ├── GuideDetail.js     # Composant pour les détails d'un guide spécifique
│   │   ├── DayView.js         # Composant pour afficher les jours d'un guide
│   │   └── ActivityView.js    # Composant pour afficher les activités d'un jour
│   │
│   ├── pages/                 # Pages principales, chacune pour une vue globale
│   │   ├── HomePage.js        # Page d'accueil avec la liste des guides
│   │   └── GuidePage.js       # Page de détails pour un guide
│   │
│   ├── services/              # Appels API et gestion des données
│   │   └── api.js             # Fichier pour les appels API (axios configuration)
│   │
│   ├── styles/                # Styles globaux et spécifiques aux composants
│   │   ├── index.css          # Fichier CSS global
│   │   ├── GuideList.css      # Styles spécifiques pour la liste des guides
│   │   ├── GuideDetail.css    # Styles pour les détails du guide
│   │   └── DayView.css        # Styles pour la vue des jours
│   │
│   ├── App.js                 # Point d’entrée principal, définit les routes et structure
│   ├── index.js               # Point de montage ReactDOM
│   └── utils/                 
│       └── helpers.js         
├── .env                       # Variables d'environnement (API URLs, clés, etc.)
├── .gitignore                 # Fichiers et dossiers à ignorer par Git
├── package.json               # Dépendances et scripts du projet
└── README.md                  # Documentation du projet
```

## Exercice 2 : Test Backend

### Objectif : Création d'une API

#### Contexte 

Cette API gérera deux types d'utilisateurs avec des droits spécifiques : 

1. **Utilisateur (User)**  
   Les utilisateurs de type "user" peuvent :
   - Visualiser les informations d'un guide auquel ils ont accès.

2. **Administrateur (Admin)**  
   Les administrateurs disposent de droits élargis, ils peuvent :
   - Accéder aux informations de tous les utilisateurs.
   - Créer des utilisateurs (user ou admin).
   - Supprimer un utilisateur de type user.
   - Créer, modifier et supprimer des guides.
   - Gérer les activités des guides.

#### Détails des Guides et Activités 

- **Guides**  
  Les administrateurs ont un accès complet (création, modification, suppression, consultation) aux guides. Chaque guide doit comporter les éléments suivants :
  - **Titre**
  - **Description**
  - **Nombre de jours**
  - **Options** (comme mobilité, saison, audience cible, etc.)
  - Un guide peut inclure plusieurs activités.

- **Activités**  
  Chaque activité associée à un guide doit posséder les informations suivantes :
  - **Titre**
  - **Description**
  - **Catégorie**
  - **Adresse**
  - **Numéro de téléphone**
  - **Horaires d'ouverture**
  - **Site internet**
  
  Les administrateurs peuvent ajouter des activités dans les guides. Les activités ont un ordre de visite et doivent pouvoir être réparties sur plusieurs jours au sein d'un même guide.

- **Accès des Utilisateurs**  
  Les utilisateurs de type "user" ne peuvent voir que les guides auxquels ils sont explicitement invités.

### Choix Techniques 

L'API sera développée en **PHP** avec le framework **Laravel**.

- **Pourquoi PHP ?**
  1. **Compatibilité et Fiabilité** : PHP est un langage de choix pour les applications backend web, compatible avec divers serveurs et bases de données, et bien adapté aux requêtes HTTP.
  2. **Performance et Rapidité de Développement** : PHP offre des performances satisfaisantes et un vaste écosystème de bibliothèques natives et open-source pour accélérer le développement.

- **Pourquoi Laravel ?**
  1. **Architecture MVC (Modèle-Vue-Contrôleur)** :
     - **Modèle** : Gère la logique métier, les données et les décisions associées.
     - **Vue** : Assure l'affichage sans calculs lourds, en affichant les données transmises.
     - **Contrôleur** : Fait le lien entre l'utilisateur, le modèle et la vue. Il reçoit les requêtes, traite les actions via le modèle et renvoie les résultats.
  2. **Simplification des Relations de Données** : Laravel facilite la gestion des relations entre entités dans la base de données.
  3. **Gestion des Middlewares et des Autorisations** : Laravel intègre une gestion efficace des middlewares et des permissions d’accès.

### Méthodologie pour Structurer le Backend avec PHP et Laravel

  - **Étape 1 : Planification de l’Architecture de l’API RESTful**
  - **Étape 2 : Mise en Place des Couches de l’Application**
  - **Étape 3 : Conception de la Base de Données**
  - **Étape 4 : Implémentation des Fonctionnalités de l’API**
  - **Étape 5 : Sécurisation et Gestion des Erreurs**

### Structure du Projet
```plaintext
backend/
├── app/
│   ├── Console/                           # Console pour les commandes artisan
│   ├── Exceptions/                        # Gestion des exceptions globales de l'application
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── ActivityController.php     # Contrôleur pour la gestion des activités au sein des guides
│   │   │   ├── AuthController.php         # Contrôleur pour l'authentification et l'autorisation des utilisateurs
│   │   │   ├── GuideController.php        # Contrôleur pour la gestion des guides (CRUD pour les guides)
│   │   │   ├── UserController.php         # Contrôleur pour la gestion des utilisateurs (CRUD pour les utilisateurs)
│   │   └── Middleware/
│   │       ├── CheckAdminRole.php         # Middleware pour vérifier si l'utilisateur est administrateur
│   │       ├── Authenticate.php           # Middleware pour authentifier les utilisateurs      
│   ├── Models/
│   │   ├── Activity.php                   # Modèle Activity lié aux guides
│   │   ├── Guide.php                      # Modèle Guide avec les attributs requis
│   │   └── User.php                       # Modèle User pour gérer les rôles (Admin/Utilisateur)
│   ├── Providers/                        
│   └── Services/                          # Services personnalisés pour la logique métier complexe
│       ├── Activity.php
│       ├── GuideService.php
│       └── UserService.php
├── config/                                # Fichiers de configuration de l'application
├── database/
│   ├── factories/
│   ├── migrations/                        # Migrations de base de données pour la configuration du schéma
│   └── seeders/                           # Seeders pour initialiser la base de données avec des données
├── resources/
│   ├── views/                             # Vues (si applicables pour les réponses API)
├── routes/
│   ├── api.php                            # Routes API définissant les points d'API
│   └── web.php                            # Routes Web pour les vues et les pages HTML
└── tests/
    ├── Feature/                           # Tests fonctionnels pour tester les points d'API
    └── Unit/                              # Tests unitaires pour les services et les modèles
```