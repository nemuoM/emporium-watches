# Emporium Watches

Emporium Watches est un projet de site e-commerce développé dans le cadre de ma formation au BTS Services Informatiques aux Organisations (SIO). Ce projet vise à mettre en pratique les compétences acquises durant ma formation, tout en intégrant des connaissances supplémentaires développées de manière autonome.

## Fonctionnalités

- **Catalogue de produits** : Affichage des montres disponibles avec descriptions détaillées, images et prix.
- **Recherche et filtrage** : Possibilité de rechercher selon les filtres choisis (Marque, Couleur,...).
- **Authentification** : Inscription et connexion des utilisateurs pour accéder à des fonctionnalités personnalisées.
- **Gestion du panier** : Ajout, modification et suppression de produits dans le panier d'achat.
- **Processus de commande** : Validation du panier, saisie des informations client et confirmation de la commande.
- **Back-office**: Afin de pouvoir gérer l'ajout de nouveaux éléments (Style, Mouvement,...).

## Technologies utilisées

- **Front-end** : HTML, CSS, JavaScript
- **Back-end** : PHP
- **Base de données** : MariaDB

## Installation

1. **Cloner le dépôt** :

   ```bash
   git clone https://github.com/nemuoM/emporium-watches.git
   ```

2. **Configurer la base de données** :

   - Importer le fichier `sql/db_ew.sql` pour créer les tables nécessaires.

3. **Lancer le serveur** :

   - Utiliser un serveur local comme XAMPP ou WAMP.
   - Placer les fichiers du projet dans le répertoire `htdocs` ou `www`.
   - Accéder au site via `http://localhost/emporium-watches`.

## Utilisation

- **Catalogue** : Parcourir l'ensemble des produits disponibles.
- **Détails du produit** : Voir les informations détaillées d'une montre spécifique.
- **Panier** : Gérer les articles sélectionnés pour l'achat.
- **Commande** : Finaliser l'achat en suivant le processus de commande.
