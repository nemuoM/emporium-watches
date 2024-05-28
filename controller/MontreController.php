<?php

/**
 * /controller/MontreController.php
 * 
 * Contrôleur pour les montres
 * 
 * @author M.MORABET
 * @date 11/2023
 */

class MontreController extends Controller{

    /**
     * Affiche la page principale des montres.
     * Charge la vue correspondante à la liste des montres disponibles.
     * 
     * @param array $params Paramètres inutilisés dans cette fonction.
     */
    public static function montres($params){
        // appelle la vue
        $view = ROOT.'/view/nos-montre.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Traite une requête POST pour filtrer et afficher des produits (montres) selon différents critères.
     * Récupère les filtres envoyés via une requête POST au format JSON, les parse et les transmet à ProductManager::getLesMontres.
     * Répond avec une liste de montres filtrées au format JSON.
     * 
     * @param array $params Paramètres inutilisés dans cette fonction.
     */
    public static function affichePdt($params){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $input = json_decode(file_get_contents('php://input'), true);

            $filtres = [];
            if (isset($input['marque'])) {
                $filtres['marque'] = $input['marque'];
            }
            if (isset($input['genre'])) {
                $filtres['genre'] = $input['genre'];
            }
            if (isset($input['couleur'])) {
                $filtres['couleur'] = $input['couleur'];
            }
            if (isset($input['style'])) {
                $filtres['style'] = $input['style'];
            }
            if (isset($input['mouvement'])) {
                $filtres['mouvement'] = $input['mouvement'];
            }
            if (isset($input['matiereC'])) {
                $filtres['matiereC'] = $input['matiereC'];
            }
            if (isset($input['matiereB'])) {
                $filtres['matiereB'] = $input['matiereB'];
            }

            header('Content-Type: application/json');

            echo ProductManager::getLesMontres($filtres);
        }
    }

    public static function afficheMontre($params){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            echo ProductManager::getLesMontres(null);
        }
    }

    /**
     * Charge la vue de détail pour une montre spécifique.
     * 
     * @param array $params Paramètres inutilisés dans cette fonction.
     */
    public static function detailMontre($params){
        // appelle la vue
        $view = ROOT.'/view/detail.php';
        $params = array();
        self::render($view, $params);
    }
    
    /**
     * Gère une requête GET pour récupérer le détail d'une montre spécifique par son identifiant.
     * Utilise ProductManager::getMontreById pour récupérer et afficher les informations de la montre.
     * Répond au format JSON.
     * 
     * @param array $params Paramètres inutilisés dans cette fonction.
     */
    public static function maMontre($params){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = isset($_GET['id']) ? $_GET['id'] : '';

            header('Content-Type: application/json');

            echo ProductManager::getMontreById($id);
        }
    }

    /**
     * Traite une requête GET pour afficher toutes les marques de montres disponibles.
     * Utilise ProductManager::getMarque pour récupérer et afficher les marques au format JSON.
     * Ainsi de suite pour les fonction suivante.
     * 
     * @param array $params Paramètres inutilisés dans cette fonction.
     */
    public static function afficheMarque($params){
        if ($_SERVER['REQUEST_METHOD']==='GET'){
            echo ProductManager::getMarque();
        }
    }
    public static function afficheGenre($params){
        if ($_SERVER['REQUEST_METHOD']==='GET'){
            echo ProductManager::getGenre();
        }
    }
    public static function afficheCouleur($params){
        if ($_SERVER['REQUEST_METHOD']==='GET'){
            echo ProductManager::getCouleur();
        }
    }
    public static function afficheStyle($params){
        if ($_SERVER['REQUEST_METHOD']==='GET'){
            echo ProductManager::getStyle();
        }
    }
    public static function afficheMouvement($params){
        if ($_SERVER['REQUEST_METHOD']==='GET'){
            echo ProductManager::getMouvement();
        }
    }
    public static function afficheMatiere($params){
        if ($_SERVER['REQUEST_METHOD']==='GET'){
            echo ProductManager::getMatiere();
        }
    }

    public static function nettoyer($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /**
     * Récupère le terme de recherche envoyé via une requête POST et le transmet à ProductManager::getSearch.
     * Répond avec une liste de montres correspondant à la recherche au format JSON.
     * 
     * @param array $params Paramètres inutilisés dans cette fonction.
     */
    public static function search($params) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);
            $search = isset($input['search']) ? $input['search'] : '';

            // Supposons que self::nettoyer() nettoie correctement les données de recherche
            $search = self::nettoyer($search);

            header('Content-Type: application/json');

            // Assurez-vous que ProductManager::search() retourne des données au format JSON
            echo ProductManager::search($search);
        }
    }


}

?>
