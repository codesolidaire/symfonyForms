# SUPPORT - SYMFONY : DOCTRINE

## OBJECTIFS

* Apprivoiser les bases de Doctrine;

* Créer une entité "chat", parce que miaou 🐈;

* Créer une entité "humain" parce que les chats ont bien besoin de serviteurs 🙃.

## INSTALLATION

Pas de surprises, tu devrais déjà avoir fait ça une paire de fois désormais 🙂.

* Premièrement, clone ce dépôt : https://github.com/WildCodeSchool/php-support-symfony-doctrine.

* Lance `composer install` à la racine du projet.

* Lance `yarn install`.

* Lance `yarn encore dev` (ou `yarn encore dev --watch`).

* Créé un fichier `.env.local` à partir du fichier `.env` à la racine du projet, et configure-le avec les informations de connexion à ta base de données.

## "ENTITY", "REPOSITORY", KÉSAKO?

Comme tu as déjà dû t'en rendre compte, avec Symfony, le *modèle* (le **M** de **M**VC) ne ressemble pas à ce que tu as l'habitude de voir. En effet, avec le Simple-MVC, tu étais habitué·e à avoir des classes uniques représentant ton modèle : les *"Manager"*. Cependant, comme Symfony utilise **Doctrine** (un *ORM*), le *modèle* est divisé en deux parties distinctes : les *Entity* et les *Repository*. Revoyons ces quelques notions plus en détail.

### "DOCTRINE"? MAIS QU'EST-CE QUE C'EST QUE CES MANIGANCES?

Doctrine est un *ORM*, pour *Object Relational Mapping*. "Mais qu'est-ce donc qu'un ORM, et pourquoi diable utiliser ce type d'outils?!!", vous entends-je vous exclamer! 😱

Et bien en réalité, ce n'est pas si compliqué 🤓 : le concept d'ORM est basé sur le constat simple que la *gestion des bases de données* et la *programmation orientée objet* présentent un certain nombre de similitudes. En effet, dans les deux cas, l'un des buts est de représenter des entités (des choses concrètes ou abstraites), et leurs relations entre elles. Ainsi, on peut faire un certain nombre de parallèles entre ces deux notions, par exemple :

* Dans une BDD, une *entité* est représentée par une *table*, quand en POO, elle est représentée par une *classe*;

* Dans une BDD, chaque *représentant* d'une entité est un *tuple* (ou une *ligne*), tandis qu'en POO, on parle d'*instance de classe* ou d'*objet*.

* Dans une BDD, les *caractéristiques* d'une entité sont représentées par des *colonnes*, quand en POO, celles-ci prennent la forme de *propriétés de classe*;

* Dans une BDD, les *liens* entre les classes se font via des *clés étrangères* et des *tables intermédiaires*, alors qu'en POO, ceux-ci se font via des *propriétés de classe* représentant *une autre entité*;

Bref, tu l'as compris, la ressemblance est frappante! Au final, ta base de données va s'occuper de stocker des informations, tandis que la programation orientée objet va te permettre de les manipuler.

Doctrine est un outil qui va donc faire le parallèle entre ces notions, et va te permettre de te concentrer sur le code et la logique métier. Tu verras, avec Symfony, tu n'auras potentiellement plus du tout besoin d'aller trifouiller directement dans ton serveur MySQL 😉.

### UNE "ENTITÉ"? MOI J'APPELLE ÇA UN "TRUC"...

Comme vu plus haut, une entité, c'est au final une "chose" que tu as besoin de représenter - par exemple, un chat. Et dans Symfony en particulier, ce sera un type de classe spécifique, que tu rangeras en toute logique dans le dossier `/src/Entity` 🙃. Cette classe devra contenir au strict minimum les propriétés dont tu as besoin pour représenter ton entité dans la logique métier de ton application, et les getters et setters qui vont avec.

Dans l'exemple de nos chats, cela veux dire qu'on va avoir une classe `App\Entity\Cat`, avec quelques propriétés de classe, comme :

* Un identifiant unique
* Un nom
* Un lien vers une photo
* (etc...)

Ainsi que, encore une fois, les getters et setters associés.

Tu peux te dire que ça fait potentiellement beaucoup de code à écrire, mais ne t'inquiète pas, le *binaire Symfony* est là pour t'aider 😉.

### DES "MIGRATIONS"? C'EST UNE HISTOIRE D'OISEAUX ÇA, NON?

"Ok, jusque là, ça va, mais qu'en est-il des tables dans ma base de données?"

Et bien, tu n'as pas à t'en occuper, justement! À chaque fois que tu vas ajouter ou faire une modification sur une entité (donc dans une *classe suivie par Doctrine* du namespace `App\Entity` dans le dossier `/src/Entity`), tu vas pouvoir créer une *migration*. Une *migration* est un type de classe Symfony contenant des requêtes d'administration de base de données (en gros, des *"CREATE TABLE"*, *"ALTER TABLE"*, etc...).

Ensuite, une fois que tu as créé une migration, il te suffit de la lancer pour appliquer les modifications à ta base de donnée 🙂.

Tu pourrais très bien faire tout ça toi même à la main, mais ici aussi, le *binaire Symfony* est ton ami 😉. En plus, il se charge même de créer les clés étrangères et les tables intermédiaires quand tu as besoin de créer des relations entre tes entités! 🤩

Aussi, ce principe de migrations permet à toutes les personnes qui récupèrent un projet Symfony de récupérer aussi la structure de base de données qui va avec : il leur suffit juste de lancer toutes les migrations dans l'ordre au moment d'installer le projet, et hop, elles ont une base de données dans son état le plus récent!

### ET DES "REPOSITORY"? MAIS QUE VIENT FAIRE GITHUB DANS TOUT ÇA?

Ici, rien à voir avec les *repo GitHub*. En fait, les *Repository* ressemblent aux *Manager* du Simple-MVC. En effet, les *Entity* définissent la *forme* des choses que tu veux représenter, mais tu remarques que nulle part nous n'avons défini de méthodes permettant *d'interagir* avec ces entités en base de données (c'est à dire faire des requêtes de type *"INSERT INTO"* ou *"SELECT"*, par exemple) 🤔.

Et bien c'est justement le but des *Repository* en Symfony. Et comme avec le Simple-MVC, ces *Repository* possèdent un certain nombre de méthodes "prédéfinies", mais de façon beaucoup plus puissante que dans le Simple-MVC (en réalité, elles sont *fabriquées à la volée* 😉).

Dans la majorité des cas (mais pas dans *tous* les cas ❗), tu laisseras donc Symfony s'occuper de générer ces classes-ci automatiquement (encore grâce au *binaire Symfony*, je t'avais bien dit que ça allait être ton nouveau meilleur ami 😉), et tu n'auras pas souvent besoin d'aller les modifier "à la main" 🙂.

## À TOI DE JOUER!

Trèves de bavardages, essayons un peu tout ça!

Le projet que tu as récupéré est assez vide, et le but ne vas pas nécessairement être de travailler sur des contrôleurs et des vues, mais de se concentrer sur la création d'entités et la gestions des relations entre celles-ci.

Le but va être dans un premier temps de créer une entitié *"cat"*, relativement simple. Ensuite, nous créérons une seconde entité *"human"*, et nous verrons comment lier nos 2 entités. Nous n'allons pas voir comment ajouter / modifier / supprimer des valeurs en base de données, ce sera le sujet d'un autre groupe de support 😉.

### "HÉ MAIS ATTENDS! J'AI PAS ENCORE CRÉE MA BASE DE DONNÉES!"

En effet, avant tout chose, il faut créer une base de données avec les informations que tu as utilisées dans ton fichier `.env.local`. Pour cela, deux cas se présentent :

* Tu utilises l'utilisateur `root` ou un utilisateur générique ayant tous les droits nécessaires à la création et l'administration d'une base de données : dans ce cas, lance `bin/console doctrine:database:create` (ou `bin/console d:d:c`), et voilà, si tu as bien configuré ton fichier `.env.local`, tu ne devrais pas avoir d'erreur et avoir créé ta base de données 🙂;

* Tu décides de travailler avec un utilisateur spécifique à ton projet, dans ce cas : il faut que tu lances ton serveur de gestion de bases de données, que tu crées ta base et l'utilisateur qui va avec, et que tu lui donnes les droits sur cette base à la main - en effet, Doctrine ne prend pas en charge la création/gestion des utilisateurs, mais uniquement celles des bases de données. Tu peux ensuite lancer `bin/console doctrine:database:drop --force` (ou `bin/console d:d:d --force`) - si tu n'as pas d'erreur, c'est que ta database a bien été *supprimée* et donc qu'elle est bien configurée pour Doctrine, et tu peux lancer `bin/console d:d:c` pour la recréer 😉.

### "OK, ET MAINTENANT ON CODE L'ENTITÉ ET LE REPO POUR MES CHATS, C'EST ÇA?"

Disons que nous voulons que nos chats soient représentés par :

* leur nom,
* une photo (sous la forme d'une url),

et c'est tout.

On pourrait se dire qu'il faut commencer par créer une classe Cat, qu'on lui ajoute les propriétés qui vont bien, les getters et setters, etc... Et bien non! Enfin, si, mais pas à la main, car rappelle-toi : ***le binaire Symfony est ton ami*** 😉.

En effet, le *maker bundle* de Symfony possède une commande `bin/console make:entity` justement pour faire tout ça 🤩. 

Essaie de la lancer, et suis les différentes étapes :

* on commence par te demander le nom que tu veux donner à ton entité - en toute logique, réponds "Cat" 🙃;

* ensuite, on te demande d'ajouter des propriétés, et d'appuyer sur entrée lorsque tu as terminé
  * à chaque fois, commence par indiquer le nom de la propriété (donc *"name"* pour la première, et *"url"* ou *"image"* pour la seconde),
  * après le nom, on te demande ensuite d'indiquer le type de la propriété (donc *"string"* dans les deux cas pour nous),
  * et enfin, on te demande de préciser si cette propriété peut être nulle en base de données (donc non dans les deux cas, pour nous).

Et voilà! Tu peux appuyer sur *Entrée* quand tu as terminé de configurer ces deux propriétés, et aller voir tout ce qui a été fait pour toi!

Tu peux donc remarquer que :

* ton entité *Cat* a été créée, avec toutes les propriétés que tu as indiquées et les getters et setters qui vont bien (ainsi que les `use` et la déclaration du `namespace`);

* ton *Entity* possède aussi une propriété `$id`, que tu n'as pas eu besoin de préciser au *maker bundle* (et le getter et setter qui vont avec);

* ton *Entity* et chacune de ses propriétés possèdent une annotation `@ORM` permettant à *Doctrine* de savoir comment les gérer;

* le *Repository* associé à ton entité *Cat* - le *CatRepository* - a aussi été généré automatiquement;

* le *maker bundle* t'indique la marche à suivre pour la suite :
  
```shell
Next: When you're ready, create a migration with php bin/console make:migration
```

Bref, tout ça en répondant vite fait à quelques questions en lignes de commande, c'est quand même bien cool! 🤩

### "ET DU COUP MAINTENANT ON MIGRE, C'EST CHAT?"

Yup! Maintenant qu'on a fait le côté POO, il faut s'occuper du côté BDD. En effet, si tu vas voir dans ton serveur MySQL, tu remarqueras que pour l'instant, il ne s'est rien passé dans ta base de données.

Pour que les modifications de ton *modèle* soient prises en compte côté BDD, il faut dans un premier temps créer une migration. Ici encore, le *maker bundle* est là pour toi 🥰.

Lance `bin/console make:migration`. Un fichier de migration a été créé dans le dossier `/migrations` (sans surprise 🙃). Dans ce fichier, tu trouveras une classe de migration contenant principalement une méthode `up()` et une méthode `down()` :

* La première sert à appliquer les modifications permettant de mettre à jour la base de données par rapport à son état précédent (donc ici, elle crée la table "cat" avec toutes les caractéristiques demandées, puisqu'elle n'existait pas encore);

* La seconde sert à faire revenir la base de données dans l'état dans lequel elle était avant la création de la migration (donc ici, elle détruit la table "cat").

Maintenant, plus qu'à appliquer cette migration en lançant `bin/console doctrine:migrations:migrate` (ou `bin/console do:mi:mi` pour les musicien·ne·s 🎵).

Une fois que tu as fait ça, vas voir dans ton serveur MySQL : ta base de données a bien été mise à jour avec la table `cat`, ainsi qu'une table auto-générée `doctrine_migration_versions`. En effet, cette table permet à Doctrine de savoir où il en est au niveau des migrations : lorsque tu lances `bin/console do:mi:mi`, Doctrine va commencer par aller vérifier s'il y a des migrations dans ton dossier `/migrations` qu'il ne trouve pas dans la table `doctrine_migration_versions`, et va simplement reprendre là où il s'était arrêté 🙂.


### "LES CHIENS ONT DES MAÎTRES, LES CHATS ONT DES SERVITEURS"

Et voilà que tu as créé une première entité! Maintenant, compliquons un peu les choses 🙂. Disons que nous voulons aussi représenter les fidèles serviteurs des chats - les *"humains"* - et leurs relations ("maître" - "serviteur"). Imaginons donc qu'**un chat peut avoir plusieurs serviteurs**, et  **un humain peut avoir plusieurs maîtres** (dans le cas d'une "garde partagée").

Nous allons donc créer une entité `Human` avec quelques propriétés :

* name
* masters

et c'est tout.

Pour cela, même démarche que pour la création de notre entité `Cat` : on met à profit le *maker bundle*. Cependant, quand tu vas créer ta propriété `masters`, que va-t-on indiquer lorsque le *maker bundle* nous demandera le type de la propriété? Et bien tout est prévu : il te suffit d'indiquer le type *"relation"*, et le *maker bundle* te posera quelques questions et te guidera dans la création de cette propriété 🤩 : 

* en premier, il te demande quelle est l'entité avec laquelle cette relation sert de liaison, donc pour nous, `Cat`;

* ensuite, il te propose de choisir parmi tous les types de relations dont tu pourrais avoir besoin, avec même des indications sur ce qu'elles signifient 🤩 :

```shell
What type of relationship is this?
------------ ---------------------------------------------------------------- 
  Type         Description                                                     
------------ ---------------------------------------------------------------- 
 ManyToOne    Each Human relates to (has) one Cat.                            
              Each Cat can relate to (can have) many Human objects            
                                                                               
 OneToMany    Each Human can relate to (can have) many Cat objects.           
              Each Cat relates to (has) one Human                             
                                                                               
 ManyToMany   Each Human can relate to (can have) many Cat objects.           
              Each Cat can also relate to (can also have) many Human objects  
                                                                               
 OneToOne     Each Human relates to (has) exactly one Cat.                    
              Each Cat also relates to (has) exactly one Human.               
------------ ----------------------------------------------------------------
```

Ici, on a dit que chaque humain peut être lié à plusiquers chats, et chaque chat peut avoir plusieurs humains : on a donc une relation de type *ManyToMany*.

* après ça, on te demande si cette propriété est nullable, pour nous, on va dire que oui (dans le cas d'un "humain de gouttière", dirons nous);

* on a presque terminé : on te demande si tu veux ajouter une propriété à la classe pour accéder à tous les humains en relation avec un chat donné : cela te donne le choix de rendre la relation *bidirectionelle*, ou de la laisser *unidirectionelle*. Si tu réponds non, tu pourras accéder aux données concernant les chats associé à un humain, mais pas aux données de tous les humains en relation avec un chat donné, car tu n'as pas créé de propriété dans la classe `Cat` te permettant de le faire : on parle de relation *unidirectionelle*. Dans notre cas, bien au contraire, on aimerait pouvoir récupérer la liste des serviteurs d'un chat en particulier : réponds donc "yes" pour créer une relation *bidirectionelle*.

* enfin, on te demande comment tu veux nommer cette nouvelle propriété de la classe `Cat`. Tu pourrais laisser la proposition par défaut "humans", mais pour être plus parlant, et de la même manière que nous avons appelé le champ côté `Human` "masters", appelons celui-ci "servants" 🙃.

Et voilà! Ton entité est créée, allons voir ce qui s'est passé de plus près :

* ton entité `Human` a bien été générée, ainsi que le `HumanRepository` qui va avec;

* les propriétés `masters` et `servants` sont bien présentes, et annotées entre autres avec `inversedBy` pour la propriété `masters`, et `mappedBy` pour la propriété `servants` :

  * `inversedBy` sert à indiquer que la classe dans laquelle elle se trouve est "propriétaire de la relation" entre `Human` et `Cat`. C'est une notion qui peut paraître floue dans un premier temps, mais le principal est de comprendre que lorsque tu vas vouloir faire une modification en base de données, il sera impératif de mettre à jour la propriété annotée par `inversedBy` si tu veux que ta modification soit prise en compte.

  * `mappedBy` sert à désigner "l'autre côté" de la relation : si tu fais des modifications sur cette propriété uniquement, la mise à jour des informations en base de données n'aura pas lieu - cette propriété ne sert "qu'à" rendre la relation *bidirectionelle*.

Maintenant, plus qu'à créer une migration et à la lancer afin de mettre ta base de données à jour 🙂. Répète donc les instructions qu'on a lancées tout à l'heure pour nos chats!

Une fois que c'est fait, va voir dans ton serveur MySQL : tu remarques en faisant un `SHOW TABLES` que Doctrine a créé la table `cat`, mais aussi la table intermédiaire `human_cat` 🤩. En effet, avec Symfony, pas besoin de t'occuper des tables intermédiaires, tout comme les clés étrangères (ou primaires, d'ailleurs 🙃) : c'est Doctrine qui s'occupe de tout! Il suffit de bien lui indiquer le type de relation que tu as besoin de créer lorsque tu lances le *maker bundle*, et tout devrait bien se passer 🙂.

## CONCLUSION

Voilà qui clos ce second support Symfony sur les bases de Doctrine, on se retrouve peut être pour le suivant, dans lequel on va parler des formulaires Symfony!
