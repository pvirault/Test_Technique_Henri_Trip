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
  - **Un guide peut inclure plusieurs activités.**

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

    1. **Modèles** : Créer des modèles User, Guide et Activity. Ces modèles représentent les principales entités de la base de données, où chaque entité aura ses propres attributs (par exemple, User avec email, mot de passe et rôle, Guide avec titre, description, jours, etc.).

    2. **Endpoints** : 
        - **Authentification** : endpoints pour la connexion et l’inscription.
        - **Gestion des utilisateurs** : création, mise à jour, suppression pour les admins.
        - **Gestion des guides** : création, mise à jour, suppression, et consultation de guides. Les permissions limiteront l’accès pour les utilisateurs normaux.
        - **Gestion des activités** : création, association aux guides, et ordonnancement par jour.
    
    3. **Permissions et rôles** : Les admins ont accès complet, tandis que les users n’ont qu’un accès en lecture aux guides auxquels ils sont invités.

  - **Étape 2 : Mise en Place des Couches de l’Application**

    1. **Contrôleurs** : Un contrôleur pour chaque entité (UserController, GuideController, ActivityController). Ces contrôleurs recevront les requêtes HTTP et appelleront les services nécessaires.

    2. **Services** : Les services contiendront la logique métier de chaque entité. Par exemple, un GuideService pourrait gérer la logique pour lister les guides accessibles à un utilisateur.

    3. **Middleware** : Gestion des autorisations. Ce middleware vérifie si le token est valide, et autorise ou non.

    4. **Routes** : Une route pour chaque fonctionnalité clé, utilisant une structure RESTful. Par exemple, GET /guides/{id} pour récupérer un guide particulier.

  - **Étape 3 : Conception de la Base de Données**

    - **Tables** :
        - **users** (id, email, password, role)
        - **guides** (id, titre, description, jours, mobilité, saison,pour qui, created_by)
        - **activities** (id, guide_id, titre, description, catégorie, adresse, téléphone, horaires, site_internet, jour, ordre)
        - **Clés étrangères** pour lier les guides aux utilisateurs (avec des permissions d’accès) et les activités aux guides.
    
    - **Relations** :
        **users et guides** : Les admins créent et modifient les guides ; les users n’ont accès qu’aux guides auxquels ils sont invités.
        **guides et activities** : Chaque guide contient plusieurs activités, ordonnées par jour et par ordre de visite.

  - **Étape 4 : Implémentation des Fonctionnalités de l’API**

    - **Authentification et gestion des sessions** : Mettre en place un système JWT pour sécuriser l’accès.
    
    - **Endpoints CRUD** :
        - **Utilisateurs** : Création, lecture, mise à jour, suppression (admin uniquement).
        - **Guides** : Création, modification, suppression, et consultation(les utilisateurs peuvent uniquement consulter les guides sur lesquels ils sont invités).
        - **Activités** : Ajout aux guides, modification, et suppression (uniquement accessible par les admins).
    
    - **Permissions** : Intégrer les règles pour restreindre l’accès aux fonctionnalités selon les rôles.

  - **Étape 5 : Sécurisation et Gestion des Erreurs**

    - **Validation des données** : Utiliser des règles de validation (par exemple, validation d’email et de mot de passe pour les utilisateurs).

    - **Gestion des erreurs** : S’assurer que les erreurs sont gérées de manière centralisée avec des codes de statut HTTP appropriés (404 pour non trouvé, 403 pour accès refusé, etc.).

  - **Étape 6 : Tests et Documentation**

    - **Tests unitaires et fonctionnels** : Tester les fonctionnalités principales et les permissions.
    
    - **Documentation API** : Utiliser un outil comme Swagger pour documenter les endpoints et faciliter les tests des requêtes.

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
│   │       ├── ApiKeyMiddleware.php       # modifier commentaire
│   │       ├── Authenticate.php           # Middleware pour authentifier les utilisateurs      
│   ├── Models/
│   │   ├── Activity.php                   # Modèle Activity lié aux guides
│   │   ├── Guide.php                      # Modèle Guide avec les attributs requis
│   │   └── User.php                       # Modèle User pour gérer les rôles (Admin/Utilisateur)
│   ├── Providers/                        
│   └── Services/                          # Services personnalisés pour la logique métier complexe
│       ├── Activity.php
│       ├── AuthService.php
│       ├── GuideService.php
│       └── UserService.php
├── config/                                # Fichiers de configuration de l'application
├── database/
│   ├── factories/
│   ├── migrations/                        # Migrations de base de données pour la configuration du schéma
│   └── seeders/                           # Seeders pour initialiser la base de données avec des données
│       ├── ActivitySeeder.php
│       ├── DatabaseSeeder.php
│       ├── GuideSeeder.php
│       └── UserSeeder.php
├── resources/
├── routes/
│   ├── api.php                            # Routes API définissant les points d'API
└── tests/
    ├── Feature/                           # Tests fonctionnels pour tester les points d'API
    └── Unit/                              # Tests unitaires pour les services et les modèles
```