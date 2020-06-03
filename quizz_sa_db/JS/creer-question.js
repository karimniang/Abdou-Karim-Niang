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
          '<div><label for="">Réponse </label><input type="text" id="lab-4" name="reponse[]" error="error-' +
            counter +
            '" /><input type="radio" name="simplechoix' +
            counter +
            '"><button class="remove_button"><img src="./assets/supprimer.png"/></button><div class="error-form-question" id="error-' +
            counter +
            '"></div></div>'
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
          '<div><label for="">Réponse </label><input type="text" id="lab-4" name="reponse[]" error="error-' +
            counter +
            '" /><input type="checkbox" value="on" name="multiplechoix' +
            counter +
            '"><button class="remove_button"><img src="./assets/supprimer.png"/></button><div class="error-form-question" id="error-' +
            counter +
            '"></div></div>'
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
const inputs = document.getElementsByTagName("input");
for (input of inputs) {
  input.addEventListener("keyup", function (e) {
    if (e.target.hasAttribute("error")) {
      var idDivError = e.target.getAttribute("error");
      document.getElementById(idDivError).innerText = "";
    }
  });
}

document.getElementById("mon-form").addEventListener("submit", function (e) {
  const inputs = document.getElementsByTagName("input");
  var error = false;
  for (input of inputs) {
    if (input.hasAttribute("error")) {
      var idDivError = input.getAttribute("error");
      if (!input.value) {
        document.getElementById(idDivError).innerText =
          "Veuillez remplire ce champ";
        error = true;
      }
    }
  }
  if (error) {
    e.preventDefault();
    return false;
  }
});
