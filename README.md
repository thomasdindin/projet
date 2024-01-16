# All4Sport

Bienvenue sur le projet AP 3 **All 4 Sport** du groupe composé de : 
- SAID Amanie 
- DINDIN Thomas
- DROZDZ Maxence
- LECLERCQ Fednail (?)

# Installation 

Une fois le projet téléchargé, tapez la commande :
```
composer install
```
Pour installer les dépendances. 

Ensuite, rendez vous dans le fichier .env, à la ligne 29 et modifiez les informations de cette ligne : 
```
DATABASE_URL="mysql://root:@127.0.0.1:3306/all4sport2?serverVersion=8.1.0&charset=utf8mb4"
```
Vers les informations de la base de donnée que vous voulez créer. 
> La base de donnée sera créée ultérieurement.

**Par exemple, ici :**
- "root" est le nom d'utilisateur de votre service de gestion de bases de données,
-  "127.0.0.1:3306" est l'adresse IP où la base de donnée est située. 3306 est le port.
-  "all4sport" est le nom de la base de données
-  "serverVersion=8.1.0&charset=utf8mb4" est la version du serveur utilisée ainsi que le charset associé.

Maintenant, on peut créer la base de données : 
```
php bin/console doctrine:database:create
php bin/console doctrine:make:migration
php bin/console doctrine:migrations:migrate
```

Et charger les fixtures : 
> Note : les fixtures sont un jeu de données de test qui sert à prouver le bon fonctionnement de l'application. Dans le cadre d'une application réelle, il n'est pas obligé de les charger. 
```
php bin/console doctrine:fixtures:load
```

Enfin, vous pouvez lancer le serveur : 
```
symfony server:start
```

> Note : En cas d'erreur, vérifier que le serveur n'est pas déjà en marche. Vous pouvez l'arrêter et le redémarrer avec :
> ```
> symfony server:stop
> ```

En cas de problème avec l'installation de Symfony, vous pouvez vous référer à la [documentation d'installation](https://symfony.com/doc/current/setup.html).


 # Fonctionnement 
 Le projet utilise Symfony et respecte l'architecture MVC:
 - Les modèles sont situés dans le fichier `src/Entity`
 - Les controllers sont situés dans le fichier `src/Controller`
 - Les vues sont situées dans le fichier `templates`.

## ArticlesController
Ce controller est en charge de l'affichage de tous les articles sur la page d'accueil, et de l'affichage d'un seul article.

## CategorieController
Ce controller est en charge de l'affichage par catégorie (ex : quand on clique sur voir tout).

## CommandesController
Ce controller sers à gérer le suivi des commandes.

## HeaderController
Ce controller gère le Header.

## LoginController
Ce controller sers à se connecter et à se déconnecter.

## LogistiqueController
Ce controller est en charge de la gestion des stocks. Il permet de consulter la quantité de produit par entrepôts, voir le rangement, consulter tous les entrepôts...

## PanierController
Ce controller permet de gérer le panier et l'affichage de son contenu.
## ProfilController
Ce controller permet de consulter son profil

## RegistrationController
Ce controller permet l'inscription d'un membre.

Vous pouvez aussi consulter le workflow pour mieux comprendre le fonctionnement de l'application.
