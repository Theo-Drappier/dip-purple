# dip-purple
DIP' Purple Hackath'yon Project

Comment bien installer votre branche pour ne pas avoir d'erreurs :

1 - Installer Composer :
  * Rendez-vous sur la page : https://getcomposer.org/
  * Suivez la documentation pour l'installer

2 - Récupérer RedBean :
  * Pour cela, allez dans le dossier "vendor" et supprimez le dossier "gabordemooij"
  * Ouvrez votre terminal et déplacez-vous dans le dossier contenant le projet (cd /var/www/html/dip-purple)
  * Exécutez la commande : "composer install"

3 - Installer la base de données :
  * Elle est fournit dans le dossier "db"
  * Installez-la dans votre SGBD

4 - Connecter RedBean à la base de données :
  * Pour cela, éditez le fichier "app.php" se situant dans le dossier "app"
  * A la ligne 6, modifier les paramètres "YOUR_USERNAME" par l'utilisateur de la BDD et "YOUR_PASSWORD" par son mot de passe
  
5 - Lancer l'application !
