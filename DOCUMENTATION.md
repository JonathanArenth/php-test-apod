# technologies
- php 8.1.9
- Symfony 5.2.* (imposé dans le projet)
- Symfony flex => gestion automatique des dépendances
- Doctrine => ORM pour le mappage avec la base de données
- Maker bundle => pour la création des entités / controller / fixtures...
- MySQL => choix du sgbd
- symfony/test-pack => pour l'écriture des tests en mode dev
- orm-fixtures => pour générer des données de test
- symfony/http-client => pour effectuer les requêtes à l'api de la Nasa
- dama/doctrine-test-bundle => annule les transaction de base de donnée une fois le test effectuer
- symfony/validator => permet de réaliser des Asssertion de vérification sur chaque attributs
- Twig = > pour rendre les vues
- knpuniversity/oauth2-client-bundle => pour la connexion avec le service OAuth2
- league/oauth2-google => provider pour l'api google
- Symfony/security => gère les autorisations, les providers
- webpack-encore => pour gérer le css
- friendsofsymfony/jsrouting-bundle => pour pouvoir apeller les routes depuis le js

# Configuration du projet
- Ajouter la base de donnée dans le .env
- composer install
- npm install
- php bin/console doctrine:database:create => création de la base de donnée de dev
- php bin/console doctrine:migrations:migrate => envoie les migrations dans la base de donnée
- Ajouter la base de donnée dans le .env.test 
- php bin/console --env=test doctrine:database:create => créer la base de donnée de test
- php bin/console --env=test doctrine:schema:create => création du schéma de la base de test
- php bin/console --env=test doctrine:fixtures:load => charge les données de test dans la base de test
- NASA_API_KEY="votre clé api ici" est a ajouter dans le .env et le .env.test
- GOOGLE_CLIENT_ID="votre clé api ici" a ajouter dans le .env
- GOOGLE_CLIENT_SECRET="votre clé secrete ici" a ajouter dans le .env

# Lancement des tests:
php bin/phpunit

# Lancer la commande cli pour récupérer la photo du jour
php bin/console app:fetchPictureNasa

# lancer les server local
symfony server:start
npm run watch ou npm run dev-server