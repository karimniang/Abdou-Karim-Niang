<div style="margin: 0; padding: 10px;">
  <form action="" method="POST" id="mon-form">
    <div class="creation">
      <p id="monp">Donnez les paramétres de votre question</p>
      <div class="Qform">
        <label for="question">Questions</label>
        <input type="text" name="question" class="question-form" value="<?= @$_POST['question'] ?>" error="errori-1">
        <div class="error-form-question" id="errori-1"></div>
      </div>
      <div class="Qform">
        <label for="point">Point</label>
        <input type="number" name="point" class="input-form" value="<?= @$_POST['point'] ?>" error="errori-2">
        <div class="error-form-question" id="errori-2"></div>
      </div>
      <p class="reponsess">Réponses</p>
      <div>
        <label style="margin-left: 80px; text-decoration: underline;" for="type">Type</label>
        <select name="type" onchange="val()" id="lab-3">
          <option value="" disabled selected>Donnez le type de réponse</option>
          <option value="text">Text</option>
          <option value="simple">Choix Simple</option>
          <option value="multiple">Choix Multiple</option>
        </select>
        <button type="button" name="button-question" id="question-button"><img src="./assets/ajouter.png" alt=""></button>
      </div>
      <div id="apparait">
        <div id="textreponse">
          <label style="text-decoration: underline;" for="rep">Réponse:</label>
          <input type="text" name="reponse" id="lab-4" />
        </div>
      </div>
      <button type="button" name="enregistrer" class="enregistre">Enregistrer</button>
    </div>
  </form>

  <?php
  if (isset($_POST['enregistrer'])) {
    $question = $_POST['question'];
    $nbreDePoint = $_POST['point'];
    $type = $_POST['type'];
    $bonneReponse;
    $tabDesReponses = $_POST['reponse'];
    if ($type == 'text') {
      $bonneReponse = $tabDesReponses;
    } elseif ($type == 'simple') {
      for ($i = 0; $i < count($tabDesReponses); $i++) {
        if (!empty($_POST['simplechoix' . $i])) {
          $bonneReponse[] = $tabDesReponses[$i];
        }
      }
      $tabDesReponses = implode(';', $tabDesReponses);
      $bonneReponse = implode(';', $bonneReponse);
    } elseif ($type == 'multiple') {
      for ($i = 0; $i < count($tabDesReponses); $i++) {
        if (!empty($_POST['multiplechoix' . $i])) {
          $bonneReponse[] = $tabDesReponses[$i];
        }
      }
      $tabDesReponses = implode(';', $tabDesReponses);
      $bonneReponse = implode(';', $bonneReponse);
    }



    if (empty($question)) {
      echo 'Veuillez remplir la question';
    } elseif (empty($nbreDePoint)) {
      echo 'Veuillez donnez le nombre de point';
    } elseif ($nbreDePoint < 5) {
      echo 'Le nombre de point doit etre superieur à 5';
    } elseif (empty($type)) {
      echo 'Veuillez choisir le type de réponse';
    } elseif (empty($tabDesReponses)) {
      echo 'Veuillez remplir la(les) réponse(s)';
    } elseif ($type == 'simple' && sizeof($bonneReponse) > 1) {
      echo '<p align="center" >Ce type de question ne peut avoir qu\'une seule réponse</p>';
    } else {
      $dataQuestion = [
        "question" => $question,
        'score' => $nbreDePoint,
        "type" => $type,
        "tous" => $tabDesReponses,
        "bonne" => $bonneReponse
      ];

      ajoutquestion($question, $nbreDePoint, $type, $tabDesReponses, $bonneReponse);
      echo '<p align="center" >Votre Question a été ajouté</p>';
    }
  }
  ?>
</div>
<script src="./JS/creer-question.js"></script>