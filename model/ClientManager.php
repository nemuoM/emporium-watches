<?php

/**
 * /model/ClientManager.php
 * 
 * Définition de la classe ClientManager
 * Classe qui gère les interactions entre les clients de l'application et la base de données
 * 
 * @author M.MORABET
 * @date 12/2023
 */


class ClientManager
{

    private static ?\PDO $cnx = null;

    /**
     * Tente de connecter un client en utilisant son adresse e-mail et son mot de passe.
     * Établit une connexion à la base de données si elle n'est pas déjà établie.
     * Vérifie les informations de connexion fournies par rapport à celles dans la base de données.
     * Si les informations sont correctes, initialise une session pour l'utilisateur et le redirige vers l'URL du serveur.
     * Sinon, retourne un message d'erreur.
     * 
     * @param string $mail L'adresse e-mail du client.
     * @param string $mdp Le mot de passe du client.
     * @return string Message indiquant le succès ou l'échec de la connexion.
     */
    public static function connexion($mail, $mdp)
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            $message = '';

            $sql = 'SELECT idClient, nom, prenom, mail, mdp, telephone, adresse, cp, ville, idGenre, idRole FROM client WHERE mail = :mail';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->execute();

            $row = $stmt->fetch();

            if ($row !== false) {
                $id = $row['idClient'];
                $nom = $row['nom'];
                $prenom = $row['prenom'];
                $mail = $row['mail'];
                $mdpHash = $row['mdp'];
                $telephone = $row['telephone'];
                $adresse = $row['adresse'];
                $cp = $row['cp'];
                $ville = $row['ville'];
                $genre = $row['idGenre'];
                $role = $row['idRole'];

                if (password_verify($mdp, $mdpHash)) {
                    $_SESSION['idClient'] = $id;
                    $_SESSION['nom'] = $nom;
                    $_SESSION['prenom'] = $prenom;
                    $_SESSION['mail'] = $mail;
                    $_SESSION['mdpHash'] = $mdpHash;
                    $_SESSION['telephone'] = $telephone;
                    $_SESSION['adresse'] = $adresse;
                    $_SESSION['cp'] = $cp;
                    $_SESSION['ville'] = $ville;
                    $_SESSION['idGenre'] = $genre;
                    $_SESSION['idRole'] = $role;
                    CartManager::syncCart($id);

                    header('Location: ' . SERVER_URL);
                } else {
                    // Message d'erreur de connexion
                    $message = 'L\'adresse e-mail ou le mot de passe est incorrect';
                }
            } else {
                // Message d'erreur de connexion
                $message = 'L\'adresse e-mail ou le mot de passe est incorrect';
            }

            unset($cnx);
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }


        return $message;
    }

    /**
     * Ajoute un nouveau client à la base de données.
     * Établit une connexion à la base de données si elle n'est pas déjà établie.
     * Enregistre les informations du nouveau client dans la base de données.
     * Initialise une session pour le nouveau client et le redirige vers une page de bienvenue.
     * 
     * @param string $prenom Le prénom du client.
     * @param string $nom Le nom de famille du client.
     * @param int $genreselect L'identifiant du genre du client.
     * @param string $adressemail L'adresse e-mail du client.
     * @param string $mdpHash Le mot de passe haché du client.
     */
    public static function addClient($prenom, $nom, $genreselect, $adressemail, $mdp)
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }
            // Hash le mot de passe avec Bcrypt, via un coût de 10
            $cost = ['cost' => 10];
            $mdpHash = password_hash($mdp, PASSWORD_BCRYPT, $cost);

            $sql = 'INSERT INTO `client`(nom, prenom, mail, mdp, telephone, adresse, cp, ville, idGenre, idRole) VALUES (:n, :p, :m, :mdp, null, null, null, null, :idG, 3)';

            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':n', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':p', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':m', $adressemail, PDO::PARAM_STR);
            $stmt->bindParam(':mdp', $mdpHash, PDO::PARAM_STR);
            $stmt->bindParam(':idG', $genreselect, PDO::PARAM_INT);

            $stmt->execute();

            self::connexion($adressemail, $mdp);
            CartManager::createCart();

            header('Location: ' . SERVER_URL . '/bienvenue/');

            unset($cnx);
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}

?>
