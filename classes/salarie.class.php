<?php

class Salarie {
  private $num;
  private $nom;
  private $prenom;
  private $mail;
  private $tel;
  private $telPro;
  private $fonction;

  public function __construct($valeur = array()) {
    if ( !empty($valeur))
      $this->affecte($valeur);
  }

  public function affecte($donnees) {
    foreach ($donnees as $attribut => $valeur) {
      switch ($attribut) {
        case 'per_num' : $this->setNum($valeur);
            break;
        case 'per_nom' : $this->setNom($valeur);
            break;
        case 'per_prenom' : $this->setPrenom($valeur);
            break;
        case 'per_mail' : $this->setMail($valeur);
            break;
        case 'per_tel' : $this->setTel($valeur);
            break;
        case 'sal_telprof' : $this->setTelPro($valeur);
            break;
        case 'fon_libelle' : $this->setFonction($valeur);
            break;
      }
    }
  }

  public function setNum($num) {
    $this->num = $num;
  }

  public function setNom($nom) {
    $this->nom = $nom;
  }

  public function setMail($mail) {
    $this->mail = $mail;
  }

  public function setTel($tel) {
    $this->tel = $tel;
  }

  public function setPrenom($prenom) {
    $this->prenom = $prenom;
  }

  public function setTelPro($telPro) {
    $this->telPro = $telPro;
  }

  public function setFonction($fonction) {
    $this->fonction = $fonction;
  }

  public function getNum() {
    return $this->num;
  }

  public function getNom() {
    return $this->nom;
  }

  public function getPrenom() {
    return $this->prenom;
  }

  public function getTel() {
    return $this->tel;
  }

  public function getMail() {
    return $this->mail;
  }

  public function getTelPro() {
    return $this->telPro;
  }

  public function getFonction() {
    return $this->fonction;
  }
}
