<?php
class PersonneManager {

private $db;

  public function __construct($db) {
    $this->db = $db;
  }

// Récupération de toutes les pesonnes présentes dans la base
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

//Récupération de tous les salariés dans la table salarié
  public function getListSalarie() {
    $listeSalarie=array();

    $sql='SELECT p.per_num, per_nom FROM personne p
    JOIN salarie s ON p.per_num=s.per_num';

    $req= $this->db->query($sql);

    while ($personne = $req->fetch(PDO::FETCH_OBJ)) {
      $listeSalarie[] = new Personne($personne);
    }

    $req->closeCursor();
    return $listeSalarie;

  }

//Récupération du nombre de personnes présents dans la base
  public function getNbPersonne() {
    $sql = 'SELECT count(*) AS nbPersonne FROM personne';

    $req = $this->db->query($sql);

    $nbPersonne = $req->fetch();

    $req->closeCursor();
    return $nbPersonne["nbPersonne"];
  }

//Est-ce que la personne est un salarié (à partir de son id)
  public function isSalarie($num) {

    $req = $this->db->prepare('SELECT count(*) as nbSalarie FROM salarie WHERE per_num=:num');

    $req->bindValue(':num', $num, PDO::PARAM_STR);

    $req->execute();

    $nbSalarie = $req->fetch();

    if ($nbSalarie["nbSalarie"] == 0)
      return false;
    else
      return true;

    $req->closeCursor();
  }

//Ajoute une personne dans la table personne
  public function ajoutPersonne($nom, $prenom, $tel, $mail, $login, $mdp) {

    $salt = "48@!alsd";

    $mdp_crypte = sha1(sha1($mdp).$salt);

    $sql = 'INSERT INTO personne (per_nom, per_prenom, per_tel, per_mail, per_admin, per_login, per_pwd)
    VALUES(:nom, :prenom, :tel, :mail, 0, :login, :mdp_crypte)';

    $req = $this->db->prepare($sql);

    $req->bindValue(':nom', $nom, PDO::PARAM_STR);
    $req->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $req->bindValue(':tel', $tel, PDO::PARAM_INT);
    $req->bindValue(':mail', $mail, PDO::PARAM_STR);
    $req->bindValue(':login', $login, PDO::PARAM_STR);
    $req->bindValue(':mdp_crypte', $mdp_crypte, PDO::PARAM_STR);

    $req->execute();

    $req->closeCursor();

    //recupération de l'id de la personne ajouté
    $sql = 'SELECT per_num FROM personne WHERE per_num >= ALL (SELECT per_num FROM personne)';

    $req = $this->db->query($sql);

    $num = $req->fetch();

    $req->closeCursor();

    return $num['per_num'];
  }

//Récupération de l'id de la personne connectée (à partir du login et du mot de passe codé)
  public function getNumPer($log, $mdp) {
    $salt = "48@!alsd";

    $mdp_crypte = sha1(sha1($mdp).$salt);

    $sql = 'SELECT per_num FROM personne WHERE per_login=:login AND per_pwd=:mdp_crypte';

    $req = $this->db->prepare($sql);

    $req->bindValue(':login', $log, PDO::PARAM_STR);
    $req->bindValue(':mdp_crypte', $mdp_crypte, PDO::PARAM_STR);

    $req->execute();

    $num = $req->fetch();

    $req->closeCursor();

    return $num['per_num'];

  }

//Modifie les différents attributs d'une personne dans la table personne
  public function modifPersonne($num, $nom, $prenom, $tel, $mail, $login, $mdp) {

//Récupération de l'ancien mot de passe
    $req = $this->db->prepare('SELECT per_pwd FROM personne WHERE per_num=:num');

    $req->bindValue(':num', $num, PDO::PARAM_STR);

    $req->execute();

    $oldPwd = $req->fetch();

    $req->closeCursor();

//Si le mot de passe n'a pas été modifié on le remet tel quel
    if ($oldPwd['per_pwd'] != $mdp) {
      $salt = "48@!alsd";

      $mdp_crypte = sha1(sha1($mdp).$salt);
    } else {
      $mdp_crypte = $mdp;
    }

    $sql = 'UPDATE personne SET per_nom=:nom, per_prenom=:prenom, per_tel=:tel, per_mail=:mail, per_login=:login, per_pwd=:mdp_crypte
    WHERE per_num=:num';

    $req = $this->db->prepare($sql);

    $req->bindValue(':nom', $nom, PDO::PARAM_STR);
    $req->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $req->bindValue(':tel', $tel, PDO::PARAM_STR);
    $req->bindValue(':mail', $mail, PDO::PARAM_STR);
    $req->bindValue(':login', $login, PDO::PARAM_STR);
    $req->bindValue(':mdp_crypte', $mdp_crypte, PDO::PARAM_STR);
    $req->bindValue(':num', $num, PDO::PARAM_STR);

    $req->execute();

    $req->closeCursor();
  }

//Suppression d'une personne dans le table personne (à partir de son id)
  public function suprPersonne($num) {

  $req = $this->db->prepare('DELETE FROM personne WHERE per_num=:num');

  $req->bindValue(':num', $num, PDO::PARAM_STR);

  $req->execute();

  $req->closeCursor();
  }
}
