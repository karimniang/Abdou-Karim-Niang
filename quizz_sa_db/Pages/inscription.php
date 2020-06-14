<div class="contain">
  <div class="new_inscri">
    <div class="ajout"></div>
    <form action="" method="POST" enctype="multipart/form-data" id="my-form">
      <div class="save">
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
        <input type="file" name="file" id="file" class="photo" error="error-6">
        <input type="hidden" id="profil" name="profil" value="joueur">
        <div id="mess-error" style="margin-left: 100px;"></div>
      </div>
      <button type="submit" name="creer-compte" id="creer-use" class="creer-user">Créer Compte</button>
      <img src="./assets/admin1.jpg" id="bash" alt="" class="img-inscri">
    </form>
  </div>

</div>
<script src="./JS/inscription-user.js"></script>