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
                <input type="text" name="login" placeholder="Login" required >
                <img src="./assets/icone-user.png"  class="icon" alt="">    
            </div>
            <div class="form-control">
            <input type="text" name="pwd" placeholder="Password" required><br>
            <img src="./assets/icone-password.png"  class="icon" alt=""> 
            </div>
            <button type="" id="button" name="connexion">Connexion</button>
            <button type="" id="button2" name="connexion">S'inscrire pour jouer</button>
        </div><br>
    </form>
</body>
</html>