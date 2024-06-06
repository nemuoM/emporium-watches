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
            $sql = 'SELECT idMontre, image, nom, prix, description, stock, ';
            $sql .= 'MO.idMarque, MA.libelle AS marque, ';
            $sql .= 'idGenre, idCouleur, idStyle, idMouvement, idMatiereCadran, idMatiereBracelet ';
            $sql .= 'FROM montre MO ';
            $sql .= 'JOIN marque MA on MO.idMarque = MA.idMarque ';
            $sql .= 'WHERE idMontre = :id;';

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

    /**
     * Obtenez les résultats de recherche en fonction d'un terme de recherche donné.
     *
     * @param string $search Le terme de recherche.
     * @return string Résultats de recherche encodés en JSON.
     */
    public static function search($search) {
        $search = '%' . $search . '%';
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }
            $sql = 'SELECT idMontre, nom FROM montre MO JOIN marque MA on MO.idMarque = MA.idMarque WHERE nom LIKE :s OR MA.libelle LIKE :s';
            
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindValue(':s', $search, PDO::PARAM_STR);
            $stmt->execute();
            
            $data = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        } finally {
            self::$cnx = null;
        }

        return json_encode($data);
    }



    /**
     * Insérez une nouvelle montre dans la base de données.
     *
     * @param array $montre Les données de la montre à insérer.
     * @return void
     */
    public static function setMontre($image, $nom, $prix, $stock, $description, $idMarque, $idGenre, $idCouleur, $idStyle, $idMouvement, $idMatiereCadran, $idMatiereBracelet){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $sql = 'INSERT INTO montre (image, nom, prix, stock, dateAjout, description, idMarque, idGenre, idCouleur, idStyle, idMouvement, idMatiereCadran, idMatiereBracelet) VALUES (:image, :nom, :prix, :stock, NOW(), :description, :idMarque, :idGenre, :idCouleur, :idStyle, :idMouvement, :idMatiereCadran, :idMatiereBracelet)';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':image', $image, PDO::PARAM_STR);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':idMarque', $idMarque, PDO::PARAM_INT);
            $stmt->bindParam(':idGenre', $idGenre, PDO::PARAM_INT);
            $stmt->bindParam(':idCouleur', $idCouleur, PDO::PARAM_INT);
            $stmt->bindParam(':idStyle', $idStyle, PDO::PARAM_INT);
            $stmt->bindParam(':idMouvement', $idMouvement, PDO::PARAM_INT);
            $stmt->bindParam(':idMatiereCadran', $idMatiereCadran, PDO::PARAM_INT);
            $stmt->bindParam(':idMatiereBracelet', $idMatiereBracelet, PDO::PARAM_INT);
            $stmt->execute();
            
        }catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }finally{
            unset($cnx);
        }
    }

    /**
     * Mettez à jour une montre existante dans la base de données.
     *
     * @param array $montre Les données de la montre mise à jour.
     * @return void
     */
    public static function updateMontre($id, $image, $nom, $prix, $stock, $description, $idMarque, $idGenre, $idCouleur, $idStyle, $idMouvement, $idMatiereCadran, $idMatiereBracelet){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $sql = 'UPDATE montre SET image = :image, nom = :nom, prix = :prix, stock = :stock, description = :description, idMarque = :idMarque, idGenre = :idGenre, idCouleur = :idCouleur, idStyle = :idStyle, idMouvement = :idMouvement, idMatiereCadran = :idMatiereCadran, idMatiereBracelet = :idMatiereBracelet WHERE idMontre = :idMontre';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':image', $image, PDO::PARAM_STR);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':idMarque', $idMarque, PDO::PARAM_INT);
            $stmt->bindParam(':idGenre', $idGenre, PDO::PARAM_INT);
            $stmt->bindParam(':idCouleur', $idCouleur, PDO::PARAM_INT);
            $stmt->bindParam(':idStyle', $idStyle, PDO::PARAM_INT);
            $stmt->bindParam(':idMouvement', $idMouvement, PDO::PARAM_INT);
            $stmt->bindParam(':idMatiereCadran', $idMatiereCadran, PDO::PARAM_INT);
            $stmt->bindParam(':idMatiereBracelet', $idMatiereBracelet, PDO::PARAM_INT);
            $stmt->bindParam(':idMontre', $id, PDO::PARAM_INT);

            $stmt->execute();
            
        }catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }finally{
            unset($cnx);
        }
    }

    /**
     * Insérez une nouvelle marque, genre, couleur, style, mouvement ou matière dans la base de données.
     *
     * @param string $type Le type de données à insérer (marque, genre, couleur, style, mouvement, matiere).
     * @param string $libelle Le libellé de la nouvelle entrée.
     * @return void
     */
    public static function setLibelle($type, $libelle){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $sql = "INSERT INTO $type(libelle) VALUES (:libelle)";

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':libelle', $libelle, PDO::PARAM_STR);
            $stmt->execute();
            
        }catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }finally{
            unset($cnx);
        }
    }

    /**
     * Supprimez une montre de la base de données.
     *
     * @param int $id L'ID de la montre à supprimer.
     * @return void
     */
    public static function deleteMontre($id){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $sql = 'DELETE FROM montre WHERE idMontre = :idMontre';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idMontre', $id, PDO::PARAM_INT);
            $stmt->execute();
            
        }catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }finally{
            unset($cnx);
        }
    }

    /**
     * Récupère et renvoie une liste de commandes en fonction de l'ID du client.
     */
    public static function getCommande(){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $sql = 'SELECT idCommande, dateCmd, idStatut FROM commande WHERE idClient = :idClient AND idStatut != 1';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idClient', $_SESSION['idClient'], PDO::PARAM_INT);
            $stmt->execute();

            $data = null;

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
        }
        catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }finally{
            unset($cnx);
        }

        return json_encode($data);
    }

    /**
     * Renvoie le nombre total de montres dans la base de données.
     */
    public static function getNombreMontre(){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $sql = 'SELECT COUNT(*) AS count FROM montre';

            $stmt = self::$cnx->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $count = $result['count'];

            return $count;
            
        }catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }finally{
            unset($cnx);
        }
    }

    /**
     * Renvoie les montres les plus populaires.
     */
    public static function getMeilleursMontres(){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $sql = 'SELECT MO.idMontre, MO.image, MO.nom, MO.prix, MO.stock, MA.libelle AS marque FROM montre MO JOIN marque MA ON MO.idMarque = MA.idMarque JOIN details_montre DM ON MO.idMontre = DM.idMontre GROUP BY MO.idMontre ORDER BY COUNT(DM.idMontre) DESC LIMIT 5;';

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
     * Renvoie les montres les plus récentes.
     */
    public static function getNouvellesMontres(){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $sql = 'SELECT idMontre, image, nom, prix, stock, MA.libelle AS marque FROM montre MO JOIN marque MA on MO.idMarque = MA.idMarque ORDER BY dateAjout DESC LIMIT 5;';

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
     * Renvoie les montres avec le stock le plus faible.
     */
    public static function getSurvivantes(){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $sql = 'SELECT idMontre, image, nom, prix, stock, MA.libelle AS marque FROM montre MO JOIN marque MA on MO.idMarque = MA.idMarque WHERE stock > 0 AND stock <= 5 ORDER BY stock ASC;';

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
}

?>