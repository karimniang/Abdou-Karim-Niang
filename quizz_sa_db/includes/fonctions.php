<?php

function connection($log, $pwd)
{

  $dbhost = 'localhost:3306';
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
    } else {
      return "jeux";
    }
  }
  return "error";
  mysqli_close($connect);
}
