<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quizz SA DB</title>
  <link rel="stylesheet" href="./assets/style.css">
</head>

<body>
  <div class="header">
    <h3>Testez Vos Connaissances</h3>
  </div>
  <div class="contain">
    <?php
    session_start();
    require_once("./includes/fonctions.php");

    if (isset($_GET['link'])) {
      if ($_GET['link'] == "admin") {
        require_once("./Pages/accueil.php");
      } elseif ($_GET['link'] == "jeux") {
        require_once("./Pages/jeux.php");
      } elseif ($_GET['link'] == "inscription") {
        require_once("./Pages/inscription.php");
      }
    } else {
      if (isset($_GET['log'])) {
        unset($_SESSION['users']);
        session_destroy();
        header("location:./index.php");
      }
      require_once("./Pages/login.php");
    }
    ?>
  </div>
</body>


</html>