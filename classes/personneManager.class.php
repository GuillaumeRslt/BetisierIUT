<?php
class PersonneManager {

private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function getList() {
    $listePersonne = array();

    $sql = 'SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd from personne';

    $req = $this->db->query($sql);

    while ($personne = $req->fetch(PDO::FETCH_OBJ)) {
      $listePersonne[] = new Personne($personne);
    }

    $req->closeCursor();
    return $listePersonne;

  }

  public function getNbPersonne() {
    $sql = 'SELECT count(*) AS nbPersonne FROM personne';

    $req = $this->db->query($sql);

    $nbPersonne = $req->fetch();

    $req->closeCursor();
    return $nbPersonne["nbPersonne"];
  }

  public function isSalarie($num) {
    $sql = 'SELECT count(*) as nbSalarie FROM salarie WHERE '.$num.'=per_num';

    $req = $this->db->query($sql);

    $nbSalarie = $req->fetch();

    if ($nbSalarie["nbSalarie"] == 0)
      return false;
    else
      return true;

    $req->closeCursor();
  }

  public function ajoutPersonne($nom, $prenom, $tel, $mail, $login, $mdp) {

    $salt = "48@!alsd";

    $mdp_crypte = sha1(sha1($mdp).$salt);

    $sql = 'INSERT INTO personne (per_nom, per_prenom, per_tel, per_mail, per_admin, per_login, per_pwd)
    VALUES(\''.$nom.'\', \''.$prenom.'\', \''.$tel.'\', \''.$mail.'\', 0, \''.$login.'\', \''.$mdp_crypte.'\')';

    $req = $this->db->query($sql);

    $req->closeCursor();

    //recupération de l'id de la personne ajouté
    $sql = 'SELECT per_num FROM personne WHERE per_num >= ALL (SELECT per_num FROM personne)';

    $req = $this->db->query($sql);

    $num = $req->fetch();

    $req->closeCursor();

    return $num['per_num'];
  }

  public function getNumPer($log, $mdp) {
    $salt = "48@!alsd";

    $mdp_crypte = sha1(sha1($mdp).$salt);

    $sql = 'SELECT per_num FROM personne WHERE per_login=\''.$log.'\' AND per_pwd=\''.$mdp_crypte.'\'';

    $req = $this->db->query($sql);

    $num = $req->fetch();

    $req->closeCursor();

    return $num['per_num'];

  }


}
