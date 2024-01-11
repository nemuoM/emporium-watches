<?php

/**
 * /model/Role.php
 * Class Role
 * 
 * @author M.MORABET
 * @date 11/2023
 */

 class Role {
    private $idRole;
    private $libelle;

    // Constructeur mis à jour
    public function __construct($idRole, $libelle) {
        $this->idRole = $idRole;
        $this->libelle = $libelle;
    }

    // Getters et Setters
    public function getIdRole() {
        return $this->idRole;
    }

    public function setIdRole($idRole) {
        $this->idRole = $idRole;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }
}

?>