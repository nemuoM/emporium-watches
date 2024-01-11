<?php

/**
 * /model/Categorie.php
 * Class Categorie
 * 
 * @author M.MORABET
 * @date 11/2023
 */

class Categorie {
    private $idCategorie;
    private $libelle;

    // Constructeur mis à jour
    public function __construct($idCategorie, $libelle) {
        $this->idCategorie = $idCategorie;
        $this->libelle = $libelle;
    }

    // Getters et Setters pour idCategorie
    public function getIdCategorie() {
        return $this->idCategorie;
    }

    public function setIdCategorie($idCategorie) {
        $this->idCategorie = $idCategorie;
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
