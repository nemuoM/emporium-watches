<?php

/**
 * /model/Commande.php
 * Class Commande
 * 
 * @author M.MORABET
 * @date 11/2023
 */

 class Commande {
    private Commande $idCommande;
    private Transporteur $idTransporteur;
    private Client $idClient;
    private datetime $dateCmd;

    // Constructeur mis à jour
    public function __construct($idCommande, $idTransporteur, $idClient, $dateCmd) {
        $this->idCommande = $idCommande;
        $this->idTransporteur = $idTransporteur;
        $this->idClient = $idClient;
        $this->dateCmd = $dateCmd;

    }

    // Getters et Setters
    public function getIdCommande() {
        return $this->idCommande;
    }

    public function setIdCommande($idCommande) {
        $this->idCommande = $idCommande;
    }

    public function getIdTransporteur() {
        return $this->idTransporteur;
    }

    public function setIdTransporteur($idTransporteur) {
        $this->idTransporteur = $idTransporteur;
    }

    public function getIdClient() {
        return $this->idClient;
    }

    public function setIdClient($idClient) {
        $this->idClient = $idClient;
    }

    public function getDateCmd() {
        return $this->dateCmd;
    }

    public function setDateCmd($dateCmd) {
        $this->dateCmd = $dateCmd;
    }
}



?>