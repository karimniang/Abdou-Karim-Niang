<form id="form" method="POST">
  <?php
  require_once("../includes/fonctions.php");
  ?>
  <div class="contant">
    <div class="lister">
      <div class="tab">
        <button type="button" class="tablinks" onclick="openCity(event, 'lst-joueur')" id="defaultOpen">Liste des Joueurs</button>
        <button type="button" class="tablinks" onclick="openCity(event, 'block-user')">Joueurs Bloqués</button>
      </div>
      <div id="lst-joueur" class="tabcontent">

        <table id="myTable">
          <thead>
            <tr>
              <th>Prenom</th>
              <th>Nom</th>
              <th>Score</th>
              <th>Statut</th>
            </tr>
          </thead>
          <tbody id="bodya">

          </tbody>
        </table>
        <div id="div_pagination">
          <input type="hidden" id="txt_rowid" value="0">
          <input type="hidden" id="txt_allcount" value="0">
          <input type="button" class="button" value="Previous" id="but_prev" />

          <input type="button" class="button" value="Next" id="but_next" />
        </div>
      </div>
      <div id="block-user" class="tabcontent">
        <?php

        $dataBlock = getDataJoueurBlq();
        ?>
        <table class="matable2">
          <thead>
            <tr>
              <th>Prenom</th>
              <th>Nom</th>
              <th>Score</th>
            </tr>
          </thead>
          <tbody>
            <?php
            for ($i = 0; $i < count($dataBlock); $i++) {
              echo '<tr>';
              echo '<td>' . $dataBlock[$i]['nom'] . '</td>';
              echo '<td>' . $dataBlock[$i]['prenom'] . '</td>';
              echo '<td>' . $dataBlock[$i]['score'] . '</td>';
              echo '</tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</form>
<script src="./JS/ls-joueur.js"></script>