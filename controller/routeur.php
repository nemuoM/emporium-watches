<?php
/**
 * /controller/routeur.php
 * 
 * Fichier de routage vers le bon contrôleur et la bonne action
 * 
 * @author M.MORABET
 * @date 09/2023
 */

// Inclut le fichier de classe du controller
$controller .= 'Controller'; // la variable controller ne contenait qu'une partie du nom du fichier, on le complète
require_once ROOT.'/controller/'.$controller.'.php';

// Appelle la méthode correspondant à l'action
// Si dans l'URL, en plus des paramètres controller et action, il y a d'autres paramètres alors ils doivent être passés au contrôleur
$controller::$action($params);

?>
