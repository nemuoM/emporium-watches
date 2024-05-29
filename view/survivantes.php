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
    <div class="filtres">
        <div class="btn-group">
            <button
                type="button"
                class="btn btn-sable dropdown-toggle"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                Marque
            </button>
            <ul class="dropdown-menu" id="marque">
                
            </ul>
        </div>
    
        <div class="btn-group">
            <button
                type="button"
                class="btn btn-sable dropdown-toggle"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                Genre
            </button>
            <ul class="dropdown-menu" id="genre">
                
            </ul>
        </div>
        <div class="btn-group">
            <button
                type="button"
                class="btn btn-sable dropdown-toggle"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                Couleur
            </button>
            <ul class="dropdown-menu" id="couleur">
                
            </ul>
        </div>
    
        <div class="btn-group">
            <button
                type="button"
                class="btn btn-sable dropdown-toggle"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                Style
            </button>
            <ul class="dropdown-menu" id="style">
                
            </ul>
        </div>
        <div class="btn-group">
            <button
                type="button"
                class="btn btn-sable dropdown-toggle"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                Mouvement
            </button>
            <ul class="dropdown-menu" id="mouvement">
                
            </ul>
        </div>
    
        <div class="btn-group">
            <button
                type="button"
                class="btn btn-sable dropdown-toggle"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                Matière du cadran
            </button>
            <ul class="dropdown-menu" id="matiereC">
                
            </ul>
        </div>

        <div class="btn-group">
            <button
                type="button"
                class="btn btn-sable dropdown-toggle"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                Matière du bracelet
            </button>
            <ul class="dropdown-menu" id="matiereB">
                
            </ul>
        </div>
    </div>
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