<?php
if (!isset($_SESSION['users'])) {
    header("location:./index.php");
    exit();
}
$cla1 = "menu-content";
$cla2 = "menu-content";
$cla3 = "menu-content";
$cla4 = "menu-content";
$cla5 = "menu-content";

if (isset($_GET['lock'])) {
    if ($_GET['lock'] === "lisQuestion") {
        $cla1 = "new-menu-content";
    } elseif ($_GET['lock'] === "creAdmin") {
        $cla2 = "new-menu-content";
    } elseif ($_GET['lock'] === "lisJoueur") {
        $cla3 = "new-menu-content";
    } elseif ($_GET['lock'] === "creQuestion") {
        $cla4 = "new-menu-content";
    } elseif ($_GET['lock'] === "dashboard") {
        $cla5 = "new-menu-content";
    }
}
?>
<div class="contain">
    <div class="accueil">
        <div class="dcn"><a href="./index.php?log"> Deconnexion </a></div>
        <img src="./assets/logoSA.png" alt="" class="icon-tete">
        <h3>Proposez Vos Questions</h3>
        <div class="menu">
            <img src="<?php echo $_SESSION['users']['photo'] ?>" class="avataradmin" alt="avatar">
            <p><?php echo $_SESSION['users']['nom'] . ' ' . $_SESSION['users']['prenom'] ?></p>
            <nav class="menu-nav">
                <div class="<?php echo $cla1 ?>">
                    <a href="index.php?link=admin&lock=lisQuestion" class="a-menu"> Liste Questions </a>
                    <img src="./assets/ic-liste-active.png" class="icon-menu" alt="">
                </div>
                <div class="<?php echo $cla2 ?>">
                    <a href="index.php?link=admin&lock=creAdmin" class="a-menu"> Créer Admin </a>
                    <img src="./assets/ic-ajout.png" class="icon-menu2" alt="">
                </div>
                <div class="<?php echo $cla3 ?>">
                    <a href="index.php?link=admin&lock=lisJoueur" class="a-menu"> Liste Joueur </a>
                    <img src="./assets/ic-liste.png" class="icon-menu2" alt="">
                </div>
                <div class="<?php echo $cla4 ?>">
                    <a href="index.php?link=admin&lock=creQuestion" class="a-menu"> Créer Questions </a>
                    <img src="./assets/ic-ajout.png" class="icon-menu" alt="">
                </div>
                <div class="<?php echo $cla5 ?>">
                    <a href="index.php?link=admin&lock=dashboard" class="a-menu"> Tableau de Bord </a>
                    <img src="./assets/icondsh.png" class="icon-dshb" alt="">
                </div>
            </nav>
        </div>
        <div class="affiche">
            <?php
            if (isset($_GET['lock'])) {
                if ($_GET['lock'] === "lisQuestion") {
                    $cla1 = "new-menu-content";
                    require_once("liste-question.php");
                } elseif ($_GET['lock'] === "creAdmin") {
                    $cla2 = "new-menu-content";
                    require_once("inscription-admin.php");
                } elseif ($_GET['lock'] === "lisJoueur") {
                    $cla3 = "new-menu-content";
                    require_once("liste-joueur.php");
                } elseif ($_GET['lock'] === "creQuestion") {
                    $cla4 = "new-menu-content";
                    require_once("creation.php");
                } elseif ($_GET['lock'] === "dashboard") {
                    $cla5 = "new-menu-content";
                    require_once("dashboard.php");
                }
            }
            ?>
        </div>
    </div>
</div>


<?php
if (isset($_GET['log'])) {
    header("location:./index.php");
}
?>