<?php
$title = "Modification d'un Stagiaire";
ob_start();
?>
    <?php
    require_once("modele.php");
    $membres = get_all_stagiaires();

    // Traitement de la modification
    $erreur_nom = "";
    $erreur_prenom = "";
    $data = null;
    if (!empty($_GET['id'])) {
        $data = get_stagiaire_by_id(intval($_GET['id']));
    }
    // Initialisation des champs avec la BDD par défaut
    $nom = $data['nom_membre'] ?? '';
    $prenom = $data['login_membre'] ?? '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? '';
        $nom = trim($_POST['nom'] ?? '');
        $prenom = trim($_POST['prenom'] ?? '');
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
            modifie_stagiaire_by_id($id, $prenom, $nom);
            header('Location: index.php');
            exit;
        }
    }

    // Récupération du membre à modifier
    $data = null;
    if (!empty($_GET['id'])) {
        $data = get_stagiaire_by_id(intval($_GET['id']));
    }
    ?>
    <h1>Modification d'un stagiaire </h1>
    <br><br>
    <?php if ($data) : ?>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($data['id_membre']) ?>">
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
    </form>
    <?php else : ?>
        <p style="color:red;">Aucun membre trouvé pour cet identifiant.</p>
    <?php endif; ?>
<?php
$content = ob_get_clean();
include "baselayout.php";
?>