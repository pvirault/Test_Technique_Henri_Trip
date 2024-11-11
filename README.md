# Test Technique - Henri Trip

## Contexte 

Ce test technique est composé de deux exercices : un exercice pour la partie Frontend et un autre pour la partie Backend.

## Exercice 1 : Test Frontend

Partie frontend à définir.

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

#### Choix Techniques 

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

#### Méthodologie pour Structurer le Backend avec PHP et Laravel

1. **Étape 1 : Planification de l’Architecture de l’API RESTful**
2. **Étape 2 : Mise en Place des Couches de l’Application**
3. **Étape 3 : Conception de la Base de Données**
4. **Étape 4 : Implémentation des Fonctionnalités de l’API**
5. **Étape 5 : Sécurisation et Gestion des Erreurs**
