<?php
$title = 'Paiement';
require_once 'header.php';
?>

<link rel="stylesheet" href="<?= SERVER_URL ?>/css/paiement.css">

<div class="formulairePL" id="formulaire">
    <div id="livraisonpaiment">
        <form id="paiement-form">
            <div id="livraison">
                <h2>Adresse de livraison</h2>
                <label for="address">Adresse:</label>
                <input type="text" name="address" id="address" required><br><br>
            
                <label for="postal_code">Code postal:</label>
                <input type="text" name="postal_code" id="postal_code" required><br><br>
            
                <label for="city">Ville:</label>
                <input type="text" name="city" id="city" required><br><br>
            
                <label for="phone_number">Numéro de téléphone:</label>
                <input type="text" name="phone_number" id="phone_number" required>
            </div>
            <div id="paiement">
                <h2>Informations bancaires</h2>
                <label for="card_number">Numéro de carte:</label>
                <input type="text" name="card_number" id="card_number" required><br><br>
            
                <label for="expiration_date">Date d'expiration:</label>
                <input type="text" name="expiration_date" id="expiration_date" required><br><br>
            
                <label for="cvv">CVV:</label>
                <input type="text" name="cvv" id="cvv" required><br><br>
            </div>
            <button type="submit" class="valider">Valider & payer</button>
        </form>
    </div>
</div>

<script src="<?= SERVER_URL ?>/js/paiement.js"></script>

<?php
require_once 'footer.php';
?>
