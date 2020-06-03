<div class="contant">
  <div class="lister">
    <div class="tab">
      <button type="button" class="tablinks" onclick="openCity(event, 'lst-joueur')" id="defaultOpen">Liste des Joueurs</button>
      <button type="button" class="tablinks" onclick="openCity(event, 'block-user')">Joueurs Bloqués</button>
    </div>
    <div id="lst-joueur" class="tabcontent">
      <?php

      $dataUnblock = getDataJoueurUblq();
      ?>
      <table id="myTable">
        <thead>
          <tr>
            <th>Prenom</th>
            <th>Nom</th>
            <th>Score</th>
            <th>Statut</th>
          </tr>
        </thead>
        <tbody>
          <?php
          for ($i = 0; $i < count($dataUnblock); $i++) {
            echo '<tr>';
            echo '<td>' . $dataUnblock[$i]['nom'] . '</td>';
            echo '<td>' . $dataUnblock[$i]['prenom'] . '</td>';
            echo '<td>' . $dataUnblock[$i]['score'] . '</td>';
            echo '<td><button type="button"><a href="index.php?link=admin&lock=lisJoueur&block=' . $dataUnblock[$i]['id'] . '">Unblock</a></button></td>';
            echo '</tr>';
          }
          ?>
        </tbody>
      </table>

      <?php
      if (isset($_GET['block'])) {
        bloquer($_GET['block']);
      }
      ?>
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
            <th>Statut</th>
          </tr>
        </thead>
        <tbody>
          <?php
          for ($i = 0; $i < count($dataBlock); $i++) {
            echo '<tr>';
            echo '<td>' . $dataBlock[$i]['nom'] . '</td>';
            echo '<td>' . $dataBlock[$i]['prenom'] . '</td>';
            echo '<td>' . $dataBlock[$i]['score'] . '</td>';
            echo '<td><button type="button"><a href="index.php?link=admin&lock=lisJoueur&unblock=' . $dataBlock[$i]['id'] . '">Block</a></button></td>';
            echo '</tr>';
          }
          ?>
        </tbody>
      </table>

      <?php
      if (isset($_GET['unblock'])) {
        debloquer($_GET['unblock']);
      }
      ?>
    </div>
  </div>

</div>
<script src="./JS/ls-joueur.js"></script>