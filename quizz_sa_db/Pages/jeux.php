essayon joueur <br>
<?php
if (!isset($_SESSION['users'])) {
    header("location:./index.php");
    exit();
}
echo $_SESSION['users']['nom'];
?>
<br>
<a href="./index.php?log"> Deconnexion </a>
<?php
if (isset($_GET['log'])) {
    header("location:./index.php");
}

?>