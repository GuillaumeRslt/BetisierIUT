<?php

class Etudiant {
  private $prenom;
  private $mail;
  private $tel;
  private $departement;
  private $ville;

  public function __construct($valeur = array()) {
    if ( !empty($valeur))
      $this->affecte($valeur);
  }

  public function affecte($donnees) {
    foreach ($donnees as $attribut => $valeur) {
      switch ($attribut) {
        case 'per_prenom' : $this->setPrenom($valeur);
            break;
        case 'per_mail' : $this->setMail($valeur);
            break;
        case 'per_tel' : $this->setTel($valeur);
            break;
        case 'dep_nom' : $this->setDepartement($valeur);
            break;
        case 'vil_nom' : $this->setVille($valeur);
            break;
      }
    }
  }


  public function setPrenom($prenom) {
    $this->prenom = $prenom;
  }

  public function setMail($mail) {
    $this->mail = $mail;
  }

  public function setTel($tel) {
    $this->tel = $tel;
  }

  public function setDepartement($departement) {
    $this->departement = $departement;
  }

  public function setVille($ville) {
    $this->ville = $ville;
  }


  public function getPrenom() {
    return $this->prenom;
  }

  public function getMail() {
    return $this->mail;
  }

  public function getTel() {
    return $this->tel;
  }

  public function getDepartement() {
    return $this->departement;
  }

  public function getVille() {
    return $this->ville;
  }
}
