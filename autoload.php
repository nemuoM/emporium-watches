<?php

/**
 * /autoload.php
 * Charge les classes
 * 
 * @author M.MORABET
 * 11/2023
 */


 require_once ROOT.'/model/DbManager.php';
 require_once ROOT.'/model/ProductManager.php';
 require_once ROOT.'/model/CartManager.php';
 require_once ROOT.'/model/ClientManager.php';
 require_once ROOT.'/model/AvisManager.php';

 require_once ROOT.'/controller/Controller.php';

?>