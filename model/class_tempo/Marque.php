<?php

/**
 * /model/Marque.php
 * Class Marque
 * 
 * @author M.MORABET
 * @date 11/2023
 */

class Marque {
    private $idMarque;
    private $libelle;

    // Constructeur mis à jour
    public function __construct($idMarque, $libelle) {
        $this->idMarque = $idMarque;
        $this->libelle = $libelle;
    }

    // Getters et Setters pour idMarque
    public function getIdMarque() {
        return $this->idMarque;
    }

    public function setIdMarque($idMarque) {
        $this->idMarque = $idMarque;
    }

    // Getters et Setters pour libelle
    public function getLibelle() {
        return $this->libelle;
    }

    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }
}

?>
