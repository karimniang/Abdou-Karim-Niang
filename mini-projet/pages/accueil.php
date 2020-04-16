<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz S.A</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php
        session_start();
        if (!isset($_SESSION['name']) && !isset($_SESSION['lastname'])) {
            header("location:../index.php");
            exit();
        }
?>
    <nav id="header">
        <img src="../assets/logo-QuizzSA.png" class="logo" alt="">
        <h2>Le plaisir de jouer</h2>
    </nav>
    <form action="" method="POST" class="box">
        <div class="containadmin">
            <h3>CREER ET PARAMETRER VOS QUIZZ</h3>
            <button name="deconnect" id="dcn">Deconnexion</button>
        </div><br><br>
        <div class="gauche">
            <img src="<?php echo $_SESSION['image'] ?>" class="avataradmin" alt="avatar">
            <h6><?php echo $_SESSION['name'].' '.$_SESSION['lastname']?></h6>
            <nav class="menu">
                <div class="menu-content">
                    <a href="accueil.php?lock=question" class="a-menu"> Liste Questions </a>
                    <img src="../assets/ic-liste-active.png" class="icon-menu" alt="">
                </div>
                <div class="menu-content">
                    <a href="accueil.php?lock=creer-admin" class="a-menu"> Créer Admin </a>
                    <img src="../assets/ic-ajout.png" class="icon-menu2" alt="">
                </div>
                <div class="menu-content">
                    <a href="accueil.php?lock=joueurs" class="a-menu"> Liste Joueur </a>
                    <img src="../assets/ic-liste.png" class="icon-menu2" alt="">
                </div>
                <div class="menu-content">
                    <a href="accueil.php?lock=creer-question" class="a-menu"> Créer Questions </a>
                    <img src="../assets/ic-ajout.png" class="icon-menu" alt="">
                </div>       
            </nav>
        </div>
        <div class="droite">
            <?php
                if (isset($_GET['lock'])) {
                    if ($_GET['lock']==="question") {
                        require_once("./liste-question.php");
                    }elseif ($_GET['lock']==="creer-admin") {
                        require_once("./inscription-admin.php");
                    }elseif ($_GET['lock']==="joueurs") {
                        require_once("./liste-joueur.php");
                    }elseif ($_GET['lock']==="creer-question") {
                        require_once("./creation-question.php");
                    }
                }
            ?>
        </div>
    <?php
      
        if (isset($_POST['deconnect'])) {
            unset($_SESSION['name']);
            unset($_SESSION['lastname']);
            session_destroy();
            header("location:../index.php");
        }
    ?>    
</form>
    
</body>
</html>
   


