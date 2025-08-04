<?php
$title = "Insertion d'un Stagiaire";
ob_start();
?>
    <?php
    require_once("modele.php");
    
    $erreur_nom = "";
    $erreur_prenom = "";
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = trim($nom);
        $prenom = trim($prenom);
        if (empty($prenom)) {
            $erreur_prenom = "Veuillez remplir le prénom !";
        } elseif (!preg_match('/^[a-zA-ZÀ-ÿ\-\s]+$/u', $prenom)) {
            $erreur_prenom = "Le prénom ne doit contenir que des lettres et des tirets !";
        }
        if (empty($nom)) {
            $erreur_nom = "Veuillez remplir le nom !";
        } elseif (!preg_match('/^[a-zA-ZÀ-ÿ\-\s]+$/u', $nom)) {
            $erreur_nom = "Le nom ne doit contenir que des lettres et des tirets !";
        }
        if (empty($erreur_nom) && empty($erreur_prenom)) {
            ajoute_stagiaire_by_id($nom, $prenom);
            header('Location: index.php');
            exit;
        }
    }
    $membres = get_all_stagiaires();
    ?>
    <h1>Insertion d'un Stagiaire </h1>
    <br><br>

    <form action="" method="post">

        <p>
            <label for="prenom">Prenom :</label>
            <input type="text" name="prenom" id="prenom" autocomplete="off" value="<?= htmlspecialchars($prenom) ?>">
            <?php if (!empty($erreur_prenom)) : ?>
                <span style="color:red; margin-left:10px;"> <?= htmlspecialchars($erreur_prenom) ?> </span>
            <?php endif; ?>
        </p>
        <br>
        <p>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" autocomplete="off" value="<?= htmlspecialchars($nom) ?>">
            <?php if (!empty($erreur_nom)) : ?>
                <span style="color:red; margin-left:10px;"> <?= htmlspecialchars($erreur_nom) ?> </span>
            <?php endif; ?>
        </p>
        <br>
        <p>
            <button type="reset">Annuler</button>&nbsp;&nbsp;&nbsp;
            <button type="submit">Envoyer</button>
        </p>
<?php
$content = ob_get_clean();
include "baselayout.php";
?>