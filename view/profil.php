<?php
$title = 'Mon Profil';
require_once 'header.php'; // Inclusion de l'en-tête

?>

<link rel="stylesheet" href="<?= SERVER_URL ?>/css/espace.css">

<div class="container cont">
    <h1 class="mb-6">Bienvenue dans votre espace <?= $_SESSION['nom'] . ' ' . $_SESSION['prenom'] ?></h1>
    <a href="<?= SERVER_URL ?>/deconnexion/" class="btn btn-danger back">Déconnexion</a>
    <a href="<?= SERVER_URL ?>/accueil/" class="btn btn-warning back">Supprimer mon compte</a>
    <?php if ($_SESSION['idRole'] == 1){ ?>
        <a href="<?= SERVER_URL ?>/back-office/" class="btn btn-info back">Accéder au back-office</a>
    <?php } ?>

    <div class="row">
        <div class="col-md-6">
            <!-- Informations du profil -->
            <h2>Informations du profil</h2>
            <form action="update_profile.php" method="POST">
                <div class="form-group">
                    <label for="nom">Nom:</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?= $_SESSION['nom'] ?>">
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom:</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $_SESSION['prenom'] ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $_SESSION['mail'] ?>">
                </div>
                <div class="form-group">
                    <label for="tel">Numéro de téléphone:</label>
                    <input type="tel" class="form-control" id="tel" name="tel" value="<?= $_SESSION['telephone'] ?>">
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse:</label>
                    <input type="adresse" class="form-control" id="adresse" name="adresse" value="<?= $_SESSION['adresse'] ?>">
                </div>
                <div class="form-group">
                    <label for="cp">Code postal:</label>
                    <input type="cp" class="form-control" id="cp" name="cp" value="<?= $_SESSION['cp'] ?>">
                </div>
                <div class="form-group">
                    <label for="city">Ville:</label>
                    <input type="ville" class="form-control" id="ville" name="ville" value="<?= $_SESSION['ville'] ?>">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe actuel:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="password">Nouveau mot de passe:</label>
                    <input type="password" class="form-control" id="nPassword" name="password">
                </div>
                <div class="form-group">
                    <label for="password">Confirmer nouveau mot de passe:</label>
                    <input type="password" class="form-control" id="nPasswordC" name="password">
                </div>
                <button type="submit" class="btn btn-primary modif">Modifier mes informations</button>
            </form>
            <!-- Add more profile information here if needed -->
            
        </div>
        <div class="col-md-6">
            <h2>Commandes effectuées</h2>
            <div class="cmd" id="array">
                <!-- Liste des commandes -->
            </div>
        </div>
    </div>
</div>

<script src="<?= SERVER_URL ?>/js/affich-cmd.js"></script>
<?php

require_once 'footer.php'; // Inclusion du pied de page

?>
