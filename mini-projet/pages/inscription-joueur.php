<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz SA</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <nav id="header">
        <img src="./assets/logo-QuizzSA.png" class="logo" alt="">
        <h2>Le plaisir de jouer</h2>
    </nav>
    <div class="inscription">
        <div id="contain-use">
            <h4>S'inscrire</h4>
            <p>Pour proposer des quizz</p>
            <hr>
            <div>
                <label for="prenomAdmin">Prénom</label><br>
                <input type="text" id="inscri-joueur" name="prenomAdmin">
            </div>
            <div>
                <label for="nomAdmin">Nom</label><br>
                <input type="text" id="inscri-joueur" name="nomAdmin">
            </div>
            <div>
                <label for="loginAdmin">Login</label><br>
                <input type="text" id="inscri-joueur" name="loginAdmin">
            </div>
            <div>
                <label for="pwdAdmin">Password</label><br>
                <input type="password" id="inscri-joueur" name="pwdAdmin">
            </div>
            <div>
                <label for="pwdAdmin">Confirm Password</label><br>
                <input type="password" id="inscri-joueur" name="pwdAdmin">
            </div>
            <p>Avatar</p>
            <button name="btn-avatar" class="btn-avatar">Choisir un fichier</button>
            <button name="creer-compte" class="creer-usercompte">Créer Compte</button>
        </div>
        <div class="avatar-inscrir">
        <img src="../assets/admin1.jpg" alt="" class="avatarAdminInscrir">
        <h6>Avatar Admin</h6>
    </div>
    </div>
</body>
</html>