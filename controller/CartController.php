<?php

/**
 * /controller/CartController.php
 * Contrôleur pour interagir avec le panier
 * 
 * @author M.MORABET
 * @date 12/2023
 */

class CartController extends Controller {
    
    public static function afficheCart($params){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            header('Content-Type: application/json');
            echo CartManager::getCart();
        }
    }

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

    /**
     * Permet de valider le panier et le paiement du client.
     * 
     * @param string $data Les données à valider.
     * @return string Les données validées.
     */
    public static function livraisonpaiement($params){
        if(isset($_POST['address']) && !empty($_POST['address']) 
        && isset($_POST['postal_code']) && !empty($_POST['postal_code']) 
        && isset($_POST['city']) && !empty($_POST['city'])
        && isset($_POST['phone_number']) && !empty($_POST['phone_number'])){
            $adresse = self::nettoyer($_POST['address']);
            $codePostal = self::nettoyer($_POST['postal_code']);
            $ville = self::nettoyer($_POST['city']);
            $phone_number = self::nettoyer($_POST['phone_number']);

            echo CartManager::confirmCart($adresse, $codePostal, $ville, $phone_number);
        }
    }

    /**
     * Permet d'ajouter un produit au panier.
     * 
     * @param string $data Les données à ajouter.
     * @return string Les données ajoutées.
     */
    public static function addCart($params){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = isset($_GET['id']) ? $_GET['id'] : '';
            header('Content-Type: application/json');
            echo CartManager::addToCartM($id);
        }
    }

    /**
     * Permet d'incrémenter la quantité d'un produit dans le panier.
     * 
     * @param string $data Les données à incrémenter.
     * @return string Les données incrémentées.
     */
    public static function decrQte($params){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = isset($_GET['id']) ? $_GET['id'] : '';
            header('Content-Type: application/json');
            echo CartManager::decrQuantity($id);
        }
    }

    /**
     * Permet de décrémenter la quantité d'un produit dans le panier.
     * 
     * @param string $data Les données à décrémenter.
     * @return string Les données décrémentées.
     */
    public static function delMontre($params){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = isset($_GET['id']) ? $_GET['id'] : '';
            header('Content-Type: application/json');
            echo CartManager::deleteProd($id);
        }
    }

    /**
     * Permet d'annuler le panier.
     * 
     * @param string $data Les données à annuler.
     * @return string Les données annulées.
     */
    public static function cancelCart($params){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            header('Content-Type: application/json');
            echo CartManager::cancelCart();
        }
    }

    /**
     * Permet d'annuler une commande.
     * 
     * @param string $data Les données à annuler.
     * @return string Les données annulées.
     */
    public static function cancelCmd($params){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = isset($_GET['id']) ? $_GET['id'] : '';
            header('Content-Type: application/json');
            echo CartManager::cancelCmd($id);
        }
    }

    /**
     * Permet de récupérer le panier confirmé.
     * 
     * @param string $data Les données à récupérer.
     * @return string Les données récupérées.
     */
    public static function getConfirmedCart($params){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            header('Content-Type: application/json');
            echo CartManager::getConfirmedCart();
        }
    }

    /**
     * Permet de récupérer une commande.
     * 
     * @param string $data Les données à récupérer.
     * @return string Les données récupérées.
     */
    public static function getCmd($params){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = isset($_GET['id']) ? $_GET['id'] : '';
            header('Content-Type: application/json');
            echo CartManager::getCmd($id);
        }
    }
}

?>
