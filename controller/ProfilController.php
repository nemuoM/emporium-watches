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

    /**
     * Nettoie les données entrantes pour éviter les attaques comme l'injection SQL et le cross-site scripting.
     * Utilise `trim` pour supprimer les espaces blancs, `stripslashes` pour supprimer les antislashs,
     * et `htmlspecialchars` pour convertir les caractères spéciaux en entités HTML.
     * 
     * @param string $data Les données à nettoyer.
     * @return string Les données nettoyées.
     */
    public static function nettoyer($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function getCmd($params){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){

            header('Content-Type: application/json');

            echo ProductManager::getCommande();
        }
    }

    /**
     * Permet de mettre à jour le profil du client reçu en post.
     */
    public static function updtProfil($params){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(password_verify($_POST['password'], $_SESSION['mdp'])){
                $nom = self::nettoyer($_POST['nom']);
                $prenom = self::nettoyer($_POST['prenom']);
                $email = self::nettoyer($_POST['email']);
                $tel = self::nettoyer($_POST['tel']);
                $adresse = self::nettoyer($_POST['adresse']);
                $cp = self::nettoyer($_POST['cp']);
                $ville = self::nettoyer($_POST['ville']);

                if(isset($_POST['nPassword']) && isset($_POST['nPasswordC']) && !empty($_POST['nPassword']) && !empty($_POST['nPasswordC']) && $_POST['nPassword'] == $_POST['nPasswordC']){
                    $mdp = self::nettoyer($_POST['nPassword']);
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

    /**
     * Charge la vue d'un commande commande déjà effectué par le client.
     * Utilise la méthode `render` pour afficher la vue spécifiée avec les paramètres fournis.
     * 
     * @param array $params Les paramètres à passer à la vue.
     */
    public static function affiche(){
        $view = ROOT.'/view/macommande.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Permet de supprimer le compte du client.
     */
    public static function supprimer($params){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(password_verify($_POST['password'], $_SESSION['mdp'])){
                ClientManager::deleteClient($_SESSION['idClient']);
                session_destroy();
                echo json_encode(['success' => 'Compte supprimé avec succès !']);
            } else {
                echo json_encode(['error' => 'Mot de passe incorrect !']);
            }
        }
    }
    
}

?>
