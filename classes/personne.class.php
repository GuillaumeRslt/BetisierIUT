<?php

class Personne {
  private $num;
  private $nom;
  private $prenom;

  public function __construct($valeur = array()) {
    if ( !empty($valeur))
      $this->affecte($valeur);
  }

  public function affecte($donnees) {
    foreach ($donnees as $attribut => $valeur) {
      switch ($attribut) {
        case 'per_nom' : $this->setNom($valeur);
          break;
        case 'per_num' : $this->setNum($valeur);
          break;
        case 'per_prenom' : $this->setPrenom($valeur);
            break;
      }
    }
  }

  public function setNom($nom) {
    $this->nom = $nom;
  }

  public function setNum($num) {
    $this->num = $num;
  }

  public function setPrenom($prenom) {
    $this->prenom = $prenom;
  }

  public function getNom() {
    return $this->nom;
  }

  public function getNum() {
    return $this->num;
  }

  public function getPrenom() {
    return $this->prenom;
  }
}
