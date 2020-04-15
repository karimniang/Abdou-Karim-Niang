<?php
function connexion($log,$pwd) {
    $file = 'file.json';
    $data = file_get_contents($file);
    $obj = json_decode($data);
   
        foreach ($obj as $key => $value) {
            if (($log == $value->user) && ($pwd == $value->pwd)) {
                $_SESSION['name'] = $value->prenom;
                $_SESSION['lastname'] = $value->nom;
                $_SESSION['image'] = $value ->photo;
                $_SESSION['statut'] = "login";
                if ($value->profil == "admin") {
                    return "accueil";
                }else {
                    return "jeux";
                }
            }
        }
        return "error";
}

function deconnect(){
    unset($_SESSION['statut']);
    session_destroy();
}

function isConnect(){
    if (!isset($_SESSION['statut'])) {
        header("location: index.php");
    }
}
?>