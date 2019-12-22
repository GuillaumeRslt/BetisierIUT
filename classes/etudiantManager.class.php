<?php
class EtudiantManager {

private $db;

  public function __construct($db) {
    $this->db = $db;
  }

//Récupération d'un étudiant à partir de son id
  public function getEtudiant($num) {

    $sql = 'SELECT per_prenom, per_mail, per_tel, dep_nom, vil_nom
    FROM personne p
    JOIN etudiant e ON p.per_num=e.per_num
    JOIN departement d ON e.dep_num=d.dep_num
    JOIN ville v ON d.vil_num=v.vil_num
    WHERE p.per_num=:num';

    $req = $this->db->prepare($sql);

    $req->bindValue(':num', $num, PDO::PARAM_STR);

    $req->execute();

    $Etudiant = $req->fetch(PDO::FETCH_OBJ);

    $etudiant = new Etudiant($Etudiant);


    $req->closeCursor();
    return $etudiant;

  }

//Ajout un étudiant dans la table etudiant
  public function ajoutEtudiant($num, $dep, $div) {

    $req = $this->db->prepare('INSERT INTO etudiant (per_num, dep_num, div_num)
    VALUES(:num, :dep, :div)');

    $req->bindValue(':num', $num, PDO::PARAM_STR);
    $req->bindValue(':dep', $dep, PDO::PARAM_STR);
    $req->bindValue(':div', $div, PDO::PARAM_STR);

    $req->execute();

    $req->closeCursor();

  }

//modifie un étudiant dans la table etudiant
  public function modifEtudiant($num, $dep, $div) {

    $req = $this->db->prepare('UPDATE etudiant SET dep_num=:dep, div_num=:div
    WHERE per_num=:num');

    $req->bindValue(':num', $num, PDO::PARAM_STR);
    $req->bindValue(':dep', $dep, PDO::PARAM_STR);
    $req->bindValue(':div', $div, PDO::PARAM_STR);

    $req->execute();

    $req->closeCursor();
  }

//suppréssion d'un étudiant dans la table etudiant
  public function suprEtudiant($num) {

    $req = $this->db->prepare('DELETE FROM etudiant WHERE per_num=:num');

    $req->bindValue(':num', $num, PDO::PARAM_STR);

    $req->execute();

    $req->closeCursor();
  }


}
