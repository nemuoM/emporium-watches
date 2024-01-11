<?php
    $title = 'Nom de la montre';
    require_once 'header.php';
?>

<link rel="stylesheet" href="<?= SERVER_URL ?>/css/detail.css">

<div class="container box">
    <div class="row" id="monD">
        
    </div>
</div>

<?php if(isset($_SESSION['idClient'])) {?>
<script src="<?= SERVER_URL ?>/js/details-connected.js"></script>
<?php } else {?>
<script src="<?= SERVER_URL ?>/js/details-disconnected.js"></script>
<?php } ?>




<?php
require_once 'footer.php';
?>