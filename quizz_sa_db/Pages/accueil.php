essayon admin <br>
<?php
if (!isset($_SESSION['users'])) {
    header("location:./index.php");
    exit();
}
echo $_SESSION['users']['nom'];
?>
<img src="<?php echo $_SESSION['users']['photo']; ?>" style="width: 100px; height: 100px;" alt=""> <br>
<a href="./index.php?log"> Deconnexion </a>
<?php

if (isset($_GET['log'])) {
    header("location:./index.php");
}
?>