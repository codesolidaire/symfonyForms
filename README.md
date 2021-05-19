# SUPPORT - SYMFONY : LES BASES

## OBJECTIFS

* Apprivoiser l'arborescence d'un projet Symfony;

* Apprendre à se lancer dans le développement d'un projet Symfony;

* Comprendre le fonctionnement du routing de Symfony avec la mise en place d'un contrôleur basique;

* Afficher des photos de chats, parce que les chats c'est trop meugnon 😽.

## INSTALLATION

* Premièrement, clone ce repo, qui est basé sur le *starter kit* à partir duquel tu vas démarrer ton projet 3, qui a été préparé avec amour par ton/ta formateur·ice ❤️.

* Ce repo, comme celui du Simple-MVC, contient un `composer.json` ainsi qu'un `composer.lock`, c'est donc qu'il y a potentiellement des dépendances PHP à installer : lance `composer install` pour télécharger toutes tes dépendances PHP dans le dossier `/vendor`, alors automatiquement généré par *Composer*.

* Tu te rends compte que ce repo possède aussi un fichier `package.json`, ainsi qu'un `yarn.lock` : effectivement, au delà des dépendances PHP, tu auras aussi besoin de dépendances Javascript pour certaines fonctionnalités (comme la gestion des assets). Tu vas donc devoir utiliser *Yarn*, un gestionnaire de paquet spécifique aux dépendances JS, et lancer `yarn install`. De la même manière que les dépendances installées via *Composer* sont téléchargées dans `/vendor`, celles installées via *Yarn* sont téléchargées dans le dossier `/node_modules`.

* Ensuite, lance `yarn encore dev`. Cette commande va lancer **Webpack-Encore**, l'une des dépendances JS que tu as installées, qui va créér un *build* de tes assets (nous allons revoir ça un peu plus loin).

* Enfin, tu dois configuer tes informations de connexion à ta base de données : avec Symfony, en phase de développement, cela ce fait dans un fichier `.env.local` (**non versionné ❗**), que tu dois créér toi même en copiant le fichier `.env` à la racine du projet, et configurer la ligne commençant par `DATABASE_URL="mysql://`.

Et voilà, tu devrais être prêt·e à travailler sur ton projet Symfony! Plus qu'à lancer `symfony serve` à la racine de ton projet pour lancer ton serveur (c'est un peu comme un `php -S localhost:8000 -t public`, mais avec des outils en plus), et à te rendre à `localhost:8000` dans ton navigateur, pour y voir un magnifique GIF animé sur fond de couleur rose-wild 🙂.

## L'ARCHITECTURE

Un projet Symfony basique utilise une architecture de type MVC. Pas de grande surprise donc, les principes généraux sont les mêmes que pour le Simple-MVC. Faisons un tour rapide des dossiers qui nous intéressent aujourd'hui :

### /public

Ici, même principe que pour le Simple-MVC : ce dossier va principalement contenir ton fichier index.php, seule porte d'entrée de ton application. Tu peux aussi observer un dossier `/build` non versionné, mais nous verrons ça juste un peu plus loin 😉.

### /src

On retrouve un dossier `/src`, contenant la logique de ton application. Dedans, on trouve un dossier `/Controller` dans lequel tu rangeras tes **contrôleurs** (en toute logique). Petite nuance : ces **contrôleurs** devront toujours renvoyer un objet de la classe Symfony `Response`, qui représente une réponse HTTP complète, ce qui peut contenir entre autres un document HTML.

Comme pour le Simple-MVC, chaque *méthode* d'une classe de **contrôleur** est liée à une *route*. Seulement ici, plus besoin de se casser la tête avec des histoires de nom de la classe suivie du nom de la méthode auquel on aditionne le nombre moyen de dents d'une girafe! En effet, tu es ici complètement maître·sse de la tête qu'auront tes routes, en utilisant l'annotation `@Route`. Nous n'allons pas nous attarder maintenant sur cette notion, c'est plus parlant avec des exemples 😉.

On trouve aussi un dossier `/Entity` et un dossier `/Repository`, qui, à eux deux, représentent ton **modèle**, mais nous reviendrons sur ces notions lors d'un autre groupe de support.

Tu peux aussi voir un dossier `/DataFixtures`, mais ce dossier là aussi sera abordé une autre fois 😉.

### /templates

Petite variation par rapport au Simple-MVC, les **vues** sont rangées hors du dossier `/src`, dans un dossier à part nommé `/templates` (notez bien : template**S**, au pluriel 😉).

À part ça, pas de surprise majeure pour les vues : c'est du *Twig* comme tu en as déjà utilisé pour ton projet 2 🙂.

### /assets

Tu as dû remarquer ce dossier `/assets` tout là haut, bien loin du dossier `/public` où tu as l'habitude de le voir! Non, il ne boude pas, il est bien là pour une vraie raison.

En effet, **Webpack-Encore** te permet de créer automatiquement des *builds* utilisables à partir des *assets* que tu vas ranger dans le dossier `/assets`, et ce sont ces *builds* que tu pourras retrouver dans `/public/build`.

Exemple : pour des raisons d'efficacité et de lisibilité de ton code, tu décides de coder tout ton style en *scss*. Seulement, les navigateurs ne pouvant lire le *scss*, il faut faire passer ce dernier par une étape de *compilation* en *css* pour obtenir une feuille de style utilisable par ton navigateur. C'est ici qu'intervient **Encore**, en te proposant par exemple de compiler ton *scss* en *css*, soit à chaque fois que tu lui demandes en lançant `yarn encore dev` (comme tu l'as fait durant l'étape d'installation), ou même automatiquement à chaque fois que tu modifies un fichier situé dans `/assets` en lançant `yarn encore dev --watch`.

Mais ce n'est pas tout : **Encore** peut aussi faire d'autres choses, comme *minifier tes assets* pour l'environemment de production, etc...

## À TOI DE JOUER !

C'est pas tout ça de bavarder, mais il serait temps d'essayer un peu tout ça! Commençons donc par... tout casser! En effet, le *starter kit* concocté par tes formateur·ice·s d'amour contient déjà un fichier `src/Controller/HomeController.php` (supprime le), ainsi que le dossier `/templates/home` qui y est associé (supprime le aussi 🙃). Enfin, tu peux supprimer le style préconfiguré pour le `body` dans le fichier `assets/styles/app.scss`, mais n'oublie pas de relancer `yarn encore dev` pour relancer un _build_ et que tes modifications de style soient prises en compte!

Une fois que c'est fait, nous allons pouvoir nous lancer dans une tâche des plus importantes! Nous allons créer des pages qui affichent des photos de leurs Majestées Velues, Seigneurs du Web et Souverains des Réseaux : les Chats 🐈.

### "TON AMI C'EST MOI, TU SAIS, JE SUIS TON AMI" - LE BINAIRE SYMFONY

*"Feurst fingz feurst"*, comme disent nos camarades d'Outre-Manche : lorsque l'on veut que notre application affiche une page web, on commence par mettre en place la route qui est associée à cette page, et donc le contrôleur qui va bien.

Et c'est là que tu vas commencer à goûter à toute la puissance de ton nouveau meilleur ami : le **Binaire Symfony** 🤯. En effet, à partir de maintenant, ce dernier va te permettre de faire un certain nombre d'actions - comme générer des fichiers ou des bouts de code automatiquement (mais pas que 😉) - ce qui te fera gagner un temps considérable!

Essaie donc d'utiliser le *maker bundle* en lançant la commande `bin/console make:controller`. On ne te demande alors qu'une chose : de donner un nom à ta classe de **contrôleur**. Appelons-la juste *"Cat"*.

Une fois cette unique étape passée, tu remarques plusieurs choses :

* Un fichier `CatController.php` a été généré dans ton dossier `src/Controller`, contenant la définition d'une classe de contrôleur basique nommée `CatController`, sans que tu aies eu besoin de préciser *"Controller"* lorsque l'on t'a demandé de nommer ta classe;

* Tous les `use` fondammentaux dont une classe de **contrôleur** Symfony a besoin sont déjà là, ainsi que le `extends` qui va bien;

* Une méthode `index()` simple a été générée à titre d'exemple, qui renvoie bien un objet de la classe `Response`, (ce qui inclut ici entre autres la vue twig `/templates/cat/index.html.twig` compilée en HTML, comme pour le Simple-MVC);

* Cette dernière méthode possède une annotation `@Route`, qui définit la route associée à cette méthode à `/cat`, et la nomme `cat`;

* Un dossier `/cat` a été généré dans `/templates`, contenant une vue `index.html.twig` ici aussi à titre d'exemple.

Bref, pas mal de choses se sont passées, essayons d'ammadouer tout ça!

### HELLO, KITTY !

Commençons une fois de plus, et en l'honneur de nos adorables (et vénérables) Chefs Suprêmes... par tout casser 🙃.
<!--- {% raw %} --->
Vide donc les `{% block body %}` et `{% block title %}` de leur contenu généré automatiquement dans ton fichier `cat/index.html.twig`. Dans la méthode `index()` de ton `CatController`, supprime aussi l'envoi du nom du contrôleur dans ta vue.
<!--- {% endraw %} --->
Une fois que tu as fais ça, ajoute un `<h1>` contenant le titre de ton choix à ta vue dans ton `{% block body %}`, ainsi qu'un `<p>`, par exemple, contenant `Cat #{{ id }}`.

Essaie donc ensuite d'injecter une variable `id` (un nombre en dur) dans ta vue depuis ton contrôleur. Pas de surprise ici, c'est du Twig comme tu en as déjà vu. En te rendant à `localhost:8000/cat` tu devrais donc voir `Cat #4` lorsque tu envoies le nombre *4* en id à ta vue.

Maintenant, passons aux choses sérieuses.

Placekitten est une photothèque permettant de récupérer des photos de chats et chatons trop meugnons 🐱. Elle contient 16 photos. Remplace donc ton `<p>` par `<img src="https://placekitten.com/400/500?image={{ id }} alt="a cute cat">`. Si l'`id` que tu envoies à ta vue est bien un nombre entier entre 1 et 16, tu devrais désormais voir une magnifique photo de chat! Essaie de changer l'`id` que tu envoies depuis ton contrôleur, la photo devrait changer 🙂.

### "ET J'ÉTAIS SUR LA ROUTE TOUTE LA SAINTE JOURNÉE" - TOI

On peut récupérer nos photos de chats, cela dit on aimerait bien laisser à l'utilisateur le choix de la photo qu'il veut voir. Rien de plus simple avec Symfony, il suffit de passer notre `id` en paramètre de notre contrôleur, et de modifier son annotation `@Route`, pour récupérer l'`id` demandé par l'utilisateur.

Une fois modifié, ton contrôleur devrait ressembler à ça :

```php
/**
 * @Route("/cat/{id}", name="cat")
 */
public function index(int $id): Response
{
    return $this->render('cat/index.html.twig', [
        'id' => $id,
    ]);
}
```

Et c'est tout 🙂. Cela dit, attention, ta route `/cat` n'est désormais plus valide! En effet, à partir de maintenant, si tu veux afficher une photo de chat, il faut que tu ailles à la route `/cat/{id}`, en remplaçant `{id}` par un nombre entre 1 et 16. Essaie d'aller à `/cat/3` par exemple, tu devrais voir une photo de chat tigré dans la neige, et à `/cat/11`, tu devrais avoir un chaton blanc trop mignon 🙃. C'est bien que cet `id` est récupéré automatiquement dans ta route par le routeur Symfony via l'annotation `@Route`, et est ensuite utilisable dans ton contrôleur en lui passant `$id` en paramètre. Le routeur Symfony est intelligent, il fait directement le lien entre l'`id` de l'annotation `@Route` et `$id`, le paramètre de ta méthode `index` 🙂.

On est pas mal, mais on aimerait quand même pouvoir naviguer autrement que via la barre d'adresse. Nous pourrions par exemple ajouter des liens "photo suivante" et "photo précédente" à notre page 🙂.

Par contre attention, avec Symfony, on n'écrit plus les routes en dur dans l'attribut `href` de nos liens : on va préférer utiliser une *fonction Twig* nommée `path()`. Cette fonction prend en premier paramère le *nom* d'une route (celui configuré dans l'annotation `@Route` 😉), et peut prendre un deuxième paramètre sous la forme d'un *tableau Twig* contenant les valeurs que l'on va passer en argument de notre contrôleur. Exemple :

```twig
<a href="{{ path('nom_de_la_route', {param1: valeur1, param2: valeur2}) }}">Un lien</a>
```
Ici, pour nos deux liens, le nom de la route devrait être *"cat"*, et nous n'avons qu'un seul paramètre - `id` - qui devrait être égal dans un cas à l'`id` actuel plus un, et dans l'autre à l'`id` actuel moins un. Au boulot!

Mais pourquoi s'embêter à donner des noms à nos routes? Et bien essayons quelque chose : imaginons que nous voulions modifier la route que nous avons créée. Dans l'annotation `@Route` de ta méthode `index()`, remplace `/cat/{id}` par `/cute-cat/{id}`. Rends toi ensuite dans ton navigateur à `localhost:8000/cute-cat/11` par exemple, et essaie d'utiliser tes liens "précédent" et "suivant". Surprise, ils marchent toujours! Même si la route a changé, tu n'as pas eu besoin de modifier tes liens pour qu'ils fonctionnent car le *nom de la route* est, lui, resté le même 🙂.

Tes boutons "précédent" et "suivant" sont bien beaux, mais tu aimerais pouvoir donner à ton utilisateur la possibilité de sauter d'une image à une autre sans devoir parcourir toute la phototèque de placekitten. Maintenant que tu sais créer des liens avec Symfony, à toi de créer tous ces liens sous la forme que tu veux 🙂 (une navbar à inclure dans base.html.twig avec une boucle twig allant de 1 à 16 par exemple? 😉).

## CONCLUSION

Voilà qui clos ce premier support sur les bases de Symfony, on se retrouve peut être pour le suivant, dans lequel on va parler bases de données avec Doctrine!
