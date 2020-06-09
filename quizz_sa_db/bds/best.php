<?php
include('../includes/fonctions.php');
$rowid = 0;
$rowperpage = 5;
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'bd_quizz_sa';

$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

/* Selecting rows */
$query = "SELECT * FROM users WHERE profil='joueur' ORDER BY score DESC LIMIT " . $rowid . "," . $rowperpage;

$result = $pdo->query($query);

$players = array();
while ($row = $result->fetch()) {
    $id = $row['id'];
    $prenom = $row['prenom'];
    $nom = $row['nom'];
    $score = $row['score'];

    $players[] = array("id" => $id, "prenom" => $prenom, "nom" => $nom, "score" => $score);
}

/* encoding array to json format */
echo json_encode($players);
