<?php

class Citation {
  private $num;
  private $perNum;
  private $perNumValide;
  private $perNumEtu;
  private $libelle;
  private $date;
  private $valide;
  private $dateValide;
  private $dateDepot;

  private $perNom;
  private $moyNote;

  public function __construct($valeur = array()) {
    if ( !empty($valeur))
      $this->affecte($valeur);
  }

  public function affecte($donnees) {
    foreach ($donnees as $attribut => $valeur) {
      switch ($attribut) {
        case 'per_nompre' : $this->setPerNom($valeur);
          break;
        case 'cit_libelle' : $this->setLibelle($valeur);
          break;
        case 'cit_date' : $this->setDate($valeur);
            break;
        case 'note_moy' : $this->setMoyNote($valeur);
              break;
        case 'cit_num' : $this->setNum($valeur);
              break;
      }
    }
  }

  public function setPerNom($perNom) {
    $this->perNom = $perNom;
  }

  public function setLibelle($libelle) {
    $this->libelle = $libelle;
  }

  public function setDate($date) {
    $this->date = $date;
  }

  public function setMoyNote($moyNote) {
    $this->moyNote = $moyNote;
  }

  public function setNum($num) {
    $this->num = $num;
  }

  public function getPerNom() {
    return $this->perNom;
  }

  public function getLibelle() {
    return $this->libelle;
  }

  public function getDate() {
    return $this->date;
  }

  public function getMoyNote() {
    return $this->moyNote;
  }

  public function getNum() {
    return $this->num;
  }
}
