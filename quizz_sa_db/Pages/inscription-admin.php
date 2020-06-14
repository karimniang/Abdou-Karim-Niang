<div class="contant">
  <form action="" method="POST" enctype="multipart/form-data" id="my-form">
    <div class="saveAdmin">
      <div>
        <label for="prenom">Prenom</label>
        <input type="text" name="prenom" id="prenom" class="input-tt">
      </div>
      <div>
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" class="input-tt">
      </div>
      <div>
        <label for="login">Login</label>
        <input type="text" name="login" id="log" class="input-tt">
      </div>
      <div>
        <label for="pwd">Password</label>
        <input type="password" name="password1" id="pass" class="input-tt">
      </div>
      <div>
        <label for="pwd2">Confirm Password</label>
        <input type="password" name="password2" id="pass2" class="input-tt">
      </div>
      <input type="file" name="file" id="file" class="photoAdmin">
      <input type="hidden" id="profil" name="profil" value="admin">
      <div id="mess-error" style="margin-left: 80px; margin-top:5px"></div>
      <button type="submit" name="creer-compte" id="creer-use" class="creer-userAdmin">Créer Compte</button>
    </div>
    <div class="img-inscri-2">
      <img src="./assets/admin1.jpg" id="bash" alt="">
    </div>
  </form>
</div>

<script src="./JS/inscription-user.js"></script>