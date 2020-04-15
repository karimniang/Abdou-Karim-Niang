<?php
isConnect();
?>
<form action="" method="POST" class="box">
    <div class="contain">
        <div class="user">
            <img src="<?php echo $_SESSION['image'] ?>" class="avatar" alt="avatar">
            <h6><?php echo $_SESSION['name'].' '.$_SESSION['lastname']?></h6>
        </div>
        <div class="titre">
            <h3>BIENVENUE SUR LA PLATFORME DE JEU DE QUIZZ <br> JOUER ET TESTER VOTRE NIVEAU DE CULTURE GENERALE</h3>
        </div>
        <a href="index.php?statut=logout" class="btn">Deconnexion</a>
    </div><br><br>
</form>
</body>
</html>