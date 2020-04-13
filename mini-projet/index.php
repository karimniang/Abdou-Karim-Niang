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
    <form action="" method="POST" class="monbox">
        <div class="containe">
            <h3>Login Form</h3>
        </div><br><br>
        <div id="form-login">
            <div class="form-control">
                <input type="text" name="login"  placeholder="Login" required >
                <img src="./assets/icone-user.png"  class="icon" alt="">    
            </div>
            <div class="form-control">
            <input type="password" name="password" placeholder="Password" required><br>
            <img src="./assets/icone-password.png"  class="icon" alt=""> 
            </div>
            <button id="button" name="connexion">Connexion</button>
            <button id="button2" name="inscription">S'inscrire pour jouer</button>
            
        </div><br>
        <?php
        session_start();
        $file = 'file.json';
        $data = file_get_contents($file);
        $obj = json_decode($data);
        if (isset($_POST['connexion']) && ( (!empty($_POST['login'])) && (!empty($_POST['password'])) )) {
            $log = $_POST['login'];
            $pwds = $_POST['password'];
            $found = false;
            foreach ($obj->Admin as $key => $value) {
                if (($log == $value->user) && ($pwds == $value->pwd)) {
                    $found = true;
                    $_SESSION['name'] = $value->prenom;
                    $_SESSION['lastname'] = $value->nom;
                    $_SESSION['imageAdmin'] = $value ->photo;
                    header("location: ./pages/accueil.php");
                }
            }
            foreach ($obj->Joueurs as $key => $value) {
                if (($log == $value->user) && ($pwds == $value->pwd)) {
                    $found = true;
                    $_SESSION['image'] = $value ->photo;
                    $_SESSION['name'] = $value ->prenom;
                    $_SESSION['lastname'] = $value ->nom;
                    header("location: ./pages/interface.php");
                }
            }
            if ($found == false) {
                echo '<p align="center"> Vos informations de connexions sont invalides </p>';
            }
        }
    ?>
    </form>
</body>
</html>