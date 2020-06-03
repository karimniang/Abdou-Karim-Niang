<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="contain">
  <div class="new_inscri">
    <div class="ajout"></div>
    <form action="" method="POST" enctype="multipart/form-data" id="my-form">
      <div class="save">
        <div>
          <label for="prenom">Prenom</label>
          <input type="text" name="prenom" error="error-1">
          <div class="error-form" id="error-1"></div>
        </div>
        <div>
          <label for="nom">Nom</label>
          <input type="text" name="nom" error="error-2">
          <div class="error-form" id="error-2"></div>
        </div>
        <div>
          <label for="login">Login</label>
          <input type="text" name="login" error="error-3">
          <div class="error-form" id="error-3"></div>
        </div>
        <div>
          <label for="pwd">Password</label>
          <input type="password" name="pwd" error="error-4">
          <div class="error-form" id="error-4"></div>
        </div>
        <div>
          <label for="pwd2">Confirm Password</label>
          <input type="password" name="pwd2" error="error-5">
          <div class="error-form" id="error-5"></div>
        </div>
        <input type="file" name="photo" id="photo" error="error-6">
        <div class="error-form-img" id="error-6"></div>
      </div>
      <button name="creer-compte" class="creer-user">Créer Compte</button>
      <img src="./assets/admin1.jpg" id="bash" alt="" class="img-inscri">
    </form>
  </div>
  <?php
  if (isset($_POST['creer-compte'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $log = $_POST['login'];
    $pwd1 = $_POST['pwd'];
    $pwd2 = $_POST['pwd2'];
    $profil = "joueur";
    $resultat = verifierpwd($pwd1, $pwd2);
    $format_autorise = [
      'image/png',
      'image/jpg',
      'image/jpeg'
    ];
    if (in_array($_FILES['photo']['type'], $format_autorise)) {
      $array = explode('.', $_FILES['photo']['name']);
      $filename = date('YmdHis') . "." . $array[sizeof($array) - 1];
      if (move_uploaded_file($_FILES['photo']['tmp_name'], './assets/' . $filename)) {
        $photo = './assets/' . $filename;
      } else {
        echo 'format incorecte';
      }
    }
    if (verification($log) == "pasPareil") {
      if (!empty($photo)) {
        if ($resultat == "bon") {
          ajouter($log, $pwd1, $prenom, $nom, $photo, $profil);
          header("location: ./index.php");
        } elseif ($resultat == "rien") {
          echo '<p class="echo-error">Veuillez choisir un mot de passe</p>';
        } elseif ($resultat == "pasbon") {
          echo '<p class="echo-error">les mot de passes saisis sont differents</p>';
        }
      } else {
        echo '<p class="echo-error">Veuillez choisir une photo valide</p>';
      }
    } else {
      echo '<p class="echo-error">Ce login indisponible</p>';
    }
  }
  ?>
</div>
<script src="./JS/inscription-user.js"></script>