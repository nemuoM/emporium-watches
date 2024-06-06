<?php

/**
 * Description de la classe CartManager.php
 * Classe qui gère le panier
 * 
 * @author M.MORABET
 * @date 12/2023
 */

class CartManager{

    private static ?\PDO $cnx = null;

    /**
     * Récupère le contenu du panier
     * 
     * @return string
     */
    public static function getCart(){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $idCo = $_SESSION['idCommande'];

            $sql = 'SELECT DM.idMontre, image, nom, prix, MO.stock, qte, MA.libelle AS marque FROM montre MO ';
            $sql .= 'JOIN marque MA on MO.idMarque = MA.idMarque ';
            $sql .= 'JOIN details_montre DM on MO.idMontre = DM.idMontre ';
            $sql .= 'JOIN commande CO on DM.idCommande = CO.idCommande ';
            $sql .= 'WHERE CO.idCommande = :idCo AND idStatut = 1;';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idCo', $idCo);
            $stmt->execute();

            $data = null;

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }

        }catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }
        finally{
            unset($cnx);
        }

        return json_encode($data);  
    }
    
    /**
     * Synchronise le panier avec une commande existante
     * 
     * @param int $idC
     * @return void
     */
    public static function syncCart($idC){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $sql = 'SELECT idCommande from Commande where idClient = :id and idStatut = 1;';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':id',$idC);
            $stmt->execute();

            $row = $stmt->fetch();

            $_SESSION['idCommande'] = $row['idCommande'];

            unset($cnx);
        }catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Crée un nouveau panier pour un client
     * 
     * @return void
     */
    public static function createCart(){ 
        //création de son cart à l'inscription + qd il cmd ça valide et ça crée un nouveau cart aussi faire en sorte qu'a l'inscription on récup l'idClient
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $id = $_SESSION['idClient'];

            $sql = 'INSERT INTO `commande`(dateCmd, idstatut, idClient) VALUES (NOW(), 1, :idC)';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idC', $id, PDO::PARAM_INT);

            $stmt->execute();

            self::syncCart($id);
            
            unset($cnx);
        } catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Ajoute une montre au panier
     * 
     * @param int $idMontre
     * @return bool
     */
    public static function addToCartM($idMontre){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $id = $_SESSION['idCommande'];

            $sql = 'CALL AjtOuCreerCart(:idC, :idM, 1)';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idC', $id, PDO::PARAM_INT);
            $stmt->bindParam(':idM', $idMontre, PDO::PARAM_INT);

            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }

            unset($cnx);
        }catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Supprime un produit du panier
     * 
     * @param int $idMontre
     * @return bool
     */
    public static function deleteProd($idMontre){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $id = $_SESSION['idCommande'];

            $sql = 'DELETE FROM details_montre WHERE idCommande = :idC AND idMontre = :idM';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idC', $id, PDO::PARAM_INT);
            $stmt->bindParam(':idM', $idMontre, PDO::PARAM_INT);

            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }

            unset($cnx);
        }catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Décrémente la quantité d'une montre dans le panier
     * 
     * @param int $idMontre
     * @return bool
     */
    public static function decrQuantity($idMontre){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $id = $_SESSION['idCommande'];

            $sql = 'CALL decrDelete(:idC, :idM)';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idC', $id, PDO::PARAM_INT);
            $stmt->bindParam(':idM', $idMontre, PDO::PARAM_INT);

            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }

            unset($cnx);
        }catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Récupère le statut de la commande
     * 
     * @return int
     */
    public static function getStatutCommande(){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $id = $_SESSION['idCommande'];

            $sql = 'SELECT idStatut, dateChangement FROM changement_statut WHERE idCommande = :idC';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idC', $id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch();

            return $row['idStatut'];

            unset($cnx);
        }catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Annule le panier en mettant à jour le statut de la commande.
     *
     * @return bool Retourne true si la mise à jour a réussi, sinon false.
     * @throws PDOException En cas d'erreur lors de l'exécution de la requête SQL.
     */
    public static function cancelCart(){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $id = $_SESSION['idCommandeC'];

            $sql = 'UPDATE commande SET idStatut = 6 WHERE idCommande = :idC';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idC', $id, PDO::PARAM_INT);

            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }

            unset($cnx);
        }catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Annule une commande en mettant à jour le statut de la commande.
     * 
     * @param int $id
     * @return bool
     */
    public static function cancelCmd($id){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }

            $sql = 'UPDATE commande SET idStatut = 6 WHERE idCommande = :idC';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idC', $id, PDO::PARAM_INT);

            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }

            unset($cnx);
        }catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Confirme le panier en mettant à jour le statut de la commande.
     * 
     * @param string $adresse adresse du client
     * @param string $codePostal code postal du client
     * @param string $ville ville du client
     * @param string $phone_number numéro de téléphone du client
     */
    public static function confirmCart($adresse, $codePostal, $ville, $phone_number){
        try{
            ClientManager::updateAdresse($_SESSION['idClient'], $adresse, $codePostal, $ville, $phone_number);
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $id = $_SESSION['idCommande'];

            $sql = 'UPDATE commande SET idStatut = 2, dateCmd = NOW() WHERE idCommande = :idC';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idC', $id, PDO::PARAM_INT);

            if($stmt->execute()){
                self::createCart(); // Move the createCart() call here
                $_SESSION['idCommandeC'] = $id; // Create a session variable to store the idCommande
                return true;
            }
            else{
                return false;
            }

            unset($cnx);
        }catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Récupère le contenu du panier confirmé
     * 
     * @return json
     */
    public static function getConfirmedCart(){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $id = $_SESSION['idCommandeC'];

            $sql = 'SELECT nom, prix, qte, MA.libelle AS marque FROM montre MO ';
            $sql .= 'JOIN marque MA on MO.idMarque = MA.idMarque ';
            $sql .= 'JOIN details_montre DM on MO.idMontre = DM.idMontre ';
            $sql .= 'JOIN commande CO on DM.idCommande = CO.idCommande ';
            $sql .= 'WHERE CO.idCommande = :idCo AND CO.idStatut = 2;';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idCo', $id);
            $stmt->execute();

            $data = null;

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }

        }catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }
        finally{
            unset($cnx);
        }

        return json_encode($data);  
    }

    /**
     * Récupère une commande et ses détails ainsi que le statut de la commande
     * 
     * @param int $id
     * @return json
     */
    public static function getCmd($id){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }

            $sql = 'SELECT CO.idStatut, image, nom, prix, qte, MA.libelle AS marque FROM montre MO ';
            $sql .= 'JOIN marque MA on MO.idMarque = MA.idMarque ';
            $sql .= 'JOIN details_montre DM on MO.idMontre = DM.idMontre ';
            $sql .= 'JOIN commande CO on DM.idCommande = CO.idCommande ';
            $sql .= 'WHERE CO.idCommande = :idCo;';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idCo', $id);
            $stmt->execute();

            $data = null;

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }

        }catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }
        finally{
            unset($cnx);
        }

        return json_encode($data);  
    }

    /**
     * Récupère le nombre de commandes en cours
     * 
     * @return int
     */
    public static function getNbCmd(){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }

            $sql = 'SELECT COUNT(idCommande) AS count FROM commande WHERE idStatut != 1';

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
}

?>