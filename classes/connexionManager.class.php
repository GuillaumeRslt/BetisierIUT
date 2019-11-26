<?php
class ConnexionManager {

private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function isGoodLog($nom, $pwd) {
    $salt = "48@!alsd";

    $pwd_crypte = sha1(sha1($pwd).$salt);

    $sql = 'SELECT count(*) as nbUtilisateur
    FROM personne WHERE \''.$nom.'\'=per_login AND \''.$pwd_crypte.'\'=per_pwd';

    $req = $this->db->query($sql);

    $nbUtilisateur = $req->fetch();

    if ($nbUtilisateur["nbUtilisateur"] == 0)
      return false;
    else
      return true;

    $req->closeCursor();
  }

  public function isAdmin($nom) {
    $sql = 'SELECT count(*) as nbAdmin
    FROM personne WHERE \''.$nom.'\'=per_login AND per_admin=1';

    $req = $this->db->query($sql);

    $nbAdmin = $req->fetch();

    if ($nbAdmin["nbAdmin"] == 0)
      return false;
    else
      return true;

    $req->closeCursor();

  }
}
