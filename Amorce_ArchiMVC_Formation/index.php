<?php
require_once 'controller.php';

try{
    if (!isset($_GET["action"])) {
        
        liste_stagiaires();

    }else if(isset($_GET["action"])){
        if($_GET["action"]=="suppr"){
            if(isset($_GET["id"])){
                supprimer_stagiaire($_GET["id"]);
            }else{
                throw new Exception("<span style='color:red'>Aucun identifiant de stagiaire envoyé</span>");
            }
        } else if($_GET["action"]=="ajout") {
            require_once 'templates/indexinsert.php';
        } else if($_GET["action"]=="update" && isset($_GET["id"])) {
            require_once 'templates/indexupdate.php';
        } else {
            throw new Exception("<h1>Page non trouvée !</h1>");
        }
    }
}catch(Exception $e){

    $msgErreur = $e->getMessage();
    echo erreur($msgErreur);
}
?>
