<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="../assets/style-accueil.css">
</head>
<body>
    <?php
    session_start();
    ?>
    <nav id="header">
        <img src="../assets/logo-QuizzSA.png" class="logo" alt="">
        <h2>Le plaisir de jouer</h2>
    </nav>
    <form action="" method="POST" class="box">
        <div class="contain">
            <h3>CREER ET PARAMETRER VOS QUIZZ</h3>
            <button  name="deconnect" class="btn">Déconnexion</button>
        </div><br><br>
        <div class="gauche">
            <img src="<?php echo $_SESSION['imageAdmin'] ?>" class="avatar" alt="avatar">
            <h6><?php echo $_SESSION['name'].' '.$_SESSION['lastname']?></h6>
        </div>
    </form>
    <?php
        if (!isset($_SESSION['name']) && !isset($_SESSION['lastname'])) {
            header("location: ../index.php");
            exit();
        }
        if (isset($_POST['deconnect'])) {
            session_destroy();
            header("location: ../index.php");
        }
        ?>
</body>
</html>