<?php

/**
 * /model/Genre.php
 * Class Genre
 * 
 * @author M.MORABET
 * @date 11/2023
 */

class Genre {
    private $idGenre;
    private $libelle;

    // Constructeur mis à jour
    public function __construct($idGenre, $libelle) {
        $this->idGenre = $idGenre;
        $this->libelle = $libelle;
    }

    // Getters et Setters pour idGenre
    public function getIdGenre() {
        return $this->idGenre;
    }

    public function setIdGenre($idGenre) {
        $this->idGenre = $idGenre;
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
