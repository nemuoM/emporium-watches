<?php
    $title = 'Bienvenue !';
    require_once 'header.php';
?>

<link rel="stylesheet" href="<?= SERVER_URL ?>/css/welcome.css">

<div class="welcome-container">
    <h1 class="mtitre">Bienvenue dans la famille Emporium Watches!</h1>
    <h5 class="mb-3">Merci de vous être inscrit. Votre compte a été créé avec succès.</h5>
    <h5 class="mb-3">Nous sommes ravis de vous compter parmi nous <?php if($_SESSION['idGenre'] === 1){ echo 'Monsieur ';}else{echo 'Madame ';} echo $_SESSION['nom'];?> </h5>
    <h5 class="mb-3">Votre voyage dans le royaume des montres commence ici.</h5>
    <h4 class="mtexte"> Bienvenue à bord de cette aventure horlogère.</h4>
    <a href="<?= SERVER_URL ?>/" class="btn">Commencer le shopping</a>
</div>

<?php
    require_once 'footer.php';
?>
