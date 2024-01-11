<?php

/**
 * /controller/Controller.php
 * class technique pour définir les membres communs aux controllers
 * 
 * @author M.MORABET
 * @date 09/2023
 */

 class Controller {
    public static function render($view, $param){
        extract($param);
        require_once $view;
    }
 }