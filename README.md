# SUPPORT - SYMFONY : FORMS

## OBJECTIFS

* Apprivoiser le concept de formulaire avec Symfony;

* Ajouter des chats en base de données, via un formulaire;

## INSTALLATION

Comme d'habitude 🙂 :

* Premièrement, clone ce dépôt : https://github.com/WildCodeSchool/php-support-symfony-forms.

* Lance `composer install` à la racine du projet.

* Lance `yarn install`.

* Lance `yarn encore dev`.

* Crée un fichier `.env.local` à partir du fichier `.env` à la racine du projet, et configure-le avec les informations de connexion à ta base de données.

## PREMIÈRE CLASSE : L'ENTITÉ

Première particularité : avec Symfony, dans la majorité des cas, le but d'un formulaire va être d'*hydrater une entité*. En effet, comme on travaille en POO, et grâce à Symfony, nous n'allons pas manipuler directement les données contenues dans `$_POST` (ou `$_GET`), et allons préférer manipuler des *objets*.

"Hydrater?!! Mais qu'est-ce que c'est encore que cette histoire?", t'endends-je t'exclamer. Et bien en fait, comme dit juste avant, tu ne vas pas manipuler directement `$_POST`, mais des objets, et pour ce faire, il faut bien que les données récupérées dans `$_POST` soient appliquées à un objet. C'est ce que ton formulaire Symfony va faire, et l'action d'*hydrater* une entité signifie juste : appliquer des modifications aux propriétés d'une entité 🙂.

Il nous faut donc une classe qui va représenter les données que nous allons récupérer via notre formulaire.

Ici, le but est dans un premier temps d'ajouter des chats en base de données, nous voulons donc créer une entité Doctrine `Cat`. Pour ce support, nous allons représenter nos chats uniquement grâce à un nom et une photo (une url). À toi de jouer!

> Si tu ne te souviens plus comment créer une entité, va voir [ce support](https://github.com/WildCodeSchool/php-support-symfony-doctrine) 😉.

## DEUXIÈME CLASSE : LE FORMULAIRE

L'entité, c'est fait, maintenant, au tour du formulaire! "C'est parti pour créer une vue avec nos *labels* et *inputs* alors?"

Et bien non 🤓. En fait, avec Symfony, tes formulaires seront aussi représentés par des classes. En effet, Symfony fonctionnant en POO, la représentation en classe va permettre le fonctionnement efficace et simplifié d'un certain nombre de choses, comme les validations de formulaires (mais nous verront ça un peu plus tard).

Chacune des *classes de formulaire* va prendre le nom de l'entité avec laquelle elle est liée, suivie du mot clé "Type", et sera rangée dans le dossier `src/Form`, et dans le namespace `App\Form`. Ainsi, pour créer un formulaire d'ajout de chats en base de données, nous allons créer une classe `CatType`. Par chance, le *maker bundle* du *binaire Symfony* est là pour nous aider! 😃

Lance `bin/console make:form` dans un terminal. On te demande d'abord de nommer ta classe de formulaire (donc pour nous, `CatType`, mais si tu indiques juste `Cat`, le *maker bundle* va ajouter le `Type` automatiquement). Ensuite, on te demande avec quelle entité ce formulaire sera lié (donc pour nous, `Cat`).

Une fois que tu as fait ça, observons ce qui s'est passé :

* Un dossier `Form/` a été crée dans `src/`;
* Un fichier `CatType.php` a été généré, avec dedans la définition d'une classe `CatType`;
* Dans cette classe, on observe deux méthodes :
  * `buildForm()` : comme son nom l'indique, c'est la méthode dans laquelle on va définir comment notre formulaire HTML sera fabriqué (quels champs, quels types d'inputs, quels labels, *etc*...)
  * `configureOptions()` : comme son nom l'indique ici aussi, c'est dans cette méthode que l'on va configurer les options 🙃. Très souvent, tu n'auras pas besoin de modifier cette classe, mais c'est entre autres ici que l'on peut configurer l'entité à laquelle le formulaire est lié.

## TROISIÈME CLASSE : LE CONTRÔLEUR

Ta classe de formulaire est désormais utilisable en soit, mais que va-t-on en faire désormais?

Il va effectivement bien falloir l'utiliser quelque part, et ce quelque part, c'est avant tout un contrôleur. Rends toi donc dans le `CatController`, et crée une méthode :

```php
/**
 * @Route("/add", name="add")
 */
public function add(Request $request): Response
```

"`Request $request`???" : et oui, avec Symfony, les informations envoyées via `$_POST` (entre autres), se trouvent dans un objet particulier de la classe `Symfony\Component\HttpFoundation\Request`. Tu en as donc besoin dans cette méthode, et pour l'utiliser, il suffit de l'*injecter* en paramètre de ta méthode 🙂. Attention, il ne faut pas que tu oublies d'ajouter le `use` qui va avec 😉.

Ensuite, nous avons besoin de 2 choses :

* Un formulaire `CatType`
* Un objet `Cat`, que notre formulaire va hydrater

Ajoute donc les 3 lignes suivantes dans le corps de ta méthode `add()` :

```php
$cat = new Cat();
$form = $this->createForm(CatType::class, $cat);
$form->handleRequest($request);
```

Ici, on instancie un nouveau `Cat`, puis on crée un nouveau formulaire `CatType` avec la méthode `createForm()`, en ajoutant `$cat` en second paramètre, puisque c'est l'objet l'on veut que notre formulaire *hydrate*. La troisième ligne quant à elle permet d'automatiser les étapes d'*hydratation* de ton objet `$cat` par ton formulaire `$form`.

> Note : il ne faut pas oublier d'ajouter les `use` qui vont avec `Cat` et `CatType` ❗

Grâce à ces trois lignes, les informations que l'utilisateur renseignera dans le formulaire se retrouveront automatiquement en valeurs des propriétés de ton `$cat` - tu pourras donc retrouver ces informations en utilisant les *getters* de ton objet `$cat` (exemple : `$cat->getName()` renverra le nom renseigné dans le formulaire par l'utilisateur 🙂).

## LA VUE

Maintenant, il faut bien qu'on affiche notre formulaire quelque part. Ajoute le code qui permet à ta méthode `add()` de retourner une vue `cat/add.html.twig`, et crée un fichier `add.html.twig` dans ton dossier `templates/cat/`, et pense bien à faire hériter ta vue de `base.html.twig`.

Cependant, comme dit plus tôt, on ne va pas écrire notre formulaire HTML en dur dans notre vue. Comme nous avons une classe qui représente notre formulaire (`CatType`), nous allons donc préférer laisser Symfony se débrouiller pour créer notre formulaire HTML en se basant sur cette classe.

Modifie le `render()` de ta méthode `add()` pour qu'il ressemble à ceci :

```php
return $this->render('cat/add.html.twig', [
    'form' => $form->createView(),
]);
```
<!--- {% raw %} --->
Ici, la méthode `createView()` va créer un objet manipulable par Twig à partir de ce qu'on trouve dans la classe `CatType`. On crée donc notre formulaire dans le contrôleur, et on l'envoie dans notre vue 🤓.

Comme on envoie notre formulaire dans notre vue sous la forme d'une *variable Twig*, il va bien falloir que nous allions modifier certaines choses dans la vue `cat/add.html.twig`. Dans le `{% block body %}`, ajoute le code suivant :

```twig
{{ form_start(form) }}
    {{ form_widget(form) }}
{{ form_end(form) }}
```

`form_start()` et `form_end()` sont des *fonctions twig* qui vont permettre de générer les balises ouvrante et fermante de ton formulaire, tandis que `form_widget()` va permettre d'afficher le contenu (inputs, labels, erreurs, *etc*...) de ton formulaire.

Allume ton serveur Symfony et rends toi dans ton navigateur à la route `/add`, tu devrais voir les champs de ton formulaire, avec en label les noms des propriétés de ta classe `Cat`. Cependant, il manque une chose! En effet, il manque un bouton 🤔. C'est la seule partie de ton formulaire qu'il faut que tu écrives en dur dans ta vue, juste avant la ligne `{{ form_end(form) }}`. Une fois que tu as ajouté ton bouton, tu devrais le voir apparaître.
<!--- {% endraw %} --->

Voilà, tu peux essayer de soumettre un formulaire, mais pour l'instant, il ne se passe rien 🙃. Nous verrons comment traiter notre formulaire dans quelques instants 🙂.

## PERSONNALISER LE FORMULAIRE

Tu aimerais maintenant afficher des *labels* différents de ceux utilisés par défaut pour les champs de ton formulaire : pour cela, plusieurs solutions, mais nous allons explorer l'idée de modifier ces informations dans notre classe de contrôleur `CatType`.

En allant voir ce qui s'y passe, tu peux remarquer que dans ta méthode `buildForm()`, tu retrouve un appel à la méthode `add()` appliquée à un objet `$builder` par champ de ton formulaire. C'est ici que tu vas personnaliser tes labels 🙂. Seulement attention, le second paramètre de cette méthode `add()` doit toujours être le nom d'une classe qui représente un *type d'input* particulier. Tu remarques que tes deux champs de formulaires générés dans ton site sont automatiquement des `input type="text"`, mais tu pourrais préciser le type de champ que tu veux en second paramètre de ta méthode `add()`. Exemple : ton champ `url` représente, et bien, une *url*, donc tu pourrais avoir envie qu'il soit un `input type="url"`. Tu peux donc modifier le `add()` associé à ce champ en : `add('url', UrlType::class)` (n'oublie pas le `use Symfony\Component\Form\Extension\Core\Type\UrlType;` qui va avec ❗). Recharge ta page, ton champ `url` devrait désormais appliquer des validations côté client pour le format de l'url 🙂.

Tu peux ensuite faire la même chose pour ton champ `name`, en lui appliquant le type d'input qui te semble le plus adéquat 🙂.

Maintenant que tu as fait ça, tu vas pouvoir ajouter un troisième paramètre à tes méthodes `add()`, sous la forme d'un tableau associatif, dans lequel tu vas ajouter tes options.

Pour personnaliser les labels, il te suffit donc de modifier tes deux méthodes de la manière suivante :

```php
->add('name', TextType::class, [
    'label' => 'The label you want'
])
```

Et voilà! 🤓

> Note : pour plus d'informations sur les types de champs et les options, voir [la doc](https://symfony.com/doc/5.2/forms.html) 🙃

## TRAITEMENT DU FORMULAIRE

Alors par contre, pour l'instant, il ne se passe toujours rien quand on soumet notre formulaire 🤔.

Ce qu'on veut, c'est ajouter un chat en base de données si jamais notre formulaire est bien soumis, et rediriger vers une page qui liste nos chats. Pour ça, rien de plus simple avec Symfony :

* Tu auras besoin de l'*Entity Manager* pour ajouter des informations en base de données, injecte-le donc en paramètre de ta méthode de contrôleur (`EntityManagerInterface $entityManager`, sans oublier le `use Doctrine\ORM\EntityManagerInterface` ❗)
* Ajoute le code suivant à ton contrôleur, avant ton return :
```php
if ($form->isSubmitted() && $form->isValid()) {
    $entityManager->persist($cat);
    $entityManager->flush();

    return $this->redirectToRoute('cat_index');
}
```

Ici, `$form->isSubmitted() && $form->isValid()` vérifie si le formulaire a été soumis et valide (nous verrons les validations un peu plus loin).

Ensuite, `$entityManager->persist($cat);` va indiquer à l'*Entity Manager* de suivre l'objet `$cat`, `$entityManager->flush();` va appliquer les modifications en base de données, et `return $this->redirectToRoute('cat_index');` va servir à rediriger vers la page qui affiche la liste des chats (qui, ici, est déjà préparée).

> Profite de cette occasion pour décommenter le code commenté dans la méthode `index()` de ton contrôleur.

Essaie à nouveau de soumettre ton formulaire en indiquant une url du type `https://placekitten.com/200/300?image={id}` où `{id}` est un nombre quelconque entre 0 et 16 : tu devrais retrouver un chat à la route `/` à laquelle tu devrais être redirigé·e 🐈.

## LES VALIDATIONS

C'est bien beau tout ça, mais en jouant un peu dans la console de ton navigateur, rien ne t'empêche de rentrer "bibi" dans le champ "url" lorsque tu ajoutes un chat.

Et oui, il nous manque une dernière étape : les validations! Et avec Symfony, c'est simple, plus besoin de faire plein de "if" dans notre contrôleur ou de créer des méthodes ou classes de validations : tout est prévu grâce aux annotations 🤩.

Et comme tes formulaires sont liés à des entités, c'est directement ces entités que tu vas annoter 🤓. Commence par ajouter `use Symfony\Component\Validator\Constraints as Assert;` dans ton fichier d'entité, et tu pourras ensuite ajouter des annotations `@Assert\UneValidation()` au dessus de chacune des tes propriétés de classe 🤩. Il existe tout un tas de validations prévues par Symfony, mais celles qui nous intéressent ici sont :
* `@Assert\NotBlank()` qui permet de valider qu'une propriété n'est pas vide (c'est l'équivalent de ce que tu faisait avec `empty()` quand tu écrivais tes validations toi même)
* `@Assert\Length(max=255)` va nous permettre de valider la longueur maximum d'un champ (avant Symfony, tu utilisais sûrement `strlen`)
* `@Assert\Url()` va nous permettre de valider le format d'une url (équivaut à `filter_var($maVariable, FILTER_VALIDATE_URL)`)

Tu te rappelles peut être ce que l'on a fait tout à l'heure dans notre contrôleur, lorsque l'on a ajouté `$form->isSubmitted() && $form->isValid()`? Et bien la méthode `isValid()` va justement se servir des annotations que tu a ajoutées pour lancer automatiquement les validations de ton formulaire.

Voilà! C'est tout de suite bien plus facile, non? 🤓

## CONCLUSION

Voilà qui clos ce troisième support Symfony sur les formulaires!
