function val() {
  d = document.getElementById("lab-3").value;
  if (d == "text") {
    document.getElementById("question-button").style.display = "none";
  } else if (d == "simple") {
    document.getElementById("textreponse").style.display = "none";
    document.getElementById("question-button").style.marginLeft = "400px";
    document.getElementById("question-button").style.top = "170px";
    document.getElementById("question-button").style.display = "block";
    document.getElementById("question-button").style.position = "absolute";
    $(document).ready(function () {
      var counter = 0; //Input fields increment limitation
      var addButton = $("#question-button"); //Add button selector
      var wrapper = $("#apparait"); //Input field wrapper
      //Once add button is clicked
      $(addButton).click(function () {
        $(wrapper).append(
          '<div><label for="">Réponse </label><input type="text" id="lab-4" name="reponse[]"/><input type="radio" name="simplechoix' +
            counter +
            '"><button class="remove_button"><img src="./assets/supprimer.png"/></button></div>'
        ); //Add field html
        counter++;
      });
    });
  } else if (d == "multiple") {
    document.getElementById("textreponse").style.display = "none";
    document.getElementById("question-button").style.marginLeft = "400px";
    document.getElementById("question-button").style.top = "170px";
    document.getElementById("question-button").style.display = "block";
    document.getElementById("question-button").style.position = "absolute";
    $(document).ready(function () {
      var counter = 0; //Input fields increment limitation
      var addButton = $("#question-button"); //Add button selector
      var wrapper = $("#apparait"); //Input field wrapper
      //Once add button is clicked
      $(addButton).click(function () {
        $(wrapper).append(
          '<div><label for="">Réponse </label><input type="text" id="lab-4" name="reponse[]"/><input type="checkbox" value="on" name="multiplechoix' +
            counter +
            '"><button class="remove_button"><img src="./assets/supprimer.png"/></button></div>'
        ); //Add field html
        counter++;
      });
    });
  }
  //Once remove button is clicked
  $("#apparait").on("click", ".remove_button", function (e) {
    e.preventDefault();
    $(this).parent("div").remove(); //Remove field html
    counter--; //Decrement field counter
  });
}
//question validate !!!

$(".enregistre").click(function () {
  if ($("#errqn").val() == "") {
    $("#errore").html("Please Enter Your question!");
    $("#errqn").focus();
    return false;
  }
  if ($("#errpt").val() == "") {
    $("#errore").html("Please set the score!");
    $("#errpt").focus();
    return false;
  }
  let chaine = $("form").serializeArray();
  console.log(chaine);

  $.ajax({
    type: "POST",
    url: "http://localhost/Projet_S.A/quizz_sa_db/bds/creerQuestion.php",
    data: chaine,
    success: function (response) {
      //alert(response);
      console.log(response);
      if (response == "superieur") {
        $("#errore").html("Le nombre de point doit etre superieur à 5!!!");
      } else if (response == "reponse") {
        $("#errore").html("Veuillez remplir la(les) réponse(s)!!!");
      } else if (response == "seule") {
        $("#errore").html(
          "Ce type de question ne peut avoir qu'une seule réponse!!!"
        );
      } else if (response == "ajouter") {
        $("#errore").html("Votre question a été ajouté!!!");
        setTimeout(function () {
          // Attendre 2 secondes avant de recharger la page(2)
          location.reload();
        }, 2000);
      }
    },
  });
});
