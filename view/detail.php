<?php
    $title = 'Détails montre';
    require_once 'header.php';
?>

<link rel="stylesheet" href="<?= SERVER_URL ?>/css/detail.css">

<div class="modal" id="errorModal">
  <div class="modal-content">
    <p id="errorMessage"></p>
  </div>
</div>

<div class="container box">
    <div class="row" id="monD">
        
    </div>
</div>

<?php if(isset($_SESSION['idClient'])) {?>
    <script src="<?= SERVER_URL ?>/js/details-connected.js"></script>
<?php } else {?>
    <script src="<?= SERVER_URL ?>/js/details-disconnected.js"></script>
<?php } ?>
<script src="<?= SERVER_URL ?>/js/addToCart.js"></script>

<?php
    require_once 'footer.php';
?>
