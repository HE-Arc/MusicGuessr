Pour lançer le site en développement:

php artisan serve

Si le site affiche une erreur 500, copier le fichier .env.example et nommer la copie .env.
Ensuite, lançer:

php artisan key:generate

Puis relançer le serveur:

php artisan serve

Ca a fonctionné chez moi x) (Par Maëlys)
