<?php

/**
 * /model/Mouvement.php
 * Class Mouvement
 * 
 * @author M.MORABET
 * @date 11/2023
 */

class Mouvement {
    private $idMouvement;
    private $libelle;

    // Constructeur mis à jour
    public function __construct($idMouvement, $libelle) {
        $this->idMouvement = $idMouvement;
        $this->libelle = $libelle;
    }

    // Getters et Setters pour idMouvement
    public function getIdMouvement() {
        return $this->idMouvement;
    }

    public function setIdMouvement($idMouvement) {
        $this->idMouvement = $idMouvement;
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
