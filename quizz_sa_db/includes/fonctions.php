<?php
session_start();
$dbhost = 'localhost';
$dbname = 'bd_quizz_sa';
$dbuser = 'root';
$dbpass = '';

try {
  $pdo = new PDO(
    'mysql:host=' . $dbhost . ';dbname=' . $dbname,
    $dbuser,
    $dbpass,
    array(
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
      PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
    )
  );
} catch (PDOException $e) {
  die("Une erreur est survenue lors de la connexion à la Base de données !");
}

//fonctions utiles
function connection($log, $pwd)
{
  global $pdo;
  $sql = "SELECT * FROM users WHERE `login` ='" . $log . "' AND `password` ='" . $pwd . "'";
  $player = $pdo->query($sql);
  $player->setFetchMode(PDO::FETCH_ASSOC);
  $row = $player->fetch();
  if ($player->rowCount() == 1) {
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
}

function verification($log)
{
  global $pdo;
  $sql = "SELECT * FROM users WHERE `login` ='" . $log . "' ";
  $player = $pdo->query($sql);
  $player->setFetchMode(PDO::FETCH_ASSOC);
  $row = $player->fetch();
  if ($player->rowCount() == 1) {
    return "pareil";
  } else {
    return "pasPareil";
  }
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
  global $pdo;
  $sql = "insert into `bd_quizz_sa`.`users` (`id`,`login`, `password`, `prenom`, `nom`, `photo`, `profil`, `statut`, `score`) VALUES ('','" . $log . "', '" . $pwd . "', '" . $prenom . "', '" . $nom . "', '" . $photo . "', '" . $profil . "', 'unblock', '0')";
  $pdo->query($sql);
}

//liste joueur 
function getDataJoueurUblq()
{
  global $pdo;
  $sql = "SELECT id,nom,prenom,score FROM users WHERE statut= 'unblock' ORDER BY score DESC";
  $q = $pdo->query($sql);
  $data = [];
  while ($row = $q->fetch()) {
    $data[] = $row;
  }
  return $data;
}

function getDataJoueurBlq()
{
  global $pdo;
  $sql = "SELECT id,nom,prenom,score FROM users WHERE statut= 'block' ORDER BY score DESC";
  $q = $pdo->query($sql);
  $data = [];
  while ($row = $q->fetch()) {
    $data[] = $row;
  }
  return $data;
}

function bloquer($id)
{
  global $pdo;
  $sql = 'UPDATE bd_quizz_sa.users SET statut = "block" WHERE users.id = "' . $id . '";';
  $pdo->query($sql);
}

function debloquer($id)
{
  global $pdo;
  $sql = 'UPDATE bd_quizz_sa.users SET statut = "unblock" WHERE users.id = "' . $id . '";';
  $pdo->query($sql);
}

function ajoutquestion($question, $score, $type, $tous, $bonne)
{
  global $pdo;
  $sql = "INSERT INTO `bd_quizz_sa`.`questions` (`id`,`question`, `score`, `type`, `tous`, `bonne`) VALUES (null,'" . $question . "', '" . $score . "', '" . $type . "', '" . $tous . "', '" . $bonne . "')";
  $pdo->query($sql);
}

function getQuestion()
{
  global $pdo;
  $sql = "SELECT * FROM questions";
  $q = $pdo->query($sql);
  $q->setFetchMode(PDO::FETCH_ASSOC);
  $data = [];
  while ($row = $q->fetch()) {
    $data[] = $row;
  }
  return $data;
}
