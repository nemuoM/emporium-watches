<?php

/**
 * /model/Avis.php
 * Class Avis
 * 
 * @author M.MORABET
 * @date 11/2023
 */

 class Avis {
    private Client $idClient;
    private Montre $idMontre;
    private $nbEtoile;
    private $desciption;

    // Constructeur mis à jour
    public function __construct($idClient, $idMontre, $nbEtoile, $desciption) {
        $this->idClient = $idClient;
        $this->idMontre = $idMontre;
        $this->nbEtoile = $nbEtoile;
        $this->desciption = $desciption;

    }

    // Getters et Setters
    public function getIdClient() {
        return $this->idClient;
    }

    public function setIdClient($idClient) {
        $this->idClient = $idClient;
    }

    public function getIdMontre() {
        return $this->idMontre;
    }

    public function setIdMontre($idMontre) {
        $this->idMontre = $idMontre;
    }

    public function getNbEtoile() {
        return $this->nbEtoile;
    }

    public function setNbEtoile($nbEtoile) {
        $this->nbEtoile = $nbEtoile;
    }

    public function getDesciption() {
        return $this->desciption;
    }

    public function setDesciption($desciption) {
        $this->desciption = $desciption;
    }
}



?>