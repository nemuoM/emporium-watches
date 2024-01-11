<?php

/**
 * /model/Details_montre.php
 * Class Details_montre
 * 
 * @author M.MORABET
 * @date 11/2023
 */

 class Details_montre {
    private Commande $idCommande;
    private Montre $idMontre;
    private $qte;

    // Constructeur mis à jour
    public function __construct($idCommande, $idMontre, $qte) {
        $this->idCommande = $idCommande;
        $this->idMontre = $idMontre;
        $this->qte = $qte;

    }

    // Getters et Setters
    public function getIdCommande() {
        return $this->idCommande;
    }

    public function setIdCommande($idCommande) {
        $this->idCommande = $idCommande;
    }

    public function getIdMontre() {
        return $this->idMontre;
    }

    public function setIdMontre($idMontre) {
        $this->idMontre = $idMontre;
    }

    public function getqte() {
        return $this->qte;
    }

    public function setqte($qte) {
        $this->qte = $qte;
    }
}



?>