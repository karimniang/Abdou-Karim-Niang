// Total number of rows visible at a time
var rowperpage = 5;
getData();

$("#but_prev").click(function () {
  var rowid = Number($("#txt_rowid").val());
  var allcount = Number($("#txt_allcount").val());
  rowid -= rowperpage;
  if (rowid < 0) {
    rowid = 0;
  }
  $("#txt_rowid").val(rowid);
  getData();
});

$("#but_next").click(function () {
  var rowid = Number($("#txt_rowid").val());
  var allcount = Number($("#txt_allcount").val());
  rowid += rowperpage;
  if (rowid <= allcount) {
    $("#txt_rowid").val(rowid);
    getData();
  }
});

/* requesting data */
function getData() {
  var rowid = $("#txt_rowid").val();
  var allcount = $("#txt_allcount").val();

  $.ajax({
    url: "http://localhost/Projet_S.A/quizz_sa_db/bds/ls-player.php",
    type: "post",
    data: { rowid: rowid, rowperpage: rowperpage },
    dataType: "json",
    success: function (response) {
      createTablerow(response);
    },
  });
}
/* Create Table */
function createTablerow(data) {
  var dataLen = data.length;
  console.log(data);
  $("#myTable tr:not(:first)").remove();

  for (var i = 0; i < dataLen; i++) {
    if (i == 0) {
      var allcount = data[i]["allcount"];
      $("#txt_allcount").val(allcount);
    } else {
      var prenom = data[i]["prenom"];
      var nom = data[i]["nom"];
      var score = data[i]["score"];
      var id = data[i]["id"];
      $("#bodya").append("<tr id='tr_" + i + "'></tr>");
      $("#tr_" + i).append("<td>" + prenom + "</td>");
      $("#tr_" + i).append("<td>" + nom + "</td>");
      $("#tr_" + i).append("<td>" + score + "</td>");
      $("#tr_" + i).append(
        "<td id='btn_bl_" +
          id +
          "'><button type='button' id='btn'>Block</button></td>"
      );
      $("#tr_" + i).append(
        "<td id='btn_sup_" +
          id +
          "'><button type='button' id='btn'>Suppr</button></td>"
      );
    }
  }
}

$("#bodya").on("click", "#btn", function () {
  var tab = $(this).parents().attr("id").split("_");
  var id = tab[2];
  var type = tab[1];
  $.ajax({
    url: "http://localhost/Projet_S.A/quizz_sa_db/bds/updates.php",
    type: "post",
    data: { id: id, type: type },
    success: function (response) {
      console.log(response);
      if (response == "bloque") {
        alert("ce joueur bloque");
      } else if (response == "supp") {
        alert("ce joueur supprimer");
      }
      //createTablerow(response);
    },
  });
});

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

//
