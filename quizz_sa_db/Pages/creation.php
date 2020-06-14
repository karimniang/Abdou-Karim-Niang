<div style="margin: 0; padding: 10px;">
  <form action="" method="POST" id="mon-form">
    <div class="creation">
      <p id="monp">Donnez les paramétres de votre question</p>
      <div class="Qform">
        <label for="question">Questions</label>
        <input type="text" name="question" class="question-form" value="<?= @$_POST['question'] ?>" id="errqn">
      </div>
      <div class="Qform">
        <label for="point">Point</label>
        <input type="number" name="point" class="input-form" value="<?= @$_POST['point'] ?>" id="errpt">
      </div>
      <p class="reponsess">Réponses</p>
      <div>
        <label id="type" for="type">Type</label>
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
          <input type="text" name="reptxt" id="lab-4" />
        </div>
      </div>
      <span id="errore"></span>
      <button type="button" name="enregistrer" class="enregistre">Enregistrer</button>
    </div>
  </form>
</div>
<script src="./JS/creer-question.js"></script>