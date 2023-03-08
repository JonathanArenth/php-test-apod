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
- require symfony/validator => permet de réaliser des Asssertion de vérification sur chaque attributs

# Lancement du projet
- composer install
- Ajouter la base de donnée dans le .env
- php bin/console doctrine:database:create => création de la base de donnée de dev
- php bin/console doctrine:migrations:migrate => envoie les migrations dans la base de donnée
- Ajouter la base de donnée dans le .env.test 
- php bin/console --env=test doctrine:database:create => créer la base de donnée de test
- php bin/console --env=test doctrine:schema:create => création du schéma de la base de test
- php bin/console --env=test doctrine:fixtures:load => charge les données de test dans la base de test
- NASA_API_KEY="votre clé api ici" est a ajouter dans le .env et le .env.test



# Lancement des tests:
php bin/phpunit

# Lancer la commande cli pour récupérer la photo du jour
php bin/console app:fetchPictureNasa
