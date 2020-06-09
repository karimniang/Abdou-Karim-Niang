$.ajax({
  url: "http://localhost/Projet_S.A/quizz_sa_db/bds/best.php",
  dataType: "JSON",
  success: function (data) {
    var dataLen = data.length;
    //console.log(data);
    for (var i = 0; i < dataLen; i++) {
      var prenom = data[i]["prenom"];
      var nom = data[i]["nom"];
      var score = data[i]["score"];
      //console.log(prenom);
      $("#monbody").append("<tr id='tr_" + i + "'></tr>");
      $("#tr_" + i).append("<td>" + prenom + "</td>");
      $("#tr_" + i).append("<td>" + nom + "</td>");
      $("#tr_" + i).append("<td>" + score + "</td>");
    }
  },
});

/* Create Table */

//Menu
function openCity(evt, affiche) {
  // Declarer tous les variables
  var i, tabcontent, tablinks;

  // Prendre les elements avec class="tabcontent"
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Prendre les elements avec class="tablinks" et supprime la class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace("active", "");
  }

  // Voir le tab courrat, et ajouter une classe "active" au button qui ouvre le tab
  document.getElementById(affiche).style.display = "block";
  evt.currentTarget.className += "active";
}
// obtenir l'élèment avec l'id="defaultOpen"
document.getElementById("defaultOpen").click();
