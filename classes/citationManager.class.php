<?php
class CitationManager {

private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function getList() {
    $listeCitation = array();

    $sql = 'SELECT c.cit_num, concat(per_nom,per_prenom) AS per_nompre, cit_libelle, cit_date, AVG(vot_valeur) AS note_moy
    FROM citation c
    JOIN personne p ON c.per_num=p.per_num
    JOIN vote v ON c.cit_num=v.cit_num
    WHERE cit_valide=1 AND cit_date_valide is not null
    GROUP BY per_nom, c.cit_num, cit_date
    ORDER BY cit_date desc';

    $req = $this->db->query($sql);

    while ($citation = $req->fetch(PDO::FETCH_OBJ)) {
      $listeCitation[] = new Citation($citation);
    }

    $req->closeCursor();
    return $listeCitation;

  }

  public function getNbCitation() {
    $sql = 'SELECT count(*) AS nbCitation
    FROM citation c
    WHERE cit_valide=1 AND cit_date_valide is not null';

    $req = $this->db->query($sql);

    $nbCitation = $req->fetch();

    $req->closeCursor();
    return $nbCitation["nbCitation"];
  }

  public function ajoutCitation($enseignant, $num, $citation, $date) {

    $dateDepo = $this->getDateJour();

    $sql = 'INSERT INTO citation (per_num, per_num_etu, cit_libelle, cit_date, cit_valide, cit_date_depo)
    VALUES(\''.$enseignant.'\', \''.$num.'\', \''.$citation.'\', \''.$date.'\', 0, \''.$dateDepo.'\')';

    $req = $this->db->query($sql);

    $req->closeCursor();

  }

  public function getDateJour() {
    $sql = 'SELECT DATE(NOW()) as dateJour';

    $req = $this->db->query($sql);

    $dateJour = $req->fetch();

    $req->closeCursor();
    return $dateJour["dateJour"];
  }

  public function isNote($numEtu, $numCit) {
    $sql = 'SELECT count(*) as nbCitation
    FROM citation c
    JOIN vote v ON c.cit_num=v.cit_num
    WHERE '.$numEtu.'=v.per_num AND '.$numCit.'=v.cit_num
    AND cit_valide=1 AND cit_date_valide is not null';

    $req = $this->db->query($sql);

    $nbCitation = $req->fetch();

    if ($nbCitation["nbCitation"] == 0)
      return false;
    else
      return true;

    $req->closeCursor();
  }

  public function noterCitation($numCit, $num, $note) {

    $sql = 'INSERT INTO vote (cit_num, per_num, vot_valeur)
    VALUES(\''.$numCit.'\', \''.$num.'\', \''.$note.'\')';

    $req = $this->db->query($sql);

    $req->closeCursor();
  }
}
