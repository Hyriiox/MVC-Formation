<?php
require_once 'modele.php';

function liste_stagiaires(){
    $stagiaires = get_all_stagiaires();
    require "templates/listestagiaires.php";
}

function supprimer_stagiaire($id){

    delete_stagiaire_by_id($id);
    $stagiaires = get_all_stagiaires();
    require "templates/listestagiaires.php";
}

function ajouter_stagiaire(){

    ajoute_stagiaire_by_id();
    $stagiaires = get_all_stagiaire();
    require "templates/listestagiaires.php";
}

function modifier_stagiaire($id){

    modifie_stagiaire_by_id($id);
    $stagiaires = get_all_stagiaire();
    require "templates/listestagiaires.php";
}

// Affiche une erreur dans une vue erreur.php 
// qui centralise toutes les levées d'Exceptions 
function erreur($msgErreur) {
    require 'templates/erreur.php';
}
?>



