<?php
function connexion($log, $pwd)
{
    $file = 'file.json';
    $data = file_get_contents($file);
    $obj = json_decode($data);

    foreach ($obj as $key => $value) {
        if (($log == $value->user) && ($pwd == $value->pwd)) {
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




function verification($log)
{
    $file = '../file.json';
    $data = file_get_contents($file);
    $obj = json_decode($data);
    foreach ($obj as $key => $value) {
        if ($log === $value->user) {
            return true;
        }
    }
    return false;
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
function ajout($array)
{
    $array;
    $file = '../file.json';
    $data = file_get_contents($file);
    $obj = json_decode($data);
    array_push($obj, $array);
    $jsonData = json_encode($obj);
    file_put_contents($file, $jsonData);
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
