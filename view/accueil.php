<?php
    $title = 'Accueil';
    require_once 'header.php';
?>

<link rel="stylesheet" href="<?= SERVER_URL ?>/css/accueil.css">
<body>
    <div id="jumbotron">
        <img src="<?= SERVER_URL ?>/img/acceuil-photo.png" alt="image-acceuil" />
    </div>

    <div class="one">
        <a href="<?= SERVER_URL ?>/montres/"
            ><img
                src="<?= SERVER_URL ?>/img/LES-NOUVEAUX-ARRIVANTS.png"
                alt="nouvelles-montres"
        /></a>
    </div>

    <div class="two">
        <a href="<?= SERVER_URL ?>/montres/"
            ><img src="<?= SERVER_URL ?>/img/LES-MEILLEURS-VENTES.png" alt="nouvelles-montres"
        /></a>
    </div>

    <div class="three">
        <a href="<?= SERVER_URL ?>/montres/"
            ><img src="<?= SERVER_URL ?>/img/LES-SURVIVANTES.png" alt="nouvelles-montres"
        /></a>
    </div>
</body>

<?php
    require_once 'footer.php';
?>