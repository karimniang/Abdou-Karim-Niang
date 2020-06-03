var $table = document.getElementById("myTable"),
  // nombre de ligne par page
  $n = 5,
  // nombre de ligne de la table
  $rowCount = $table.rows.length,
  // recupéré l'entête
  $firstRow = $table.rows[0].firstElementChild.tagName,
  // boolean var to check if table has a head row
  $hasHead = $firstRow === "TH",
  // Recupérer les autres lignes
  $tr = [],
  // commencer à partir de rows[1] (2nd ligne) si la ligne est l'entête
  $i,
  $ii,
  $j = $hasHead ? 1 : 0,
  // holds the first row if it has a (<TH>) & nothing if (<TD>)
  $th = $hasHead ? $table.rows[0].outerHTML : "";
// Compter le nombre de page
var $pageCount = Math.ceil($rowCount / $n);
// if we had one page only, then we have nothing to do ..
if ($pageCount > 1) {
  // assign each row outHTML (tag name & innerHTML) to the array
  for ($i = $j, $ii = 0; $i < $rowCount; $i++, $ii++)
    $tr[$ii] = $table.rows[$i].outerHTML;
  // create a div block to hold the buttons
  $table.insertAdjacentHTML("afterend", "<div id='buttons'></div");
  // the first sort, default page is the first one
  sort(1);
}

// ($p) is the selected page number. it will be generated when a user clicks a button
function sort($p) {
  /* create ($rows) a variable to hold the group of rows
   ** to be displayed on the selected page,
   ** ($s) the start point .. the first row in each page, Do The Math
   */
  var $rows = $th,
    $s = $n * $p - $n;
  for ($i = $s; $i < $s + $n && $i < $tr.length; $i++) $rows += $tr[$i];

  // now the table has a processed group of rows ..
  $table.innerHTML = $rows;
  // create the pagination buttons
  document.getElementById("buttons").innerHTML = pageButtons($pageCount, $p);
  // CSS Stuff
  document.getElementById("id" + $p).setAttribute("class", "active");
}

// ($pCount) : number of pages,($cur) : current page, the selected one ..
function pageButtons($pCount, $cur) {
  /* this variables will disable the "Prev" button on 1st page
       and "next" button on the last one */
  var $prevDis = $cur == 1 ? "disabled" : "",
    $nextDis = $cur == $pCount ? "disabled" : "",
    /* this ($buttons) will hold every single button needed
     ** it will creates each button and sets the onclick attribute
     ** to the "sort" function with a special ($p) number..
     */
    $buttons =
      "<input type='button' value='Prev' onclick='sort(" +
      ($cur - 1) +
      ")' " +
      $prevDis +
      ">";
  for ($i = 1; $i <= $pCount; $i++)
    $buttons +=
      "<input type='button' id='id" +
      $i +
      "'value='" +
      $i +
      "' onclick='sort(" +
      $i +
      ")'>";
  $buttons +=
    "<input type='button' value='Next' onclick='sort(" +
    ($cur + 1) +
    ")' " +
    $nextDis +
    ">";
  return $buttons;
}

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
