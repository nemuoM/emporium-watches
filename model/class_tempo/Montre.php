<?php

/**
 * /model/Montre.php
 * Class Montre
 * 
 * @author M.MORABET
 * @date 11/2023
 */

class Montre {
    private $idMontre, $stock;
    private $nom, $description;
    private $prix;
    private datetime $dateAjout;
    private Marque $idMarque;
    private Genre $idGenre;
    private Couleur $idCouleur;
    private Style $idStyle;
    private Mouvement $idMouvement;
    private Matiere $idMatiereCadran;
    private Matiere $idMatiereBracelet;

    // Constructeur mis à jour
    public function __construct($idMontre, $stock, $nom, $description, $prix, $dateAjout, $idMarque, $idGenre, $idCouleur, $idStyle, $idMouvement, $idMatiereCadran, $idMatiereBracelet) {
        $this->idMontre = $idMontre;
        $this->nom = $nom;
        $this->stock = $stock;
        $this->nom = $nom;
        $this->description = $description;
        $this->prix = $prix;
        $this->dateAjout = $dateAjout;
        $this->idMarque = $idMarque;
        $this->idGenre = $idGenre;
        $this->idCouleur = $idCouleur;
        $this->idStyle = $idStyle;
        $this->idMouvement = $idMouvement;
        $this->idMatiereCadran = $idMatiereCadran;
        $this->idMatiereBracelet = $idMatiereBracelet;
    }

    // Getters et Setters pour idMontre
    public function getIdMontre() {
        return $this->idMontre;
    }
    public function setIdMontre($idMontre) {
        $this->idMontre = $idMontre;
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

    public function getIdCouleur(){
        return $this->idCouleur;
    }
    public function setIdCouleur(){
        $this->idCouleur = $idCouleur;
    }

    public function getIdStyle(){
        return $this->idStyle;
    }
    public function setIdStyle(){
        $this->idStyle = $idStyle;
    }

    public function getIdMouvement(){
        return $this->idMouvement;
    }
    public function setIdMouvement($idMouvement){
        $this->idMouvement = $idMouvement;
    }

    public function getIdMatiereCadran(){
        return $this->idMatiereCadran;
    }
    public function setIdMatiereCadran($idMatiereCadran){
        $this->idMatiereCadran = $idMatiereCadran;
    }

    public function getIdMatiereBracelet(){
        return $this->idMatiereBracelet;
    }
    public function setIdMatiereBracelet($idMatiereBracelet){
        $this->idMatiereBracelet = $idMatiereBracelet;
    }
}

?>