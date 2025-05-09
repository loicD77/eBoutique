# Projet LEFA – Loïc Darras  
Licence Pro Projet Web et Mobile (L3) – Sorbonne Université  
**Mai 2025**

---

## Présentation

LEFA est une plateforme Symfony de vente de formations en ligne, développée dans le cadre de ma licence professionnelle. Ce projet représente pour moi un défi personnel et technique, entrepris malgré l'absence de stage et un niveau encore en apprentissage. J’y ai mis toute ma persévérance et ma volonté de progresser en développement web.

---

## Objectif de mon site "LEFA" fais sur symfony : 

J'ai tenté de créer un site sérieux de eboutique de e-learning spécialisé dans cinq catégories:
- **Management** (id=1)
-  **Finance**   (id=2)
-  **Marketing** (id=3)
- **Innovation** (id=4)
- **Développpement durable** (id=5)


---







## Résumé des fonctionnalités :


- Login (connexion): OK mais approche un peu limite (mets le message "Invalid credentials" en cas d'erreur de mot de passe)
- Inscription : Ok mais sécurité et vérification affreuse selon mes mots (par exemple possible de mettre seulement "loic" comme mot de passe et "x" comme adresse.. )
- Parcourir par catégorie : OK (On parcours à l'aide de routes avec un id à chaque thème)
- Parcourir des articles : OK juste la possibilité de voir un titre et une légère decription de chaque formation
- Mise au panier : OK
- Ajustement des quantités au panier avec le prix total : Ok avec frais de livraison en apparence
- Message de commande faite: OK (avec adresse indiqué dessus)
- Ajout d'un nouveau type d'article proposé: OK en tant qu'admin
- Ajout d'une nouvelle catégorie : NON
- Inscription : OK



## (HORS SUJET) Explication détaillé de mon code :



### 1) HomeController.php


- Ici, c'est le controller de la page d'accueil , j'hérite de **AbstractController**, une classe fournie par Symfony qui contient plein de méthodes utiles pour notre projet (render(), redirectToRoute(), addFlash , etc...) pour simplifier le développement (elle fournit des "helper methods" selon linkedin : https://fr.linkedin.com/learning/l-essentiel-de-symfony-4/utiliser-la-classe-abstractcontroller)


- La méthode render  (fournit donc par AbstractController) :


  Elle va rendre une vue ou templates et en second paramètre un tableau permettant d'envoyer des messages ('message' => 'j'écris ici mon message') ou un nom de controller ('controller_name' => 'Xcontroller)


  J'ai donc dans ce controler plusieurs fonctions (index(), contact(), about()) qui contiennent des renders pointant vers différents fichiers twing

  ### 2) OrderController.php :


  Dans cette classe on gère les commandes , avec la vérification par user.
 - On retient ici createNotFoundException **qui permet de lever une erreur 404** quand la commande n'est pas trouvé par :

 
 ```
 $order = $ordersRepository->find($id)

 ```

 Selon le site de David Annebicque  :



 _"Un repository est une classe qui permet de faire des requêtes sur une table (par l'intérmédiaire de l'eentité associée) de la base de données. Dans Symfony, lorsque vous ajoutez une entité, un repository est automatiquement créé."_

 ### 3) PanierController.php


 - Ici j'ai découvers et utilisé la méthode addFlash qui permet d'afficher des messages à l'utilisateur , on a un texte simple qui indique à l'utilisateur de se connecter ou s'inscrire, on redirige vers la route du login de ce projet avec **redirectRoRoute(`app_login`);**

 - Dans ce code c'est la méthode POST qui permet de valider et vider le panier : elle écrit les paramètres URL dans la requêtes HTTP pour le serveur.

 - Response facilite la création d'une réponse HTTP selon laconsole.dev/formations/symfony/controleurs
 -Request est la requête reçue  (Selon Openclassroom : https://openclassrooms.com/fr/courses/8264046-construisez-un-site-web-a-laide-du-framework-symfony-7/8400206-comprenez-le-protocole-http-dans-symfony ) 




 
## II) Tables:
### Commandes sql

#### Category



```
CREATE TABLE category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);
```

#### Formations 
```
CREATE TABLE formations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    category_id INT,
    image_url VARCHAR(255),
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
  
);

```

#### Orders 

```
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    status VARCHAR(50),
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    address VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES user(id)
);


```



#### User

```
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    address VARCHAR(255),
    is_verified BOOLEAN DEFAULT 0,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    roles JSON NOT NULL
);

```

- Le type de donné le plus compliqué à retenir pour ma part est DATETIME, je sais que VARCHAR EST L EQUIVALENT DE STRING 


**Loïc Darras**  
Licence Pro Projet Web et Mobile, Sorbonne Université  


