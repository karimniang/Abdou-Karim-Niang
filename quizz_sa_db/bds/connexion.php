<?php
include('../includes/fonctions.php');
if (($_POST['login'] != "") && ($_POST['password'] != "")) {
    $log = $_POST['login'];
    $pwd = $_POST['password'];
    $result = connection($log, $pwd);
    if ($result == "error") {
        echo 'invalide';
    } elseif ($result == "block") {
        echo 'bloque';
    } else {
        echo $result;
    }
}
