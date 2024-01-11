<?php

/**
 * /model/Details_accessoires.php
 * Class Details_accessoires
 * 
 * @author M.MORABET
 * @date 11/2023
 */

 class Details_accessoires {
    private Commande $idCommande;
    private Accessoire $idAccessoire;
    private $qte;

    // Constructeur mis à jour
    public function __construct($idCommande, $idAccessoire, $qte) {
        $this->idCommande = $idCommande;
        $this->idAccessoire = $idAccessoire;
        $this->qte = $qte;

    }

    // Getters et Setters
    public function getIdCommande() {
        return $this->idCommande;
    }

    public function setIdCommande($idCommande) {
        $this->idCommande = $idCommande;
    }

    public function getIdAccessoire() {
        return $this->idAccessoire;
    }

    public function setIdAccessoire($idAccessoire) {
        $this->idAccessoire = $idAccessoire;
    }

    public function getqte() {
        return $this->qte;
    }

    public function setqte($qte) {
        $this->qte = $qte;
    }
}



?>