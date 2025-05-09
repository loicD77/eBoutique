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







**Loïc Darras**  
Licence Pro Projet Web et Mobile, Sorbonne Université  

