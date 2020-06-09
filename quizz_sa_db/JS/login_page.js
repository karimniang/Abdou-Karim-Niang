$(document).ready(function () {
  var connect = $("#isconnect").val();
  //console.log(connect);
  // if (performance.navigation.type == 1) {
  //if (connect === "admin") {
  // $(".cont").load("./Pages/accueil.php");
  //} else if (connect === "jeux") {
  //$(".cont").load("./Pages/jeux.php");
  // }
  // }
  $(".connect").click(function () {
    //alert("ok");
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
    $.ajax({
      type: "POST",
      url: "./bds/connexion.php",
      data: "login=" + login + "&password=" + pass,
      success: function (data) {
        //console.log(data);
        if (data === "admin") {
          $(".cont").load("./Pages/accueil.php");
          $("#mess-error").html(
            '<input type="hidden" id="isconnect" value="admin">'
          );
        } else if (data === "jeux") {
          $(".cont").load("./Pages/jeux.php");
          $("#mess-error").html(
            '<input type="hidden" id="isconnect" value="jeux">'
          );
        } else if (data === "invalide") {
          $("#mess-error").html(
            '<span style="color:red;">Vos infos de connexion sont invalide!</span>'
          );
        } else if (data === "bloque") {
          $("#mess-error").html(
            '<span style="color:red;">Vous avez été bloqué par un administrateur!</span>'
          );
        }
      },
    });
  });
});

$(".inscri").click(function () {
  loadContent($(this).attr("href"));
  return false;
});

function loadContent(page) {
  $.ajax({
    url: page,
    success: function (data) {
      $(".cont").html(data);
      event.preventDefault();
    },
  });
}
