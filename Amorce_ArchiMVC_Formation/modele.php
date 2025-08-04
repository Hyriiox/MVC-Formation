
<?php
require("connect.php");

// Connexion à la BDD
function connect_db()
{
    $dsn = "mysql:dbname=" . BASE . ";host=" . SERVER;
    try {
        $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        $connexion = new PDO($dsn, USER, PASSWD,$option);
    } catch (PDOException $e) {
        printf("Echec connexion : %s\n", $e->getMessage());
        exit();
    }
    return $connexion;
}

// Création de la liste des Stagiaires
function get_all_stagiaires(){

    $connexion = connect_db();
    $stagiaires = array();
    $sql = "SELECT * from Membres";

    foreach ($connexion->query($sql) as $row) {
        $stagiaires[] = $row;
    }
    return $stagiaires;
}

// Suppression d'un stagiaire par id
function delete_stagiaire_by_id($id){

    $connexion = connect_db();
    $sql= "DELETE FROM membres WHERE id_membre = :id ";
    $reponse = $connexion->prepare($sql);
    $reponse->bindValue(":id", intval($_GET["id"]), PDO::PARAM_INT);
    $reponse->execute();
}

// Ajoute un stagiaire 
function ajoute_stagiaire_by_id($nom, $prenom) {
    $connexion = connect_db();
    $sql = "INSERT INTO membres (nom_membre, login_membre) VALUES (:nom, :prenom)";
    $reponse = $connexion->prepare($sql);
    $reponse->bindValue(":nom", $nom, PDO::PARAM_STR);
    $reponse->bindValue(":prenom", $prenom, PDO::PARAM_STR);
    $reponse->execute();
}

// Récupère un stagiaire par son id
function get_stagiaire_by_id($id) {
    $connexion = connect_db();
    $sql = "SELECT * FROM membres WHERE id_membre = :id";
    $stmt = $connexion->prepare($sql);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Modifier un stagiare
function modifie_stagiaire_by_id($id, $prenom, $nom){
    $connexion = connect_db();
    $sql = "UPDATE membres SET login_membre = ?, nom_membre = ? WHERE id_membre = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->execute([$prenom, $nom, $id]);
}

?>