<?php 

/**
 * /index.php
 * Page d'acceuil
 * 
 * @author M.MORABET
 * @date 11/2023 
 */

 // enregistrement de la racine du site
 define ('SERVER_URL', "../../../..");
 define ('ROOT', __DIR__);
 define ('DEFAULT_CONTROLLER', 'view');
 define ('DEFAULT_ACTION', 'accueil');

 //autochargement des class
require_once ROOT.'/autoload.php';
session_start();

//récupère les paramètre de l'url
if(isset($_GET) && !empty($_GET)){
    //extrait les valeurs du $_GET
    extract($_GET);
}else{
    //si il n'en a pas alors c'est la page par défaut
    $controller = DEFAULT_CONTROLLER;
    $action = DEFAULT_ACTION;
}

if($controller == 'reinitilize'){
    require_once 'model/DbManager.php';
    DbManager::reset();
    header('Location: /');
    exit();
}

//si il y a des paramètres en + de controller et action: 
//ils sont stockés dans un array nommé $params
$params = array();
foreach($_GET as $key=>$value){
    if(($key != 'controller') && ($key != 'action')){
        $params[$key] = $value;
    }
}

//test la bonne lecture des paramètres $_GET
// print_r($controller);
//print_r($action);
foreach($params as $key=>$value){
    //print_r('<br />'.$key.'=>'.$value);
}

// route vers le controller et l'action
// vérifie que le controller requeté existe
// sinon page d'erreur
//idem pour l'action
$controller .= 'Controller'; //la variable controller ne contenait qu'une partie du nom du fichier, on le complète
$filename = ROOT.'/controller/'.$controller.'.php';
//print_r('filename = '.$filename);
if(file_exists($filename)){
    // le fichier  du controller existe
    // inclut le fichier de class du controller 
    require_once ROOT.'/controller/'.$controller.'.php';
    if(method_exists($controller,$action)){
        // appelle la méthode correspondant à l'action
        // si dans l'url, en plus des paramètres controller et action, il y a d'autres paramètres alors ils doivent être passés au controller
        $controller::$action($params);
    }else{
        // la méthode correspondant à l'action n'exite pas 
        header('Location: '.SERVER_URL.'/erreur/');
    }
}else {
    //le fichier du controller n'exite pas
    header('Location: '.SERVER_URL.'/erreur/');
}


?>