Pour lançer le site en développement:

php artisan serve

# Erreur 1
En cas d'erreur de type:

Warning: require(/home/laravel/project/MusicGuessr/public/../vendor/autoload.php): Failed to open stream: No such file or directory in /home/laravel/project/MusicGuessr/public/index.php on line 34

Fatal error: Uncaught Error: Failed opening required '/home/laravel/project/MusicGuessr/public/../vendor/autoload.php' (include_path='.:/usr/local/lib/php') in /home/laravel/project/MusicGuessr/public/index.php:34 Stack trace: #0 {main} thrown in /home/laravel/project/MusicGuessr/public/index.php on line 34

lançer la commande

composer install

# Erreur 2

Si le site affiche une erreur 500, copier le fichier .env.example et nommer la copie .env.
Ensuite, lançer:

php artisan key:generate

Puis relançer le serveur:

php artisan serve

Ca a fonctionné chez moi x) (Par Maëlys)
