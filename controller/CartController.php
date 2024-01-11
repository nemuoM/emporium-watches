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

    public static function addCart($params){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = isset($_GET['id']) ? $_GET['id'] : '';

            header('Content-Type: application/json');

            echo CartManager::addToCartM($id);
        }
    }

    public static function decrQte($params){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = isset($_GET['id']) ? $_GET['id'] : '';

            header('Content-Type: application/json');

            echo CartManager::decrQuantity($id);
        }
    }

    public static function delMontre($params){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = isset($_GET['id']) ? $_GET['id'] : '';

            header('Content-Type: application/json');

            echo CartManager::deleteProd($id);
        }
    }
 }

?>