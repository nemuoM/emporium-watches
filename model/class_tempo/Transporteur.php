<?php

/**
 * /model/Transporteur.php
 * Class Transporteur
 * 
 * @author M.MORABET
 * @date 11/2023
 */

 class Transporteur {
    private $idTransporteur;
    private $nom;

    // Constructeur mis à jour
    public function __construct($idTransporteur, $nom) {
        $this->idTransporteur = $idTransporteur;
        $this->nom = $nom;
    }

    // Getters et Setters
    public function getIdTransporteur() {
        return $this->idTransporteur;
    }

    public function setIdTransporteur($idTransporteur) {
        $this->idTransporteur = $idTransporteur;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }
}



?>