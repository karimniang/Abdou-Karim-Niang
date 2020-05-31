<div class="contain">
  <div class="log-forme">
    <div class="gauche">
    </div>
    <img src="./assets/logoSA.png" alt="" id="logo">
    <h6>Connecter vous pour <br>
      jouer ou <br>
      pour proposez des <br>
      questions de<br>
      Cultures Générales</h6>
    <div class="droite">
    </div>
    <form action="" method="POST" id="my-form">
      <div class="bloc-login">
        <div class="form">
          <label for="login"> Login </label>
          <input type="text" name="login" error="error-1">
          <div class="error-form" id="error-1"></div>
          <img src="./assets/ic-login.png" alt="" class="icon-log">
        </div><br><br>
        <div class="form">
          <label for="password"> Password </label>
          <input type="password" name="password" error="error-2">
          <div class="error-form" id="error-2"></div>
          <img src="./assets/icone-password.png" alt="" class="icon-pwd">
        </div>
        <button type="submit" name="connect" class="connect">Connexion</button>
      </div>
      <a href="index.php?link=inscription" class=" inscri">Pas de compte, Inscrivez vous !</a>
    </form>
  </div>
</div>
<?php
if (isset($_POST['connect'])) {
  $log = $_POST['login'];
  $pwd = $_POST['password'];
  $result = connection($log, $pwd);
  if ($result == "error") {
    echo '<p class="echo-error">Vos informations de connexion sont invalide</p>';
  } elseif ($result == "block") {
    echo '<p class="echo-error">Vous avez été bloqué par un administrateur !!!</p>';
  } else {
    header("location: index.php?link=" . $result);
  }
}

?>

<script>
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
          document.getElementById(idDivError).innerText = "Ce champ est obligatoire"
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