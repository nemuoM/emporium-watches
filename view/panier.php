<?php

    $title = 'Mon Panier';
    require_once 'header.php';

?>

<link rel="stylesheet" href="<?= SERVER_URL ?>/css/cart.css">

<div class="container">
    <div id="monCart">
         
    </div>
    <div class="order-summary row">
        <div id="total-amount">
        </div>
        <button id="validate-cart">Valider mon panier</button>
    </div>
</div>

<script src="<?= SERVER_URL ?>/js/affiche-cart.js"></script>
<script src="<?= SERVER_URL ?>/js/gest-cart.js"></script>

<?php

    require_once 'footer.php';

?>