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

    public static function getCart(){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $idCo = $_SESSION['idCommande'];

            $sql = 'SELECT DM.idMontre, image, nom, prix, stock, qte, MA.libelle AS marque FROM montre MO ';
            $sql .= 'JOIN marque MA on MO.idMarque = MA.idMarque ';
            $sql .= 'JOIN details_montre DM on MO.idMontre = DM.idMontre ';
            $sql .= 'WHERE idCommande = :idCo';

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

    public static function createCart(){ 
        //création de son cart à l'inscription + qd il cmd ça valide et ça crée un nouveau cart aussi faire en sorte qu'a l'inscription on récup l'idClient
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }
            $id = $_SESSION['idClient'];

            $sql = 'INSERT INTO `commande`(dateCmd, idstatut, idTransporteur, idClient) VALUES (NOW(), 1, null,:idC)';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idC', $id, PDO::PARAM_INT);

            $stmt->execute();

            self::syncCart($id);
            
            unset($cnx);
        } catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }
    }

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


 }

?>