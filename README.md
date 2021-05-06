# Simple MVC

## Description

Projet Team Javoy. 

Partie visiteur => Voir les produits dispo afin de passer commande.
Suivre les actualités.
Connaitre le savoir-faire

Partie admin => Ajouter/ modifier/ supprimer produit
 Ajouter/ modifier/ supprimer actualité
 gérer les commandes
 
## Steps

1. Clone the repo from Github.
2. Run `composer install`.
3. Create *config/db.php* from *config/db.php.dist* file and add your DB parameters. Don't delete the *.dist* file, it must be kept.
```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PWD', 'your_db_password');
```
4. Import `JavoyDb.sql` in your SQL server,
5. Create folder " uploads " at "orleans-php-202103-project-javoy/public/uploads"
6. Run the internal PHP webserver with `php -S localhost:8000 -t public/`. 
7. Go to `localhost:8000` with your favorite browser.


## Example 

An example (a basic list of items) is provided (you can load the *simple-mvc.sql* file in a test database). The accessible URLs are :

* Home page at [localhost:8000/](localhost:8000/)
* product list at [localhost:8000/Category/index](localhost:8000/Category/index)
* Product details [http://localhost:8000/Product/show/1](http://localhost:8000/Product/show/1)
* Admin list product [http://localhost:8000/adminListProduct/index](http://localhost:8000/adminListProduct/index)
