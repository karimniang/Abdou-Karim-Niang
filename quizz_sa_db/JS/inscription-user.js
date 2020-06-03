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
$("#photoAdmin").change(function () {
  readURL(this);
});

// pour les joueurs
$("#photo").change(function () {
  readURL(this);
});

// Validation des champs de saisis
const inputs = document.getElementsByTagName("input");
for (input of inputs) {
  input.addEventListener("keyup", function (e) {
    if (e.target.hasAttribute("error")) {
      var idDivError = e.target.getAttribute("error");
      document.getElementById(idDivError).innerText = "";
    }
  });
}

document.getElementById("my-form").addEventListener("submit", function (e) {
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
