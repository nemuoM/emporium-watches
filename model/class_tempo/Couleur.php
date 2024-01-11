<?php

/**
 * /model/Couleur.php
 * Class Couleur
 * 
 * @author M.MORABET
 * @date 11/2023
 */

class Couleur {
    private $idCouleur;
    private $libelle;

    // Constructeur mis à jour
    public function __construct($idCouleur, $libelle) {
        $this->idCouleur = $idCouleur;
        $this->libelle = $libelle;
    }

    // Getters et Setters pour idCouleur
    public function getIdCouleur() {
        return $this->idCouleur;
    }

    public function setIdCouleur($idCouleur) {
        $this->idCouleur = $idCouleur;
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
