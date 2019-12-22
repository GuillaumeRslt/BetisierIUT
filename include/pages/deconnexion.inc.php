<p><img class = "icone" src="image/valid.png" alt="deconnexion"/> Vous avez bien été connecté !</p>

  <?php session_destroy();
  //Seul l'existance de la variable de session "num" et "login" prouve qu'il y a une connexion?>

  <meta http-equiv="refresh" content="2; URL=index.php?page=0">
    <p> Redirection automatique dans 2 secondes. </p>
