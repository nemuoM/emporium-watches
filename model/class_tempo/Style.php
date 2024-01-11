<?php

/**
 * /model/Style.php
 * Class Style
 * 
 * @author M.MORABET
 * @date 11/2023
 */

class Style {
    private $idStyle;
    private $libelle;

    // Constructeur mis à jour
    public function __construct($idStyle, $libelle) {
        $this->idStyle = $idStyle;
        $this->libelle = $libelle;
    }

    // Getters et Setters pour idStyle
    public function getIdStyle() {
        return $this->idStyle;
    }

    public function setIdStyle($idStyle) {
        $this->idStyle = $idStyle;
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
