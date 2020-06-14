<?php
include('../includes/fonctions.php');
global $pdo;
$id = $_POST['id'];
$type = $_POST['type'];
if ($type == "bl") {
    $sql = 'UPDATE bd_quizz_sa.users SET statut = "block" WHERE users.id = "' . $id . '";';
    $pdo->query($sql);
    echo 'bloque';
} elseif ($type == "sup") {
    $sql = 'DELETE FROM bd_quizz_sa.users WHERE users.id ="' . $id . '";';
    $pdo->query($sql);
    echo 'supp';
}
