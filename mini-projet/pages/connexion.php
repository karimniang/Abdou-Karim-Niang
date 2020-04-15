




<div id="format">
    <div class="containe">
        <h3>Login Form</h3>
    </div><br><br>
    <form action="" method="POST" id="form-login">
        <div id="login-forme">
            <div class="form-control">
                <img src="./assets/icone-user.png"  class="icon" alt=""> 
                <input type="text" name="login" error ="error-1"  placeholder="Login">
                <div class="error-form"  id="error-1"></div>   
            </div>
            <div class="form-control">
                <img src="./assets/icone-password.png"  class="icon" alt="">
                <input type="password" name="password" error ="error-2"  placeholder="Password">
                <div class="error-form"  id="error-2"></div> 
            </div>
            <button id="button" type="submit" name="connexion" >Connexion</button>
            <a href="./pages/inscription.php" class="inscrir">S'inscrire pour jouer</a>
        </div><br>
    </form>
    <?php
    if (isset($_POST['connexion'])) {
    $log = $_POST['login'];
    $pwd = $_POST['password'];
    $resultat = connexion($log,$pwd);
        if ($resultat == "error") {
            echo "<p align='center'>Vos informations de connexions sont invalides</p>";
        }else {
            header("location: index.php?page=".$resultat);
        }    
    }
    ?>
</div>
<script>
    const inputs= document.getElementsByTagName("input");
        for (input of inputs){
            input.addEventListener ("keyup",function(e){
                if (e.target.hasAttribute("error")) {
                    var idDivError= e.target.getAttribute("error");
                 document.getElementById(idDivError).innerText=""
            }
        })
        }

        document.getElementById("form-login").addEventListener("submit",function(e){
            const inputs= document.getElementsByTagName("input");
            var error= false;
            for (input of inputs){
                if(input.hasAttribute("error")){
                    var idDivError= input.getAttribute("error");
                    if(!input.value){
                         document.getElementById(idDivError).innerText="Ce champ est obligatoire"
                         error= true;
                    }
                }
            }
            if(error){
                e.preventDefault();
                return false;
        }
    })
</script>