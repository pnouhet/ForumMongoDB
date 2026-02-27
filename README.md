# ForumMongoDB
### Site internet de type Forum, développé en PHP et avec base de donnée MongoDB.
##### Co-créer avec Rémi Abdallah
___
L'architecture du projet est en MVC (Model Vue Controller)  

Le projet possède 3 Controllers.  
- CommentController, permettre à un utilisateur de commenter un article.  
- PostController, permettre à l'utilisateur de créer un article.  
- UserController, gérer le profil d'un utilisateur.  

Le site possède 5 vues,  
- Connexion/Inscription
- Profil d'utilisateur
- Homepage
- Page article
- Création de l'article
  
## Fonction des vues  
### Vue Connexion/Inscription  
Permettre à un utilisateur de créer un compte sur le site et de s'y connecter.  
L'utilisateur rentre son 
- Nom d'utilisateur
- Email
- Mot de passe
- Confirmation du mot de passe
### Vue Profil d'utilisateur  
Permettre à l'utilisateur de modifier ses informations personnelles.  
Voir ses articles publiés.  
Supprimer son profil.  
### Homepage  
Page d'accueil regroupant la totalité des articles publiés sur le forum.  
### Page article  
Vue d'un article regroupant son contenu, ses réponses et ses boutons afin de modifier le contenu ou répondre au post.  
### Création de l'article  
Vue permettant la création d'un article avec plusieurs inputs pour le titre et le contenu permettant de le sujet et le texte, ainsi qu'un bouton de publication afin de publier l'article sur le forum.  

