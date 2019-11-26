<?php
class EtudiantManager {

private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function getEtudiant($num) {

    $sql = 'SELECT per_prenom, per_mail, per_tel, dep_nom, vil_nom
    FROM personne p
    JOIN etudiant e ON p.per_num=e.per_num
    JOIN departement d ON e.dep_num=d.dep_num
    JOIN ville v ON d.vil_num=v.vil_num
    WHERE p.per_num='.$num;

    $req = $this->db->query($sql);

    $Etudiant = $req->fetch(PDO::FETCH_OBJ);

    $etudiant = new Etudiant($Etudiant);


    $req->closeCursor();
    return $etudiant;

  }

  public function ajoutEtudiant($num, $dep, $div) {

    $sql = 'INSERT INTO etudiant (per_num, dep_num, div_num)
    VALUES(\''.$num.'\', \''.$dep.'\', \''.$div.'\')';

    $req = $this->db->query($sql);

    $req->closeCursor();

  }

}
