<?php
$title = 'Mon Profil';
require_once 'header.php'; // Inclusion de l'en-tête

?>
    
<div class="container">
    <a href="<?= SERVER_URL ?>/deconnexion/" class="btn btn-danger">Déconnexion</a> <!-- Bouton de déconnexion -->
</div>
<?php if($_SESSION['idRole'] == 1) {?>
    <a href="<?= SERVER_URL ?>/deconnexion/" class="btn btn-danger">Back-office</a> 
<?php } ?>


<?php

require_once 'footer.php'; // Inclusion du pied de page

?>
