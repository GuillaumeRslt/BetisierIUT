<?php

class Division {
  private $nom;
  private $num;

  public function __construct($valeur = array()) {
    if ( !empty($valeur))
      $this->affecte($valeur);
  }

  public function affecte($donnees) {
    foreach ($donnees as $attribut => $valeur) {
      switch ($attribut) {
        case 'div_nom' : $this->setNom($valeur);
          break;
        case 'div_num' : $this->setNum($valeur);
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

  public function getNom() {
    return $this->nom;
  }

  public function getNum() {
    return $this->num;
  }
}
