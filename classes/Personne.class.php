<?php

class Personne {
  private $num;
  private $nom;
  private $prenom;
  private $tel;
  private $mail;
  private $login;
  private $pwd;

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
        case 'per_tel' : $this->setTel($valeur);
            break;
        case 'per_mail' : $this->setMail($valeur);
            break;
        case 'per_login' : $this->setLogin($valeur);
            break;
        case 'per_pwd' : $this->setPwd($valeur);
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

  public function setTel($tel) {
    $this->tel = $tel;
  }

  public function setMail($mail) {
    $this->mail = $mail;
  }

  public function setLogin($login) {
    $this->login = $login;
  }

  public function setPwd($pwd) {
    $this->pwd = $pwd;
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

  public function getTel() {
    return $this->tel;
  }

  public function getMail() {
    return $this->mail;
  }

  public function getLogin() {
    return $this->login;
  }

  public function getPwd() {
    return $this->pwd;
  }
}
