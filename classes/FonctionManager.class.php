<?php
class FonctionManager {

private $db;

  public function __construct($db) {
    $this->db = $db;
  }

//Récupération de toutes les foncions présentes dans la base de données
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
