<?php
include('../includes/fonctions.php');
global $pdo;
$id = $_POST['id'];
$value = $_POST['value'];
$champ = $_POST['champ'];


$sql = "UPDATE `bd_quizz_sa`.`users` SET `" . $champ . "` = '" . $value . "' WHERE `users`.`id` = '" . $id . "';";
$pdo->query($sql);
echo 'Le ' . $champ . ' de ce joueur a été changé ';
