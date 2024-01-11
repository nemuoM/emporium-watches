<?php

/**
 * /model/Client.php
 * Class Client
 * 
 * @author M.MORABET
 * @date 11/2023
 */

class Client {
    private $idClient, $tel;
    private $nom, $prenom, $mail, $mdp, $adresse, $cp, $ville;
    private datetime $dateNaissance;
    private Genre $idGenre;
    private Role $idRole;

    // Constructeur mis à jour
    public function __construct($idClient, $stock, $nom, $prenom, $prix, $dateNaissance, $idMarque, $idGenre, $idRole, $idStyle, $idMouvement, $idMatiereCadran, $idMatiereBracelet) {
        $this->idClient = $idClient;
        $this->nom = $nom;
        $this->stock = $stock;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->prix = $prix;
        $this->dateNaissance = $dateNaissance;
        $this->idMarque = $idMarque;
        $this->idGenre = $idGenre;
        $this->idRole = $idRole;
        $this->idStyle = $idStyle;
        $this->idMouvement = $idMouvement;
        $this->idMatiereCadran = $idMatiereCadran;
        $this->idMatiereBracelet = $idMatiereBracelet;
    }

    // Getters et Setters pour idClient
    public function getIdClient() {
        return $this->idClient;
    }
    public function setIdClient($idClient) {
        $this->idClient = $idClient;
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

    public function getPrenom(){
        return $this->prenom;
    }
    public function setPrenom(){
        $this->prenom = $prenom;
    }

    public function getMail(){
        return $this->mail;
    }
    public function setMail(){
        $this->mail = $mail;
    }

    public function getMdp(){
        return $this->mdp;
    }
    public function setMdp(){
        $this->mdp = $mdp;
    }

    public function getAdresse(){
        return $this->adresse;
    }
    public function setAdresse(){
        $this->adresse = $adresse;
    }

    public function getCp(){
        return $this->cp;
    }
    public function setCp(){
        $this->cp = $cp;
    }

    public function getVille(){
        return $this->ville;
    }
    public function setVille(){
        $this->ville = $ville;
    }

    public function getDateNaissance(){
        return $this->dateNaissance;
    }
    public function setDateNaissance(){
        $this->dateNaissance = $dateNaissance;
    }

    public function getIdGenre(){
        return $this->idGenre;
    }
    public function setIdGenre(){
        $this->idGenre = $idGenre;
    }

    public function getIdRole(){
        return $this->idRole;
    }
    public function setIdRole(){
        $this->idRole = $idRole;
    }
}

?>