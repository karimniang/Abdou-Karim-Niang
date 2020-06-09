<?php
include('../includes/fonctions.php');
$id = $_POST['id'];
$type = $_POST['type'];
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'bd_quizz_sa';
$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
if ($type == "bl") {
    $sql = 'UPDATE bd_quizz_sa.users SET statut = "block" WHERE users.id = "' . $id . '";';
    $pdo->query($sql);
    echo 'bloque';
} elseif ($type == "sup") {
    $sql = 'DELETE FROM bd_quizz_sa.users WHERE users.id ="' . $id . '";';
    $pdo->query($sql);
    echo 'supp';
}
