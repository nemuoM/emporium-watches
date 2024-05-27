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

    public static function updtProfil($params){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(password_verify($_POST['password'], $_SESSION['mdp'])){
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $tel = $_POST['tel'];
                $adresse = $_POST['adresse'];
                $cp = $_POST['cp'];
                $ville = $_POST['ville'];

                if(isset($_POST['nPassword']) && isset($_POST['nPasswordC']) && !empty($_POST['nPassword']) && !empty($_POST['nPasswordC']) && $_POST['nPassword'] == $_POST['nPasswordC']){
                    echo 'je suis ici';
                    $mdp = $_POST['nPassword'];
                    ClientManager::updatePassword($_SESSION['idClient'], $mdp);
                }
    
                header('Content-Type: application/json');
    
                ClientManager::updateClient($_SESSION['idClient'], $nom, $prenom, $email, $tel, $adresse, $cp, $ville);

                echo json_encode(['success' => 'Profil mis à jour avec succès !']);
            } else {
                echo json_encode(['error' => 'Mot de passe incorrect !']);
            }
        }
    }
    
}

?>
