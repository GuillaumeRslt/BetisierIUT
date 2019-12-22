<?php
class SalarieManager {

private $db;

  public function __construct($db) {
    $this->db = $db;
  }

//Récupération d'un salarié (à partir de son id)
  public function getSalarie($num) {

    $sql = 'SELECT p.per_num, per_nom, per_prenom, per_mail, per_tel, sal_telprof, fon_libelle
    FROM personne p
    JOIN salarie s ON p.per_num=s.per_num
    JOIN fonction f ON s.fon_num=f.fon_num
    WHERE p.per_num=:num';

    $req = $this->db->prepare($sql);

    $req->bindValue(':num', $num, PDO::PARAM_STR);

    $req->execute();

    $Salarie = $req->fetch(PDO::FETCH_OBJ);

    $salarie = new Salarie($Salarie);


    $req->closeCursor();
    return $salarie;

  }

//Récupération de tous les enseignant de la table personne et salarié
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

//Ajoute un salarié dans la table salarie
  public function ajoutSalarie($num, $telPro, $fonction) {

    $req = $this->db->prepare('INSERT INTO salarie (per_num, sal_telprof, fon_num)
    VALUES(:num, :telPro, :fonction)');

    $req->bindValue(':num', $num, PDO::PARAM_INT);
    $req->bindValue(':telPro', $telPro, PDO::PARAM_INT);
    $req->bindValue(':fonction', $fonction, PDO::PARAM_INT);

    $req->execute();

    $req->closeCursor();

  }

//modifie les attribut d'un salarié dans la table salarie
  public function modifSalarie($num, $telPro, $fonction) {

    $req = $this->db->prepare('UPDATE salarie SET sal_telprof=:telPro, fon_num=:fonction
    WHERE per_num=:num');

    $req->bindValue(':num', $num, PDO::PARAM_STR);
    $req->bindValue(':telPro', $telPro, PDO::PARAM_STR);
    $req->bindValue(':fonction', $fonction, PDO::PARAM_STR);

    $req->execute();

    $req->closeCursor();
  }

//Suppression d'un salarié de la table salarie (à partir de son id)
  public function suprSalarie($num) {

  $req = $this->db->prepare('DELETE FROM salarie WHERE per_num=:num');

  $req->bindValue(':num', $num, PDO::PARAM_STR);

  $req->execute();

  $req->closeCursor();
  }
}
