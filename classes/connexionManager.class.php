<?php
class ConnexionManager {

private $db;

  public function __construct($db) {
    $this->db = $db;
  }

//Vérifie si le mot de passe (codé) correspond au login
  public function isGoodLog($nom, $pwd) {
    $salt = "48@!alsd";

    $pwd_crypte = sha1(sha1($pwd).$salt);

    $req = $this->db->prepare('SELECT count(*) as nbUtilisateur
    FROM personne WHERE per_login=:nom AND per_pwd=:pwdCrypte');

    $req->bindValue(':nom',$nom,PDO::PARAM_STR);
    $req->bindValue(':pwdCrypte',$pwd_crypte,PDO::PARAM_STR);

    $req->execute();

    $nbUtilisateur = $req->fetch();

    if ($nbUtilisateur["nbUtilisateur"] == 0)
      return false;
    else
      return true;

    $req->closeCursor();
  }

//Est-ce que la personne connecté est admin
  public function isAdmin($nom) {

    $req = $this->db->prepare('SELECT count(*) as nbAdmin
    FROM personne WHERE per_login=:nom AND per_admin=1');

    $req->bindValue(':nom',$nom,PDO::PARAM_STR);

    $req->execute();

    $nbAdmin = $req->fetch();

    if ($nbAdmin["nbAdmin"] == 0)
      return false;
    else
      return true;

    $req->closeCursor();

  }
}
