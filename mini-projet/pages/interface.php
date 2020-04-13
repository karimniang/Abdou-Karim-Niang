<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz S.A</title>
    <link rel="stylesheet" href="../assets/style-interface.css">
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
            <div class="user">
                <img src="<?php echo $_SESSION['image'] ?>" class="avatar" alt="avatar">
                <h6><?php echo $_SESSION['name'].' '.$_SESSION['lastname']?></h6>
            </div>
            <div class="titre">
                <h3>BIENVENUE SUR LA PLATFORME DE JEU DE QUIZZ <br> JOUER ET TESTER VOTRE NIVEAU DE CULTURE GENERALE</h3>
            </div>
                <button name="deconnect" class="btn">Déconnexion</button>
        </div><br><br>
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
    </form>
</body>
</html>