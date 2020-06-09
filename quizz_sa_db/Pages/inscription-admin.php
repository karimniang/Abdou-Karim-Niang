<div class="contant">
  <form action="" method="POST" enctype="multipart/form-data" id="my-form">
    <div class="saveAdmin">
      <div>
        <label for="prenom">Prenom</label>
        <input type="text" name="prenom" id="prenom" class="input-tt" error="error-1">
        <div class="error-form-admin" id="error-1"></div>
      </div>
      <div>
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" class="input-tt" error="error-2">
        <div class="error-form-admin" id="error-2"></div>
      </div>
      <div>
        <label for="login">Login</label>
        <input type="text" name="login" id="log" class="input-tt" error="error-3">
        <div class="error-form-admin" id="error-3"></div>
      </div>
      <div>
        <label for="pwd">Password</label>
        <input type="password" name="pwd" id="pass" class="input-tt" error="error-4">
        <div class="error-form-admin" id="error-4"></div>
      </div>
      <div>
        <label for="pwd2">Confirm Password</label>
        <input type="password" name="pwd2" id="pass2" class="input-tt" error="error-5">
        <div class="error-form-admin" id="error-5"></div>
      </div>
      <input type="file" name="file" id="file" class="photoAdmin" error="error-6">
      <div class="error-form-img-2" id="error-6"></div>
      <button name="creer-compte" class="creer-userAdmin">Créer Compte</button>
    </div>
    <div class="img-inscri-2">
      <img src="./assets/admin1.jpg" id="bash" alt="">
    </div>
  </form>
</div>

<script src="./JS/inscription-user.js"></script>