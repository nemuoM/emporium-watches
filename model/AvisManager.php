<?php

/**
 * /model/AvisManager.php
 * 
 * Définition de la classe AvisManager
 * Classe qui gère les interactions entre les avis des clients de l'application et la base de données
 * 
 * @author M.MORABET
 * @date 04/2024
 */

class AvisManager{
    
    private static ?\PDO $cnx = null;
    
    /**
     * Récupère les avis d'un produit donné.
     * Établit une connexion à la base de données si elle n'est pas déjà établie.
     * Récupère les avis associés à un produit donné.
     * 
     * @param int $idMontre L'identifiant du produit.
     * @return string Les avis associés au produit.
     */
    public static function getAvis($idMontre){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }

            $sql = 'SELECT idClient, idMontre, nbEtoile, description FROM avis WHERE idMontre = :idMontre';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idMontre', $idMontre);
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
     * Ajoute un avis pour un produit donné.
     * Établit une connexion à la base de données si elle n'est pas déjà établie.
     * Vérifie si le client a déjà soumis un avis pour ce produit.
     * Si oui, lance une exception.
     * Insère l'avis dans la base de données.
     * 
     * @param int $idClient L'identifiant du client.
     * @param int $idMontre L'identifiant du produit.
     * @param int $nbEtoile Le nombre d'étoiles de l'avis.
     * @param string $description La description de l'avis.
     * @throws Exception Si le client a déjà soumis un avis pour ce produit.
     */
    public static function addAvis($idClient, $idMontre, $nbEtoile, $description){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }

            // Vérifier si le client a déjà soumis un avis
            $existingAvis = self::getAvis($idMontre);
            foreach ($existingAvis as $avis) {
                if ($avis['idClient'] == $idClient) {
                    throw new Exception('Le client a déjà émis un avis.');
                }
            }

            $sql = 'INSERT INTO avis (idClient, idMontre, nbEtoile, description) VALUES (:idClient, :idMontre, :nbEtoile, :description)';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idClient', $idClient);
            $stmt->bindParam(':idMontre', $idMontre);
            $stmt->bindParam(':nbEtoile', $nbEtoile);
            $stmt->bindParam(':description', $description);
            $stmt->execute();

        }catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }
        finally{
            unset($cnx);
        }
    }

    /**
     * Supprime un avis pour un produit donné.
     * Établit une connexion à la base de données si elle n'est pas déjà établie.
     * Supprime l'avis correspondant à l'identifiant du client et de produit donnés.
     * 
     * @param int $idClient L'identifiant du client.
     * @param int $idMontre L'identifiant du produit.
     */
    public static function deleteAvis($idClient, $idMontre){
        try{
            if(self::$cnx == null){
                self::$cnx = DbManager::getConnexion();
            }

            $sql = 'DELETE FROM avis WHERE idClient = :idClient AND idMontre = :idMontre';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idClient', $idClient);
            $stmt->bindParam(':idMontre', $idMontre);
            $stmt->execute();

        }catch(PDOException $e){
            die('Erreur : ' . $e->getMessage());
        }
        finally{
            unset($cnx);
        }
    }
}

?>