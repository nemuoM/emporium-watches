<?php

/**
 * /model/Matiere.php
 * Class Matiere
 * 
 * @author M.MORABET
 * @date 11/2023
 */

class Matiere {
    private $idMatiere;
    private $libelle;

    // Constructeur mis à jour
    public function __construct($idMatiere, $libelle) {
        $this->idMatiere = $idMatiere;
        $this->libelle = $libelle;
    }

    // Getters et Setters pour idMatiere
    public function getIdMatiere() {
        return $this->idMatiere;
    }

    public function setIdMatiere($idMatiere) {
        $this->idMatiere = $idMatiere;
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
