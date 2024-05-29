<?php
    $title = 'Accueil';
    require_once 'header.php';
?>

<link rel="stylesheet" href="<?= SERVER_URL ?>/css/accueil.css">

<div id="jumbotron">
    <img src="<?= SERVER_URL ?>/img/acceuil-photo.png" alt="image-acceuil" />
</div>

<div class="one">
    <a href="<?= SERVER_URL ?>/nouveau-arrivant/">
        <img src="<?= SERVER_URL ?>/img/LES-NOUVEAUX-ARRIVANTS.png" alt="nouvelles-montres" />
    </a>
</div>

<div class="two">
    <a href="<?= SERVER_URL ?>/meilleurs-ventes/">
        <img src="<?= SERVER_URL ?>/img/LES-MEILLEURS-VENTES.png" alt="nouvelles-montres" />
    </a>
</div>

<div class="three">
    <a href="<?= SERVER_URL ?>/survivantes/">
        <img src="<?= SERVER_URL ?>/img/LES-SURVIVANTES.png" alt="nouvelles-montres" />
    </a>
</div>

<?php
    require_once 'footer.php';
?>
