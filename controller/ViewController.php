<?php

/**
 * /controller/ViewController.php
 * 
 * Contrôleur pour les pages de vue uniquement
 *
 * @author M.MORABET
 * @date 10/2023
 */

class ViewController extends Controller {

    
    /**
     * Action qui affiche la page d'accueil
     */
    public static function accueil($params){
        // appelle la vue
        $view = ROOT.'/view/accueil.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page d'information
     */
    public static function information($params){
        // appelle la vue
        $view = ROOT.'/view/informations.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page du profile de l'utilisateur
     */
    public static function monProfil($params){
        $view = ROOT.'/view/profil.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page de bienvenue après inscription
     */
    public static function bienvenue($params){
        $view = ROOT.'/view/bienvenue.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page panier.
     */
    public static function panier($params){
        $view = ROOT.'/view/panier.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page de paiement.
     */
    public static function paiement($params){
        $view = ROOT.'/view/paiement.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page de récapitulatif de commande.
     */
    public static function recapitulatif($params){
        $view = ROOT.'/view/recapitulatif.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page back-office du site.
     */
    public static function backOffice($params){
        $view = ROOT.'/view/back-office.php';
        $params = array();
        self::render($view, $params);
    }

    public static function meilleurs($params){
        $view = ROOT.'/view/meilleurs-ventes.php';
        $params = array();
        self::render($view, $params);
    }

    public static function nouveau($params){
        $view = ROOT.'/view/nouvelle-arrivante.php';
        $params = array();
        self::render($view, $params);
    }

    public static function survivantes($params){
        $view = ROOT.'/view/survivantes.php';
        $params = array();
        self::render($view, $params);
    }

    public static function mentions($params){
        $view = ROOT.'/view/mentions-legale.php';
        $params = array();
        self::render($view, $params);
    }
} 
