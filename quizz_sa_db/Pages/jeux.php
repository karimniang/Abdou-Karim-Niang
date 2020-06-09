<?php
include("../includes/fonctions.php");
?>


<div class="contain">
  <div class="pat-joueur">
    <button class="dcn-jj">Deconnexion</button>
    <img src="<?php echo $_SESSION['users']['photo']; ?>" alt="" class="img-joueur">
    <h6><?php echo $_SESSION['users']['prenom'] . '  ' . $_SESSION['users']['nom']; ?> </h6>
    <div class="scoreya">
      <div class="tab">
        <button type="button" class="tablinks" onclick="openCity(event, 'top-score')" id="defaultOpen">Top Score</button>
        <button type="button" class="tablinks" onclick="openCity(event, 'best-user')">Mes meilleurs scores</button>
      </div>
      <div id="top-score" class="tabcontent" id="mesplay">
        <table id="myTable">
          <thead>
            <th>Prenom</th>
            <th>Nom</th>
            <th>Score</th>
          </thead>
          <tbody id="monbody">
          </tbody>
        </table>
      </div>
      <div id="best-user" class="tabcontent" id="moiplay">
        <table id="myTable">
          <thead>
            <th>Prenom</th>
            <th>Nom</th>
            <th>Score</th>
          </thead>
          <tbody>
            <td><?php echo $_SESSION['users']['prenom']; ?></td>
            <td><?php echo $_SESSION['users']['nom']; ?></td>
            <td><?php echo $_SESSION['users']['score']; ?></td>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="pat-jeux">

  </div>
</div>
<script src="./JS/monjeux.js"></script>