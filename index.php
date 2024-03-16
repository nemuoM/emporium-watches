<?php

/**
 * /index.php
 * Page d'acceuil
 * 
 * @author M.MORABET
 * @date 11/2023 
 */

// Enregistrement de la racine du site
define('SERVER_URL', "../../../..");
define('ROOT', __DIR__);
define('DEFAULT_CONTROLLER', 'view');
define('DEFAULT_ACTION', 'accueil');

// Autochargement des classes
require_once ROOT . '/autoload.php';
session_start();

// Récupère les paramètres de l'URL
if (isset($_GET) && !empty($_GET)) {
    // Extrait les valeurs du $_GET
    extract($_GET);
} else {
    // Si aucun paramètre n'est passé, utilise les valeurs par défaut
    $controller = DEFAULT_CONTROLLER;
    $action = DEFAULT_ACTION;
}

// Si l'utilisateur veut réinitialiser, effectue la réinitialisation de la base de données
if ($controller == 'reinitilize') {
    require_once 'model/DbManager.php';
    DbManager::reset();
    header('Location: /');
    exit();
}

// Si des paramètres supplémentaires sont présents dans l'URL (autres que controller et action),
// ils sont stockés dans un tableau nommé $params
$params = array();
foreach ($_GET as $key => $value) {
    if (($key != 'controller') && ($key != 'action')) {
        $params[$key] = $value;
    }
}

// Route vers le contrôleur et l'action
// Vérifie si le contrôleur demandé existe, sinon affiche une page d'erreur
// Vérifie si l'action demandée existe dans le contrôleur, sinon affiche une page d'erreur
$controller .= 'Controller'; // Complète le nom du contrôleur
$filename = ROOT . '/controller/' . $controller . '.php';
if (file_exists($filename)) {
    // Le fichier du contrôleur existe
    // Inclut le fichier de classe du contrôleur 
    require_once ROOT . '/controller/' . $controller . '.php';
    if (method_exists($controller, $action)) {
        // Appelle la méthode correspondant à l'action
        // Si d'autres paramètres sont présents dans l'URL, ils doivent être passés au contrôleur
        $controller::$action($params);
    } else {
        // La méthode correspondant à l'action n'existe pas 
        header('Location: ' . SERVER_URL . '/erreur/');
    }
} else {
    // Le fichier du contrôleur n'existe pas
    header('Location: ' . SERVER_URL . '/erreur/');
}

?>
