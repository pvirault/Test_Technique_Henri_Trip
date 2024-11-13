# Test Technique - Henri Trip

## Contexte 

Ce test technique est composé de deux exercices : un exercice pour la partie Frontend et un autre pour la partie Backend.

## Prérequis

Avant de commencer, assurez-vous que vous avez les éléments suivants installés sur votre machine :

- **PHP** 7.3.29 ou supérieur
- **MySQL** 5.7.31 ou supérieur
- **Docker** (alternative pour la base de données)
- **Docker Compose** (alternative pour la base de données)
- **Node.js** (version LTS recommandée)
- **npm** (gestionnaire de paquets pour Node.js)
- **Composer** (gestionnaire de dépendances PHP)
- **Git** (pour cloner le repository)

## Installation et Configuration

### 1. Cloner le Repository

  Commencez par cloner le dépôt Git sur votre machine locale :

  ```bash
  git clone https://github.com/pvirault/Test_Technique_Henri_Trip.git
  cd Test_Technique_Henri_Trip
  ```

### 2. Utilisation du Docker pour la base de données (optionnel)

  Si vous souhaitez utiliser Docker pour gérer la base de données MySQL et phpMyAdmin, suivez les étapes ci-dessous :

  1. **lancez les services Docker** :

    Exécutez la commande suivante dans le terminal à partir du répertoire contenant le fichier docker-compose.yml :
    ```bash
    docker-compose up -d
    ```

    Cela va créer et démarrer les services suivants :

  - **MySQL** : La base de données avec les informations de connexion suivantes :
    - **Hôte** : `localhost`
    - **Port** : `3306`
    - **Nom d'utilisateur** : `laravel_user`
    - **Mot de passe** : `laravel_password`
    - **Base de données** : `laravel_db`

  - **phpMyAdmin** : Interface graphique pour gérer la base de données.
    - **URL** : [http://localhost:8080](http://localhost:8080)
    - **Nom d'utilisateur** : `root`
    - **Mot de passe** : `root_password`

  2. **Arrêter les services Docker** :

    Pour arrêter les services, exécutez la commande suivante :

    ```bash
    docker-compose down
    ```

    Cela arrêtera et supprimera les conteneurs sans supprimer les données de la base de données, qui sont stockées dans un volume persistant (`mysql_data`).

  3. **Accéder à la base de données** :
    Vous pouvez accéder à phpMyAdmin via [http://localhost:8080](http://localhost:8080). Connectez-vous avec les informations suivantes :

      **. Serveur** : `mysql` (le nom du service MySQL défini dans le fichier `docker-compose.yml`)
      **. Nom d'utilisateur** : `root`
      **. Mot de passe** : `root_password`
  
  4. **Réinitialisation de la base de données** :

    Si vous souhaitez réinitialiser la base de données, vous pouvez supprimer les volumes Docker associés à MySQL en exécutant :
    
    ```bash
    docker-compose down -v
    ```

    Cela supprimera également le volume de données et réinitialisera la base de données.

### 3. Configuration du Backend (Laravel)

  1. **Installation des Dépendances PHP** :

  Rendez-vous dans le dossier du projet backend (si nécessaire) et exécutez la commande suivante pour installer les dépendances PHP via Composer :

  ```bash
  composer install
  ```

  2. **Configuration du fichier `.env`** :
    
    Copiez le fichier `.env.example` vers `.env` et configurez les paramètres de votre base de données ainsi que les autres variables nécessaires :

    ```bash
    cp .env.example .env
    ```

    Modifiez les paramètres dans le fichier `.env` selon votre configuration locale (base de données, etc.).

   ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
    ```

  3. **Génération de la Clé de l'Application** :

    Exécutez la commande suivante pour générer la clé de votre application Laravel :

    ```bash
    php artisan key:generate
    ```

  4. **Création des Tables dans la Base de Données** :

    Assurez-vous que votre base de données MySQL est bien configurée, puis appliquez les migrations pour créer les tables nécessaires :

    ```bash
    php artisan migrate
    ```
  5. **Chargement des Données (Facultatif)** :
    Utiliser les données de test à charger dans la base de données.
    
    ```bash
    php artisan db:seed
    ```

  6. **Démarrer le Serveur Laravel** :
    Pour démarrer le serveur de développement Laravel, exécutez la commande suivante :

    ```bash
    php artisan serve
    ```

    Le backend sera accessible à l'adresse `http://127.0.0.1:8000`.

### 4. Configuration du Frontend (React)

  1. **Installation des Dépendances JavaScript** :

    Allez dans le dossier `frontend` et installez les dépendances du projet avec npm :

    ```bash
    cd web-app
    npm install
    ```

  2. **Démarrer l'Application React** :

    Une fois les dépendances installées, démarrez l'application React avec la commande suivante :

    ```bash
    npm start
    ```

    L'application React sera alors accessible à l'adresse `http://localhost:3000`.

## Utilisation de l'API

  L'application expose plusieurs points d'API pour gérer les utilisateurs, les guides et les activités. Vous pouvez interagir avec ces points de manière sécurisée en utilisant des tokens d'authentification générés lors de l'inscription et de la connexion des utilisateurs.

**Authentification**
  
  1. **Inscription d'un utilisateur** :

    Pour inscrire un nouvel utilisateur, utilisez le point `POST /register` :

    ```javascript
    axios.post('http://127.0.0.1:8000/api/register', {
      name: 'Jean Dupont',
      email: 'jean@example.com',
      password: 'password123',
      role: 'user'
    })
    .then(response => console.log(response.data))
    .catch(error => console.error(error));
    ```

  2. **Connexion d'un utilisateur** :

    Pour se connecter et obtenir un token d'authentification, utilisez le point `POST /login` :

    ```javascript
    axios.post('http://127.0.0.1:8000/api/login', {
      email: 'jean@example.com',
      password: 'password123'
    })
    .then(response => {
      localStorage.setItem('auth_token', response.data.token);
    })
    .catch(error => console.error(error));
    ```

  3. **Utilisation du token dans les requêtes** :

    Pour toute requête nécessitant une authentification (par exemple pour obtenir les utilisateurs ou guides), incluez le token dans l'en-tête `Authorization` :

    ```javascript
    const token = localStorage.getItem('auth_token');
    axios.get('http://127.0.0.1:8000/api/users', {
      headers: { Authorization: `Bearer ${token}` }
    })
    .then(response => console.log(response.data))
    .catch(error => console.error(error));
    ```

## Routes API

  Voici les routes API principales disponibles pour interagir avec le backend :

  #### Utilisateurs
  - **GET /api/users** : Récupère tous les utilisateurs.
  - **GET /api/users/{id}** : Récupère un utilisateur spécifique par son ID.
  - **PUT /api/users/{id}** : Met à jour les informations d'un utilisateur par son ID.
  - **DELETE /api/users/{id}** : Supprime un utilisateur par son ID.

  #### Guides
  - **GET /api/guides** : Récupère tous les guides.
  - **POST /api/guides** : Crée un nouveau guide.
  - **GET /api/guides/{id}** : Récupère un guide spécifique par son ID.
  - **PUT /api/guides/{id}** : Met à jour un guide existant par son ID.
  - **DELETE /api/guides/{id}** : Supprime un guide par son ID.
  - **GET /api/guides/search** : Recherche des guides selon des critères.

  #### Activités (pour chaque guide)
  - **GET /api/guides/{guideId}/activities** : Récupère toutes les activités pour un guide donné.
  - **POST /api/guides/{guideId}/activities** : Crée une nouvelle activité pour un guide donné.
  - **GET /api/guides/{guideId}/activities/{activityId}** : Récupère une activité spécifique pour un guide donné.
  - **PUT /api/guides/{guideId}/activities/{activityId}** : Met à jour une activité spécifique.
  - **DELETE /api/guides/{guideId}/activities/{activityId}** : Supprime une activité spécifique.

---

## Exemple d'Appels API avec Axios (Frontend React)

  1. **Inscrire un utilisateur** :

    ```javascript
    axios.post('http://127.0.0.1:8000/api/register', {
      name: 'John Doe',
      email: 'john@example.com',
      password: 'password123',
      role: 'user'
    })
    .then(response => console.log(response.data))
    .catch(error => console.error(error));
    ```
  
  2. **Se connecter et obtenir le token** :

    ```javascript
    axios.post('http://127.0.0.1:8000/api/login', {
      email: 'john@example.com',
      password: 'password123',
    })
    .then(response => {
      localStorage.setItem('auth_token', response.data.token);
    })
    .catch(error => console.error(error));
    ```

  3. **Consulter les guides (avec authentification)** :
    
    ```javascript
    const token = localStorage.getItem('auth_token');
    axios.get('http://127.0.0.1:8000/api/guides', {
      headers: { Authorization: `Bearer ${token}` }
    })
    .then(response => console.log(response.data))
    .catch(error => console.error(error));
    ```

## Informations supplémentaires

  Pour plus de détails sur Laravel, consultez la documentation officielle : [Laravel Documentation](https://laravel.com/docs).
  Si vous rencontrez des problèmes, vérifiez les fichiers journaux de Laravel dans le répertoire `storage/logs/`.

  Pour plus de détails sur React, consultez la documentation officielle : [React Documentation](https://reactjs.org/docs/).
  Si vous rencontrez des problèmes, consultez la console de développement pour les erreurs ou vérifiez les fichiers journaux.