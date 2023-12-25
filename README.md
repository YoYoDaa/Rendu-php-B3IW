# Rendus MVC VINCENT Yoann

## Authentification/Autorisation

- Authentification au sein de l'application (user/mot de passe) via un formulaire de login donc un contrôleur avec la méthode POST
- Gestion de la session en cas d'authentification réussie : écriture d'un service de gestion de session qui permettrait, via un objet, d'interagir avec le tableau superglobal `$_SESSION`
- Pour les autorisations : écriture d'un attribut applicable au-dessus d'un contrôleur, qui permettrait d'indiquer si on doit être connecté ou non pour accéder au contrôleur
- Note : pas besoin de faire des rôles

Malgré mon niveau j'ai essayé de faire quelque chose, mais malheuresement cela ne fonctionne pas, je vais mettre ici les idées que j'ai eu pour le réalisé et dans les fichiers il y a des commentaires de comment j'aurais aimé que ça fonctionne.

# Création de fichier

- création de la table SQL sessions.
- LoginController.php : Pour gérer l'authentification dans le dossier src/Controller.
- User.php : Pour pour les getters et les setters du user.
- Session/SessionManager.php : pour gérer les sessions des users.
- Dossier login dans templates : login et confirmlogin en twig pour le formulaire et la page comme quoi l'utilisateur est bien connecté.

Vu que rien ne fonctionne comme je le voudrais, j'ai quand même essayé d'écrire comment je voyait les choses (par exemple pour les sessions vu que je n'ai pas réussi à récupérer le mail et le password je n'ai aucun moyen de tester) etpour la page confirmlogin.html.twig.
