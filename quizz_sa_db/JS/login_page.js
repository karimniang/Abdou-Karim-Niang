const URL_ROOT = "index.php?action";
$(document).ready(function () {
  // if (performance.navigation.type == 1) {
  //if (connect === "admin") {
  // $(".cont").load("./Pages/accueil.php");
  //} else if (connect === "jeux") {
  //$(".cont").load("./Pages/jeux.php");
  // }
  // }
  // if (samaload()) {
  // console.log("reload");
  ///}

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
        if (data === "invalide") {
          $("#mess-error").html(
            '<span style="color:red;">Vos infos de connexion sont invalide!</span>'
          );
        } else if (data === "bloque") {
          $("#mess-error").html(
            '<span style="color:red;">Vous avez été bloqué par un administrateur!</span>'
          );
        } else {
          window.location.replace(URL_ROOT + "=" + data);
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
function samaload() {
  $(window).bind("beforeunload", function () {
    return "refreshed";
  });
}
