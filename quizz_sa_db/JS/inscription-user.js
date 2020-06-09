function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $("#bash").attr("src", e.target.result);
    };

    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

// pour les admins

// pour les joueurs
$("#file").change(function () {
  readURL(this);
});

$(".creer-user").click(function () {
  //alert("ok");
  var profil = $("#profil").val();
  //alert(profil);
  var prenom = $("#prenom").val();
  if (prenom == "") {
    $("#mess-error").html('<span style="color:red;">Enter Your Name!</span>');
    $("#prenom").focus();
    return false;
  }
  var nom = $("#nom").val();
  if (nom == "") {
    $("#mess-error").html(
      '<span style="color:red;">Enter Your Lastname!</span>'
    );
    $("#nom").focus();
    return false;
  }
  var login = $("#log").val();
  if (login == "") {
    $("#mess-error").html('<span style="color:red;">Enter Your Login!</span>');
    $("#log").focus();
    return false;
  }
  var pass = $("#pass").val();
  if (pass == "") {
    $("#mess-error").html(
      '<span style="color:red;">Enter Your Password!</span>'
    );
    $("#pass").focus();
    return false;
  }
  var pass2 = $("#pass2").val();
  if (pass2 == "") {
    $("#mess-error").html(
      '<span style="color:red;">Confirm  Your Password!</span>'
    );
    $("#pass2").focus();
    return false;
  }

  $.ajax({
    type: "POST",
    url: "./bds/inscrire.php",
    data:
      fd +
      "&prenom=" +
      prenom +
      "&nom=" +
      nom +
      "&login=" +
      login +
      "&password1=" +
      pass +
      "&password2=" +
      pass2 +
      "&profil=" +
      profil,
    contentType: false,
    processData: false,
    success: function (response) {
      console.log(response);
      if (gy === "ajouter") {
        $("#mess-error").html(
          '<span style="color:red;">Vous etes dedans!</span>'
        );
      } else if (gy === "different") {
        $("#mess-error").html(
          '<span style="color:red;">Vos mdp sont diff!</span>'
        );
      } else if (gy === "photo") {
        $("#mess-error").html(
          '<span style="color:red;">Probleme Photo!</span>'
        );
      } else if (gy === "login") {
        $("#mess-error").html(
          '<span style="color:red;">Probleme login!</span>'
        );
      }
    },
  });
});
