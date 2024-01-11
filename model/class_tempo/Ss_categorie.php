<?php

/**
 * /model/Ss_categorie.php
 * Class Ss_categorie
 * 
 * @author M.MORABET
 * @date 11/2023
 */

 class ss_categorie {
    private $numero;
    private Categorie $idCategorie;
    private $libelle;

    public function __construct( $numero, $idCategorie, $libelle) {
        $this->idCategorie = $idCategorie;
        $this->numero = $numero;
        $this->libelle = $libelle;
    }

    public function getNumero(){
        return $this->numero;
    }
    public function setNumero(){
        $this->numero = $numero;
    }

    public function getIdCategorie() {
        return $this->idCategorie;
    }

    public function setIdCategorie($idCategorie) {
        $this->idCategorie = $idCategorie;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }
 }

?>