<?php
class SalarieManager {

private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function getSalarie($num) {

    $sql = 'SELECT p.per_num, per_nom, per_prenom, per_mail, per_tel, sal_telprof, fon_libelle
    FROM personne p
    JOIN salarie s ON p.per_num=s.per_num
    JOIN fonction f ON s.fon_num=f.fon_num
    WHERE p.per_num='.$num;


    $req = $this->db->query($sql);

    $Salarie = $req->fetch(PDO::FETCH_OBJ);

    $salarie = new Salarie($Salarie);


    $req->closeCursor();
    return $salarie;

  }

  public function getEnseignant() {
    $listeEnseignant = array();

    $sql = 'SELECT p.per_num, per_prenom, per_nom, per_mail, per_tel, sal_telprof, fon_libelle
    FROM personne p
    JOIN salarie s ON p.per_num=s.per_num
    JOIN fonction f ON s.fon_num=f.fon_num
    WHERE fon_libelle=\'Enseignant\'';

    $req = $this->db->query($sql);

    while ($enseignant = $req->fetch(PDO::FETCH_OBJ)) {
      $listeEnseignant[] = new Salarie($enseignant);
    }

    $req->closeCursor();
    return $listeEnseignant;

  }

  public function ajoutSalarie($num, $telPro, $fonction) {

    $sql = 'INSERT INTO salarie (per_num, sal_telprof, fon_num)
    VALUES(\''.$num.'\', \''.$telPro.'\', \''.$fonction.'\')';

    $req = $this->db->query($sql);

    $req->closeCursor();

  }

  public function modifSalarie($num, $telPro, $fonction) {

    $sql = 'UPDATE salarie SET sal_telprof=\''.$telPro.'\', fon_num=\''.$fonction.'\'
    WHERE per_num='.$num;

    $req = $this->db->query($sql);

    $req->closeCursor();
  }

  public function suprSalarie($num) {

  $sql = 'DELETE FROM salarie WHERE per_num='.$num;

  $req = $this->db->query($sql);

  $req->closeCursor();
  }
}
