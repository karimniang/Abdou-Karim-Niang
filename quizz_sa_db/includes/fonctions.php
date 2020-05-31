<?php

function connection($log, $pwd)
{

  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = '';
  $dbname = 'bd_quizz_sa';
  $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  $sql = "select * from users where login ='" . $log . "' AND password ='" . $pwd . "'";
  $player = mysqli_query($connect, $sql);
  $row = mysqli_fetch_assoc($player);
  if (mysqli_num_rows($player) == 1) {
    $_SESSION['users'] = $row;
    $_SESSION['log'] = "in";
    if ($row["profil"] === "admin") {
      return "admin";
    } elseif ($row["profil"] === "joueur") {
      if ($row["statut"] === "unblock") {
        return "jeux";
      } else {
        return "block";
      }
    }
  }
  return "error";
  mysqli_close($connect);
}

function verification($log)
{
  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = '';
  $dbname = 'bd_quizz_sa';
  $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  $sql = "select * from users where login='" . $log . "' ";
  $player = mysqli_query($connect, $sql);
  $row = mysqli_fetch_assoc($player);
  if ($player->num_rows >= 1) {
    return "pareil";
  } else {
    return "pasPareil";
  }
  mysqli_close($connect);
}

function verifierpwd($pwd1, $pwd2)
{
  if (!empty($pwd1) && !empty($pwd2)) {
    if ($pwd1 === $pwd2) {
      return "bon";
    }
    return "pasbon";
  }
  return "rien";
}

function ajouter($log, $pwd, $prenom, $nom, $photo, $profil)
{
  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = '';
  $dbname = 'bd_quizz_sa';
  $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  $sql = "insert into `bd_quizz_sa`.`users` (`id`,`login`, `password`, `nom`, `prenom`, `photo`, `profil`, `statut`, `score`) VALUES ('','" . $log . "', '" . $pwd . "', '" . $prenom . "', '" . $nom . "', '" . $photo . "', '" . $profil . "', 'unblock', '0')";
  mysqli_query($connect, $sql);
  mysqli_close($connect);
}
