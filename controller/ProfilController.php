<?php

/**
 * /controller/ProfilController.php
 * 
 * Contrôleur pour le profil du client
 * 
 * @author M.MORABET
 * @date 12/2023
 */

class ProfilController extends Controller {

    public static function getCmd($params){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){

            header('Content-Type: application/json');

            echo ProductManager::getCommande();
        }
    }
    
}

?>
