# Le clos mesnil

Le clos mesnil est un gîte, il souhaite développer leur propres système de réservation et développer un système de blog pour promouvoir les activités aux alentour. 

## 1- Définir la base de donnée

- 1.1 Dictionnaire de donné

- 1.2 MCD

- 1.3 Script création de base de donnée

- 1.4  Définition des rôles:
        Profil visiteur: lecture sur reservation
        Profil client:  lecture sur toute la base  (insertion et mise à jour dans table client et  réservation)
        Profil admininstrateur:  lecture/écriture/mise à jour/supprimer

- 1.5  Création du script pour alimenter la base de test

- 1.6  Création de la procédure de sauvegarde

- 1.7 Test de la restauration

## 2- Manipuler la base de donnée

- 2.1  Exportez les tables principales (entité) vers des tableaux d'un tableur de votre choix ainsi que le contenu du résultat de vos requêtes.

- 2.2 Création des requêtes

- 2.2.1  Chiffre d'affaires annuelle hors taxes 

- 2.2.2 Liste des réservation clients pour année donnée

- 2.2.3  Liste des produit à commander

## 3- Programmer les procédures

Gérer les vue 

- 4.1 Création de la vue correspondant à la jointure client réservation 

## 5- Développer la stratégie S.E.O

- 5.1 Optimiser les pages web pour le référencement:
balises meta
robot.txt
plan du site, sitmap.xml
fil d'ariane
outils de gestion d'analyse 
certificat SSL
mise en place du design responsive
multilingue 
page error 404

## 6 - Publier l'application

- 6.1 -choix du nom de domaine
- 6.2 -hébergement du site


## 7- Création de la maquette (pages, système de réservation, authentification)

## 8- Développer l'application web:

 consulter les réservations
 saisir de nouvelles réservations

- 8-1 Création des pages web statiques
- 8.1.1 partie public du site page d'accueil avec système de géolocalisation,  un accès à la liste des réservations, accès au formulaire d'inscription, accès au différents articles du blog.
- 8.1.2 partie privée du site gestion des réservation,création des articles de blog, gestion des produits à commander pour le gîte
- 8.2 création du formulaire d'inscription 
- 8.2.1 contrôle de saisie du formulaire d'inscription

## 9- Développer des composant d'accès aux données
-9.1 mise en place du CRUD sur la table reservation 
- 9.1.1 création de l'interface pour ajouter,modifier,supprimer des réservations
- 9.1.2 mise en place du framework MVC  
