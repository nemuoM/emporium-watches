<?php

$title = 'Récapitulatif'; // Titre de la page
require_once 'header.php'; // Inclusion de l'en-tête

?>

<!-- Modal -->
<div id="confirmationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir annuler votre commande ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>
                <button type="button" onclick="cancelCart()" class="btn btn-success">Oui</button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?= SERVER_URL ?>/css/recapitulatif.css">
<div class="container">
    <h1>Récapitulatif de votre commande</h1>
    <div class="row">
        <div class="col-md-8">
            <h2>Informations de livraison</h2>
            <p><?= $_SESSION['nom'] . ' ' . $_SESSION['prenom'] ?></p>
            <p><?= $_SESSION['mail'] ?></p>
            <p><?= $_SESSION['telephone'] ?></p>
            <p><?= $_SESSION['adresse']?></p>
            <p><?= $_SESSION['cp'] . ' ' . $_SESSION['ville'] ?></p>
            <h2>Montre(s) commendée(s)</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Marque</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="array">
                    <!-- Emplacement pour les montres -->
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <h2>Montant total</h2>
            <h4 id="total">0 </h4>
            <h2>Actions</h2>
            <button onclick="showConfirmationModal()" class="btn btn-danger">Annuler la commande</button>
            <buton onclick="backToShopping()" class="btn btn-sable">Retour au shopping</buton>
        </div>
    </div>
</div>

<script src="<?= SERVER_URL ?>/js/recapitulatif.js"></script>

<?php

require_once 'footer.php'; // Inclusion du pied de page

?>