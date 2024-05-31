<?php

$title = 'Les survivantes'; // Titre de la page
require_once 'header.php'; // Inclusion de l'en-tête

?>

<link rel="stylesheet" href="<?= SERVER_URL ?>/css/style-pdt.css" />

<div class="modal" id="errorModal">
  <div class="modal-content">
    <p id="errorMessage"></p>
  </div>
</div>

<div class="container center pdts mx-auto">
    <h1 class="pagespe">Les survivantes</h1>
    <div class="affichepdt" id="mesProd">
        <!-- Affichage de mes produits -->
    </div>
</div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
></script>
<script src="<?= SERVER_URL ?>/js/afficher-filtres.js"></script>
<?php if(isset($_SESSION['idClient'])) {?>
<script src="<?= SERVER_URL ?>/js/afficher-produits-connected.js"></script>
<?php } else {?>
<script src="<?= SERVER_URL ?>/js/afficher-produits-disconnected.js"></script>
<?php } ?>
    <script src="<?= SERVER_URL ?>/js/addToCart.js"></script>


<?php

require_once 'footer.php'; // Inclusion du pied de page

?>