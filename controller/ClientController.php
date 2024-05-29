<?php

/**
 * /controller/ClientController.php
 * 
 * Contrôleur pour les clients
 * 
 * @author M.MORABET
 * @date 12/2023
 */

class ClientController extends Controller {

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
     * Charge la vue de l'espace membre.
     * Utilise la méthode `render` pour afficher la vue spécifiée avec les paramètres fournis.
     * 
     * @param array $params Les paramètres à passer à la vue.
     */
    public static function espaceMembre($params){
        $view = ROOT.'/view/espace-membre.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Gère le processus de connexion de l'utilisateur.
     * Vérifie si les identifiants sont fournis et nettoie ces données.
     * Utilise `ClientManager::connexion` pour valider les identifiants et générer un message en conséquence.
     * Affiche la vue de l'espace membre avec un message de succès ou d'erreur.
     * 
     * @param array $params Les paramètres à passer à la vue.
     */
    public static function seconnecter($params){
        if(isset($_POST['identifiant']) && !empty($_POST['identifiant']) && isset($_POST['mdp']) && !empty($_POST['mdp'])){
            $identifiant = self::nettoyer($_POST['identifiant']);
            $mdp = self::nettoyer($_POST['mdp']);

            $message = ClientManager::connexion($identifiant, $mdp);
            if($message === 'Connexion réussie'){
            echo json_encode(['success' => 'Profil mis à jour avec succès !']);
            } else {
            echo json_encode(['error' => 'Échec de la connexion. Veuillez vérifier vos identifiants.']);
            }
        }

    }

    /**
     * Gère le processus de déconnexion de l'utilisateur.
     * Vérifie si l'utilisateur est actuellement connecté en cherchant une session active.
     * Si une session est active, elle est détruite pour déconnecter l'utilisateur.
     * Ensuite, redirige l'utilisateur vers la page d'accueil du site.
     * 
     * @param array $params Les paramètres inutilisés dans cette fonction.
     */
    public static function deconnexion($params){
        if(isset($_SESSION['mail'])) {
            session_destroy();
            header('Location: '.SERVER_URL);
        }
    }

    /**
     * Gère le processus d'inscription de l'utilisateur.
     * Vérifie et nettoie les données fournies dans le formulaire d'inscription.
     * Applique des traitements spécifiques sur les données comme le hachage du mot de passe,
     * la normalisation du prénom et du nom.
     * Utilise `ClientManager::addClient` pour enregistrer un nouveau client.
     * Affiche la vue de l'espace membre avec un message de succès ou d'erreur.
     * 
     * @param array $params Les paramètres à passer à la vue.
     */
    public static function inscription($params){
        $message = '';
        if( isset($_POST['genre']) && !empty($_POST['genre'])
         && isset($_POST['nom']) && !empty($_POST['nom'])
         && isset($_POST['prenom']) && !empty($_POST['prenom']) 
         && isset($_POST['mail']) && !empty($_POST['mail']) 
         && isset($_POST['lemdp']) && !empty($_POST['lemdp']) 
         && isset($_POST['confirm']) && !empty($_POST['confirm']))
         {
            $genreselect = self::nettoyer($_POST['genre']);
            $nom = self::nettoyer($_POST['nom']);
            $prenom = self::nettoyer($_POST['prenom']);
            $adressemail = self::nettoyer($_POST['mail']);
            $mdp = self::nettoyer($_POST['lemdp']);
            $mdpconfirm = self::nettoyer($_POST['confirm']);

            if($mdp === $mdpconfirm){
                // Met en minuscule l'email
                $adressemail = strtolower($adressemail);

                // Met en majuscule la première lettre du prénom
                if(strpos($prenom, "-") !== false) {
                    $prenoms = explode('-', $prenom);
                    foreach ($prenoms as &$lePrenom) {
                      $lePrenom = ucfirst($lePrenom);
                    }
                    $prenom = implode('-', $prenoms);
                } else {
                    $prenom = ucfirst($prenom);
                }

                // Met en majuscule le nom de famille
                $nom = strtoupper($nom);

                ClientManager::addClient($prenom, $nom, $genreselect, $adressemail, $mdp);
            } else {
                $message = 'Les mots de passe ne sont pas identiques';
            }
        } else {
            $message = 'Veuillez remplir tous les champs';
        }

        $view = ROOT.'/view/espace-membre.php';
        $params = array();
        $params['message'] = $message;
        self::render($view, $params);
    }
}

?>
