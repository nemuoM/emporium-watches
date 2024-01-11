<?php

/**
 * Description de la class DbManager
 * Cette classe fournit des méthodes pour gérer la connexion à la base de données et réinitialiser la base de données.
 * 
 * @auteur M.MORABET
 * @date: 11/2023
 */
 const HOST = '127.0.0.1';
 const PORT = '3307';
 const DBNAME = 'db_emporium';
 const CHARSET = 'utf8';
 const LOGIN = 'root';
 const MDP = '';

 class DbManager{

    private static ?\PDO $cnx = null; 

    /**
     * Établit et retourne une instance unique de la connexion à la base de données.
     * Utilise les constantes définies pour configurer la connexion.
     * En cas d'échec de la connexion, le script s'arrête et affiche un message d'erreur.
     * 
     * @return \PDO L'instance de la connexion à la base de données.
     */
    public static function getConnexion(){
        if(self::$cnx == null){
            try {
                $dsn = 'mysql:host='. HOST.';port='.PORT.';dbname='.DBNAME.';charset='.CHARSET;
                self::$cnx = new PDO($dsn, LOGIN, MDP);
                self::$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erreur : '.$e->getMessage());            
            }
        }
        return self::$cnx;
    }

    /**
     * Réinitialise la base de données à son état initial.
     * Établit une connexion à la base de données si elle n'existe pas déjà.
     * Exécute un script SQL pour réinitialiser la base de données.
     */
    public static function reset(){
        if (self::$cnx == null) {
            self::$cnx = DbManager::getConnexion();
        }
        $query = self::$cnx->prepare(file_get_contents(ROOT.'/sql/db_ew.sql'));
        $query->execute();
    }
 }

?>