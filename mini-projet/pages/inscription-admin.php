<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<form action="" method="POST" enctype="multipart/form-data" id="mon-form">
  <div class="contantt">
    <div class="gauche-inscrir">
      <h4>S'inscrire</h4>
      <p>Pour proposer des quizz</p>
      <hr>
      <div>
        <label for="prenomAdmin">Prénom</label><br>
        <input type="text" id="inscri-admin" name="prenomAdmin" error="error-1" value="<?= @$_POST['prenomAdmin'] ?>">
        <div class="error-form" id="error-1"></div>
      </div>
      <div>
        <label for="nomAdmin">Nom</label><br>
        <input type="text" id="inscri-admin" name="nomAdmin" error="error-2" value="<?= @$_POST['nomAdmin'] ?>">
        <div class="error-form" id="error-2"></div>
      </div>
      <div>
        <label for="loginAdmin">Login</label><br>
        <input type="text" id="inscri-admin" name="loginAdmin" error="error-3" value="<?= @$_POST['loginAdmin'] ?>">
        <div class="error-form" id="error-3"></div>
      </div>
      <div>
        <label for="pwdAdmin">Password</label><br>
        <input type="password" id="inscri-admin" name="pwdAdmin1" error="error-4">
        <div class="error-form" id="error-4"></div>
      </div>
      <div>
        <label for="pwdAdmin">Confirm Password</label><br>
        <input type="password" id="inscri-admin" name="pwdAdmin2" error="error-5">
        <div class="error-form" id="error-5"></div>
      </div>
      <p>Avatar</p>
      <input type="file" name="photo" id="photo" error="error-6">
      <div class="error-form-img" id="error-6"></div>
      <button type="submit" name="creer-compte" class="creer-compte">Créer Compte</button>
    </div>
    <div class="droite-inscrir">
      <img id="bash" src="#" alt="" class="avatarAdminInscrir">
      <h6>Avatar Admin</h6>
    </div>
  </div>
</form>
<?php
require_once("../includes/fonctions.php");
if (isset($_POST['creer-compte'])) {
  $prenom = $_POST['prenomAdmin'];
  $nom = $_POST['nomAdmin'];
  $log = $_POST['loginAdmin'];
  $pwd1 = $_POST['pwdAdmin1'];
  $pwd2 = $_POST['pwdAdmin2'];
  $arrayAdmin = [];

  $format_autorise = [
    'image/png',
    'image/jpg',
    'image/jpeg'
  ];
  if (in_array($_FILES["photo"]["type"], $format_autorise)) {
    $array = explode('.', $_FILES['photo']['name']);
    $filename = date('YmdHis') . "." . $array[sizeof($array) - 1];
    if (move_uploaded_file($_FILES['photo']['tmp_name'], '..\/assets\/' . $filename)) {
      $photo = '..\/assets\/' . $filename;
      $arrayAdmin = [
        "user" => "$log",
        "pwd" => "$pwd1",
        "prenom" => "$prenom",
        "nom" => "$nom",
        "profil" => "admin",
        "photo" => "$photo"
      ];
    } else {
      echo 'format incorecte';
    }
  }

  var_dump($arrayAdmin);
  $result = verifierpwd($pwd1, $pwd2);
  if (verification($log) == false) {
    if ($result == "bon") {
      ajout($arrayAdmin);
    } elseif ($result == "rien") {
      echo 'Veuillez choisir un mdp';
    } elseif ($result == "pasbon") {
      echo 'mdp differents';
    }
  } else {
    echo 'login indisponible';
  }
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

  document.getElementById("mon-form").addEventListener("submit", function(e) {
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