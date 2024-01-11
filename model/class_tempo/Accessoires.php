<?php

/**
 * /model/Accessoires.php
 * Class Accessoires
 * 
 * @author M.MORABET
 * @date 11/2023
 */

class Accessoire {
    private $idAccessoire, $stock;
    private $nom, $description;
    private $prix;
    private datetime $dateAjout;
    private Marque $idMarque;
    private Genre $idGenre;
    private Categorie $idCategorie;
    private Ss_categorie $numSs_categorie;
    private Montre $idMontre;

    // Constructeur mis à jour
    public function __construct($idAccessoire, $stock, $nom, $description, $prix, $dateAjout, $idMarque, $idGenre, $idCategorie, $numSs_categorie, $idMontre, $idMatiereCadran, $idMatiereBracelet) {
        $this->idAccessoire = $idAccessoire;
        $this->nom = $nom;
        $this->stock = $stock;
        $this->nom = $nom;
        $this->description = $description;
        $this->prix = $prix;
        $this->dateAjout = $dateAjout;
        $this->idMarque = $idMarque;
        $this->idGenre = $idGenre;
        $this->idCategorie = $idCategorie;
        $this->numSs_categorie = $numSs_categorie;
        $this->idMontre = $idMontre;
        $this->idMatiereCadran = $idMatiereCadran;
        $this->idMatiereBracelet = $idMatiereBracelet;
    }

    // Getters et Setters pour idAccessoire
    public function getidAccessoire() {
        return $this->idAccessoire;
    }
    public function setidAccessoire($idAccessoire) {
        $this->idAccessoire = $idAccessoire;
    }

    // Getters et Setters pour nom
    public function getNom() {
        return $this->nom;
    }
    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getStock(){
        return $this->stock;
    }
    public function setStock(){
        $this->stock = $stock;
    }

    public function getDescription(){
        return $this->description;
    }
    public function setDescription(){
        $this->description = $description;
    }
    
    public function getPrix(){
        return $this->prix;
    }
    public function setPrix(){
        $this->prix = $prix;
    }

    public function getDateAjout(){
        return $this->dateAjout;
    }
    public function setDateAjout(){
        $this->dateAjout = $dateAjout;
    }

    public function getIdMarque(){
        return $this->idMarque;
    }
    public function setIdMarque(){
        $this->idMarque = $idMarque;
    }

    public function getIdGenre(){
        return $this->idGenre;
    }
    public function setIdGenre(){
        $this->idGenre = $idGenre;
    }

    public function getIdCategorie(){
        return $this->idCategorie;
    }
    public function setIdCategorie(){
        $this->idCategorie = $idCategorie;
    }

    public function getnumSs_categorie(){
        return $this->numSs_categorie;
    }
    public function setnumSs_categorie(){
        $this->numSs_categorie = $numSs_categorie;
    }

    public function getIdMontre(){
        return $this->idMontre;
    }
    public function setIdMontre(){
        $this->idMontre = $idMontre;
    }
}

?>