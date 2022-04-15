# ** [alt text](public/img/FormEditor.png) - FormEditor - Un site pour créer votre formulaire en ligne avec la possibilité d'intéragir directement avec les personnes qui pourront y être associé.**

1. [Introduction](#intro)
2. [Prérequis d'utilisation](#pre)
3. [Que faire ?](#guide)

<div id="intro"></div>

## **1- **

Le site FormEditor est un site qui vous permettra de créer des formulaires en ligne et de les poster de façon permanente, pour une meilleure gestion de tout ce qui est paperasses administratives.
Vous pourrez former des groupes pour que vos correspondant puisse remplir les champs qui leur sont attribué de façon rapide et simple.
Les utilisateurs peuvent créer autant de formulaire qu’ils le souhaitent sans contraintes ni limites.
FormEditor est un site accessible par tous. Facile d’utilisation, chaque utilisateur possède des rôles.
Utile à la fois pour les professionnels et le monde du travail comme pour étudiant ou simple particulier.

<div id="pre"></div>

## **2- **

Voici quelques informations nécessaires à savoir avant d'utiliser FormEditor :
Le projet est installé sur GitLab ainsi que la VM de DRIOUCHE Sami (drio0004) et HAYAT Rahim (haya0002).

***__Lien de téléchargement GitLab :__***
https://gitlab-mmi.univ-reims.fr/RSFE/formeditor.git

***__Accès à FormEditor :__***
http://10.5.2.25/~drio0004/FormEditor/public/
http://10.5.2.25/~haya0002/FormEditor/public/

***__Accès à phpmyadmin :__***
http://10.5.2.25/phpmyadmin/index.php
***__Accès à la base de données (Sami DRIOUCHE) :__***
DB_DATABASE=DRIOU1DB
DB_USERNAME=DRIOU1
DB_PASSWORD=%R23bG2j|
***__Accès à la base de données (Rahim HAYAT):__***
DB_DATABASE=HAYAT1DB
DB_USERNAME=HAYAT1
DB_PASSWORD=!62p=LYe4

Pour récupérer le projet laravel du site à l’aide du lien GitLab :
-depuis la VM veuillez-vous situez dans le répertoire 
-il vous suffit d’ouvrir un terminal, taper les commandes :
```
git clone https://gitlab-mmi.univ-reims.fr/RSFE/formeditor.git FormEditor
cd FormEditor/
composer install
```
Utilisez la commande cp si vous êtes sous linux sinon copy sous Windows :
```
cp .env.example .env
php artisan key:generate
```
**Si vous avez cloné le projet sur la VM, il faut permettre l’accès à ces 2 répertoires à l’aide de la commande suivante :**
```
chmod -R 777 storage/ bootstrap/cache
```
La première fois il vous faudra vous connecter avec le compte admin qui vous permettra par la suite de créer des comptes utilisateur (professionnel, particulier et étudiant) et pouvoir exploiter pleinement le site :

***__Compte admin (Chuck NORRIS) :__***
Email : chuck.norris@toto.fr
Mot de passe : totototo

Puis quelque compte par default pour chacun des rôles :
***__Compte modérateur :__***
Email : moderateur@formeditor.com
Mot de passe : password

***__Compte étudiant :__***
Email : etudiant@formeditor.com
Mot de passe : password

***__Compte professionnel :__***
Email : professionnel@formeditor.com
Mot de passe : password

***__Compte particulier :__***
Email : particulier@formeditor.com
Mot de passe : password

<div id="guide"></div>

## **3- **

Un simple visiteur peut simplement consulter les formulaires

1) Créer votre compte ou utilisez l'un de ceux proposé au dessus.
2) Créez un formulaire, modifiez-le, Télécharger le en PDF, ajoutez y des membres. **(Recherchez un formulaire à l'aide de la barre de recherche)**
3) Accéder au groupe le propriétaire du formulaire à la possibilité de gérer son groupe. (ajouter/supprimer membre, éditer/supprimer groupe).
4) Si vous êtes Administrateur ou Modérateur, gérer la partie utilisateurs du site (créer, éditer, consulter et supprimer un utilisateur).

***__Notes :__*** 
Prendre en compte que l'administrateur à un accès total sur le site.
Nous n'avons pas eut le temps d'ajouter l'option public/privé d'un formulaire pour éviter sa consultation.
