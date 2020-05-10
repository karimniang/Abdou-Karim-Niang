<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quizz SA</title>
  <link rel="stylesheet" href="../assets/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body>
  <nav id="header">
    <img src="../assets/logo-QuizzSA.png" class="logo" alt="">
    <h2>Le plaisir de jouer</h2>
  </nav>
  <form action="" method="POST" enctype="multipart/form-data" id="my-form">
    <div class="inscription">
      <div id="contain-use">
        <h4>S'inscrire</h4>
        <p>Pour proposer des quizz</p>
        <hr>
        <div>
          <label for="prenomAdmin">Prénom</label><br>
          <input type="text" id="inscri-joueur" name="prenomJoueur" error="error-1" value="<?= @$_POST['prenomJoueur'] ?>">
          <div class="error-form" id="error-1"></div>
        </div>
        <div>
          <label for="nomAdmin">Nom</label><br>
          <input type="text" id="inscri-joueur" name="nomJoueur" error="error-2" value="<?= @$_POST['nomJoueur'] ?>">
          <div class="error-form" id="error-2"></div>
        </div>
        <div>
          <label for="loginAdmin">Login</label><br>
          <input type="text" id="inscri-joueur" name="loginJoueur" error="error-3" value="<?= @$_POST['loginJoueur'] ?>">
          <div class="error-form" id="error-3"></div>
        </div>
        <div>
          <label for="pwdAdmin">Password</label><br>
          <input type="password" id="inscri-joueur" name="pwdJoueur1" error="error-4">
          <div class="error-form" id="error-4"></div>
        </div>
        <div>
          <label for="pwdAdmin">Confirm Password</label><br>
          <input type="password" id="inscri-joueur" name="pwdJoueur2" error="error-5">
          <div class="error-form" id="error-5"></div>
        </div>
        <p>Avatar</p>
        <input type="file" name="photo" id="photo">
        <button name="creer-compte" class="creer-usercompte">Créer Compte</button>
      </div>
      <div class="avatar-inscrir">
        <img src="#" id="bash" alt="" class="avatarAdminInscrir">
        <h6>Avatar Admin</h6>
      </div>
    </div>
  </form>
  <?php
  if (isset($_POST['creer-compte'])) {
    $prenom = $_POST['prenomJoueur'];
    $nom = $_POST['nomJoueur'];
    $log = $_POST['loginJoueur'];
    $pwd1 = $_POST['pwdJoueur1'];
    $pwd2 = $_POST['pwdJoueur2'];
    $arrayJoueur = [];
    $format_autorise = [
      'image/png',
      'image/jpg',
      'image/jpeg'
    ];
    if (in_array($_FILES['photo']['type'], $format_autorise)) {
      $array = explode('.', $_FILES['photo']['name']);
      $filename = date('YmdHis') . "." . $array[sizeof($array) - 1];
      if (move_uploaded_file($_FILES['photo']['tmp_name'], '..\/assets\/' . $filename)) {
        $photo = '..\/assets\/' . $filename;
        $arrayJoueur = [
          "user" => "$log",
          "pwd" => "$pwd1",
          "prenom" => "$prenom",
          "nom" => "$nom",
          "profil" => "user",
          "photo" => "$photo",
          "score" => 0

        ];
      } else {
        echo 'format incorecte';
      }
    }

    $result = verifierpwd($pwd1, $pwd2);
    if (verification($log) == false) {
      if ($result == "bon") {
        ajout($arrayJoueur);
        header("location: ../index.php");
      } elseif ($result == "rien") {
        echo 'Veuillez choisir un mdp';
      } elseif ($result == "pasbon") {
        echo 'mdp differents';
      }
    } else {
      echo 'login indisponible';
    }
  }

  function verification($log)
  {
    $vfile = '../file.json';
    $vdata = file_get_contents($vfile);
    $vobj = json_decode($vdata);
    foreach ($vobj as $key => $value) {
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
  ?>



  <script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#bash').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }

    $("#photo").change(function() {
      readURL(this);
    });

    const inputs = document.getElementsByTagName("input");
    for (input of inputs) {
      input.addEventListener("keyup", function(e) {
        if (e.target.hasAttribute("error")) {
          var idDivError = e.target.getAttribute("error");
          document.getElementById(idDivError).innerText = ""
        }
      })
    }

    document.getElementById("my-form").addEventListener("submit", function(e) {
      const inputs = document.getElementsByTagName("input");
      var error = false;
      for (input of inputs) {
        if (input.hasAttribute("error")) {
          var idDivError = input.getAttribute("error");
          if (!input.value) {
            document.getElementById(idDivError).innerText = "Veuillez remplire ce champ"
            error = true;
          }
        }
      }
      if (error) {
        e.preventDefault();
        return false;
      }
    })
  </script>
</body>

</html>