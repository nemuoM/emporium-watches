<?php

/**
 * Description de la class ProductManager
 * Class qui gère les produits
 * 
 * @author M.MORABET
 * @date 11/2023
 */

 class ProductManager{

    private static ?\PDO $cnx = null;


    /**
     * Récupère et renvoie une liste de montres filtrée en fonction des critères spécifiés.
     * Connecte à la base de données si nécessaire et construit une requête SQL dynamique basée sur les filtres fournis.
     * Retourne les résultats au format JSON.
     * 
     * @param array $filtres Un tableau associatif de critères de filtrage (marque, genre, couleur, etc.).
     * @return string Une chaîne JSON représentant les montres filtrées.
     */
    public static function getLesMontres($filtres){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $sql = 'SELECT idMontre, image, nom, prix, stock, MA.libelle AS marque FROM montre MO JOIN marque MA on MO.idMarque = MA.idMarque';

            $conditions = [];

            if (!empty($filtres['marque'])) {
                $marques = implode(',', array_map('intval', $filtres['marque']));
                $conditions[] = "MO.idMarque IN ($marques)";
            }
            if (!empty($filtres['genre'])) {
                $genres = implode(',', array_map('intval', $filtres['genre']));
                $conditions[] = "MO.idGenre IN ($genres)";
            }
            if (!empty($filtres['couleur'])) {
                $couleur = implode(',', array_map('intval', $filtres['couleur']));
                $conditions[] = "MO.idCouleur IN ($couleur)";
            }
            if (!empty($filtres['style'])) {
                $style = implode(',', array_map('intval', $filtres['style']));
                $conditions[] = "MO.idStyle IN ($style)";
            }
            if (!empty($filtres['mouvement'])) {
                $mouvement = implode(',', array_map('intval', $filtres['mouvement']));
                $conditions[] = "MO.idMouvement IN ($mouvement)";
            }
            if (!empty($filtres['matiereC'])) {
                $matiereC = implode(',', array_map('intval', $filtres['matiereC']));
                $conditions[] = "MO.idMatiereCadran IN ($matiereC)";
            }
            if (!empty($filtres['matiereB'])) {
                $matiereB = implode(',', array_map('intval', $filtres['matiereB']));
                $conditions[] = "MO.idMatiereBracelet IN ($matiereB)";
            }

            if (!empty($conditions)) {
                $sql .= ' WHERE ' . implode(' AND ', $conditions);
            }

            $stmt = self::$cnx->query($sql);

            $data = null;

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
            
        }catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }finally{
            unset($cnx);
        }

        return json_encode($data);
    }

    /**
     * Récupère les détails d'une montre spécifique en fonction de son identifiant.
     * Connecte à la base de données si nécessaire et exécute une requête préparée pour éviter les injections SQL.
     * Retourne les informations de la montre au format JSON.
     * 
     * @param int $id L'identifiant de la montre.
     * @return string Une chaîne JSON représentant les détails de la montre.
     */
    public static function getMontreById($id){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $sql = 'SELECT idMontre, image, nom, prix,description, MA.libelle AS marque FROM montre MO JOIN marque MA on MO.idMarque = MA.idMarque WHERE idMontre = :id;';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $donnees = array();

            while($ligne = $stmt->fetch(PDO::FETCH_ASSOC)){
                $donnees[] = $ligne;
            }
            
        }catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }

        return json_encode($donnees);
    }

    /**
     * Récupère et renvoie toutes les marques disponibles de montres.
     * Connecte à la base de données si nécessaire et exécute une requête simple pour récupérer les informations.
     * Retourne les résultats au format JSON.
     * Ainsi de suite pour les fonction qui suivent.
     * 
     * @return string Une chaîne JSON représentant toutes les marques de montres.
     */
    public static function getMarque(){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $sql = 'SELECT idMarque, libelle FROM marque';

            $stmt = self::$cnx->query($sql);

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
            
        }catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }finally{
            unset($cnx);
        }

        return json_encode($data);
    }

    public static function getGenre(){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $sql = 'SELECT idGenre, libelle FROM genre';

            $stmt = self::$cnx->query($sql);

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
            
        }catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }finally{
            unset($cnx);
        }

        return json_encode($data);
    }

    public static function getCouleur(){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $sql = 'SELECT idCouleur, libelle FROM couleur';

            $stmt = self::$cnx->query($sql);

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
            
        }catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }finally{
            unset($cnx);
        }

        return json_encode($data);
    }

    public static function getStyle(){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $sql = 'SELECT idStyle, libelle FROM style';

            $stmt = self::$cnx->query($sql);

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
            
        }catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }finally{
            unset($cnx);
        }

        return json_encode($data);
    }

    public static function getMouvement(){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $sql = 'SELECT idMouvement, libelle FROM mouvement';

            $stmt = self::$cnx->query($sql);

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
            
        }catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }finally{
            unset($cnx);
        }

        return json_encode($data);
    }

    public static function getMatiere(){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $sql = 'SELECT idMatiere, libelle FROM matiere';

            $stmt = self::$cnx->query($sql);

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
            
        }catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }finally{
            unset($cnx);
        }

        return json_encode($data);
    }
 }

?>