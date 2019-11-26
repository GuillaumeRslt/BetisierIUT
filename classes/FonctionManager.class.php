<?php
class FonctionManager {

private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function getList() {
    $listeFonction = array();

    $sql = 'SELECT fon_num, fon_libelle from fonction';

    $req = $this->db->query($sql);

    while ($fonction = $req->fetch(PDO::FETCH_OBJ)) {
      $listeFonction[] = new Fonction($fonction);
    }

    $req->closeCursor();
    return $listeFonction;
  }
}
