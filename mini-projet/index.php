<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
    <nav id="header">
        <img src="./assets/logo-QuizzSA.png" class="logo" alt="">
        <h2>Le plaisir de jouer</h2>
    </nav>
    <div class="content">
        <?php
        session_start();
        require_once("./includes/fonctions.php");

        if (isset($_GET['page'])) {
            switch($_GET['page']){
                case "accueil":
                    require_once("./pages/accueil.php");
                break;
                case "jeux":
                    require_once("./pages/jeux.php");
                break;
            }
           
        }else {
            if (isset($_GET['statut']) && $_GET['statut']==="logout") {
                deconnect();
            }
            require_once("./pages/connexion.php");
        }
        
        ?>
    </div>
</body>
</html>