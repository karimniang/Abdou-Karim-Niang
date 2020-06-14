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
$(document).ready(function () {
  $("#my-form").on("submit", function (e) {
    e.preventDefault();
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
      $("#mess-error").html(
        '<span style="color:red;">Enter Your Login!</span>'
      );
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
    var profil = $("#profil").val();
    $.ajax({
      type: "POST",
      url: "./bds/inscrire.php",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (response) {
        console.log(response);
        if (response === "ajouter") {
          $("#mess-error").html(
            '<span style="color:red;">Vous venez de créer un compte' +
              profil +
              "!</span>"
          );
          setTimeout(function () {
            // Attendre 2 secondes avant de recharger la page(2)
            location.reload();
          }, 2000);
        } else if (response === "different") {
          $("#mess-error").html(
            '<span style="color:red;">Vos mot de pass sont différents!</span>'
          );
        } else if (response === "photo") {
          $("#mess-error").html(
            '<span style="color:red;">Veuillez choisir une photo valide!</span>'
          );
        } else if (response === "login") {
          $("#mess-error").html(
            '<span style="color:red;">Ce login est indisponible!</span>'
          );
        }
      },
    });
  });
});
