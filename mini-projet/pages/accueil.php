<?php
isConnect();
?>
<form action="" method="POST" class="box">
        <div class="containadmin">
            <h3>CREER ET PARAMETRER VOS QUIZZ</h3>
            <a href="index.php?statut=logout" class="btn">Deconnexion</a>
        </div><br><br>
        <div class="gauche">
            <img src="<?php echo $_SESSION['image'] ?>" class="avataradmin" alt="avatar">
            <h6><?php echo $_SESSION['name'].' '.$_SESSION['lastname']?></h6>
        </div>
</form>
</body>
</html>