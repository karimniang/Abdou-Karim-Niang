<?php
include('../includes/fonctions.php');

$filename = $_FILES['file']['name'];

/* Location */
$location = "../assets/" . $filename;
$uploadOk = 1;
$imageFileType = pathinfo($location, PATHINFO_EXTENSION);

/*Extensions */
$valid_extensions = array("jpg", "jpeg", "png");
if (!in_array(strtolower($imageFileType), $valid_extensions)) {
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  $photo = "";
} else {
  /* Upload file */
  if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
    $photo = $location;
  } else {
    $photo = "";
  }
}

$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$log = $_POST['login'];
$pwd1 = $_POST['password1'];
$pwd2 = $_POST['password2'];
$profil = $_POST['profil'];
$resultat = verifierpwd($pwd1, $pwd2);


if (verification($log) == "pasPareil") {
  if (!empty($photo)) {
    if ($resultat == "bon") {
      ajouter($log, $pwd1, $prenom, $nom, $photo, $profil);
      echo 'ajouter';
    } elseif ($resultat == "pasbon") {
      echo 'different';
    }
  } else {
    echo 'photo';
  }
} else {
  echo 'login';
}
