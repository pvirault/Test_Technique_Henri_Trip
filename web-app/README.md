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