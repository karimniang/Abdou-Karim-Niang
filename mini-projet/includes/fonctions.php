<?php
function connexion($log, $pwd)
{
  $qfile = 'modif.json';
  $qdata = file_get_contents($qfile);
  $qobj = json_decode($qdata);
  $_SESSION['nombreParJeu'] = $qobj->nombreParJeu;

  $rfile = 'question.json';
  $rdata = file_get_contents($rfile);
  $arrayQuestion = json_decode($rdata);
  shuffle($arrayQuestion);
  $_SESSION['mesquestions'] = $arrayQuestion;


  $ufile = 'file.json';
  $udata = file_get_contents($ufile);
  $uobj = json_decode($udata);

  foreach ($uobj as $key => $value) {
    if (($log == $value->user) && ($pwd == $value->pwd)) {
      $_SESSION['login'] = $value->user;
      $_SESSION['name'] = $value->prenom;
      $_SESSION['lastname'] = $value->nom;
      $_SESSION['score'] = $value->score;
      $_SESSION['lastname'] = strtoupper($_SESSION['lastname']);
      $_SESSION['image'] = $value->photo;
      $_SESSION['statut'] = "login";

      if ($value->profil == "admin") {
        return "accueil";
      } else {
        return "jeux";
      }
    }
  }
  return "error";
}







function deconnect()
{
  unset($_SESSION['statut']);
  session_destroy();
}

function isConnect()
{
  if (!isset($_SESSION['statut'])) {
    header("location: index.php");
  }
}
