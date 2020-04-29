<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="contantt">
  <form action="" method="POST" id="form-dynamic">
    <h2>PARAMETRER VOTRE QUESTION</h2>
    <div class="creer">
      <div class="laquestion">
        <label for="question">Questions</label>
        <input type="text" name="question" value="<?= @$_POST['question'] ?>" error="errori-1" id="lab-1">
        <div class="error-form" id="errori-1"></div>
      </div>
      <div class="laquestion">
        <label for="point">Nbre de Points</label>
        <input type="number" name="point" value="<?= @$_POST['point'] ?>" error="errori-2" id="lab-2">
        <div class="error-form" id="errori-2"></div>
      </div>
      <div class="laquestion">
        <label for="reponse">Type de Réponse</label>
        <select id="lab-3" onchange="val()" name="choice">
          <option value="" disabled selected>Donnez le type de réponse</option>
          <option value="text">Text</option>
          <option value="simple">Choix Simple</option>
          <option value="multiple">Choix Multiple</option>
        </select>
        <button type="button" name="button-question" id="question-button"><img src="../assets/reponse-ajout.png" alt=""></button>
      </div>
      <div id="apparait">
        <div id="textreponse">
          <label for="rep">Réponse </label>
          <input type="text" name="reponse" id="lab-4" />
        </div>
      </div>
      <button type="submit" name="enregistrer" class="enregistre">Enregistrer</button>
    </div>
  </form>
</div>
<?php
function ajoutquestion($array)
{
  $array;
  $file = '../question.json';
  $data = file_get_contents($file);
  $obj = json_decode($data);
  array_push($obj, $array);
  $jsonData = json_encode($obj);
  file_put_contents($file, $jsonData);
}
if (isset($_POST['enregistrer'])) {
  $question = $_POST['question'];
  $nbreDePoint = $_POST['point'];
  $type = $_POST['choice'];
  $bonneReponse = [];
  $tabDesReponses = $_POST['reponse'];
  if ($type == 'text') {
    array_push($bonneReponse, $tabDesReponses);
  } elseif ($type == 'simple') {
    for ($i = 0; $i < count($tabDesReponses); $i++) {
      if (!empty($_POST['simplechoix' . $i])) {
        array_push($bonneReponse, $tabDesReponses[$i]);
      }
    }
  } elseif ($type == 'multiple') {
    for ($i = 0; $i < count($tabDesReponses); $i++) {
      if (!empty($_POST['multiplechoix' . $i])) {
        array_push($bonneReponse, $tabDesReponses[$i]);
      }
    }
  }

  if (empty($question)) {
    echo 'Veuillez remplir la question';
  } elseif (empty($nbreDePoint)) {
    echo 'Veuillez donnez le nombre de point';
  } elseif ($nbreDePoint < 1) {
    echo 'Le nombre de point doit etre superieur à 1';
  } elseif (empty($type)) {
    echo 'Veuillez choisir le type de réponse';
  } elseif (empty($tabDesReponses)) {
    echo 'Veuillez remplir la(les) réponse(s)';
  } elseif ($type == 'simple' && sizeof($bonneReponse) > 1) {
    echo '<p align="center" >Ce type de question ne peut avoir qu\'une seule réponse</p>';
  } else {
    $dataQuestion = [
      "question" => $question,
      "score" => $nbreDePoint,
      "type" => $type,
      "bonne" => $bonneReponse,
      "tous" => $tabDesReponses
    ];
    ajoutquestion($dataQuestion);
    echo '<p align="center" >Votre Question a été ajouté</p>';
  }
}
?>
<script>
  function val() {
    d = document.getElementById("lab-3").value;
    if (d == "text") {
      document.getElementById('question-button').style.display = "none";
    } else if (d == "simple") {
      document.getElementById('textreponse').style.display = "none";
      document.getElementById('question-button').style.marginLeft = "480px";
      document.getElementById('question-button').style.top = "200px";
      document.getElementById('question-button').style.display = "block";
      $(document).ready(function() {
        var counter = 0; //Input fields increment limitation
        var addButton = $('#question-button'); //Add button selector
        var wrapper = $('#apparait'); //Input field wrapper
        //Once add button is clicked
        $(addButton).click(function() {
          $(wrapper).append('<br><div><label for="">Réponse </label><input type="text" id="lab-4" name="reponse[]" error="error-' + (counter) + '" /><input type="radio" name="simplechoix' + (counter) + '"><button class="remove_button"><img src="../assets/supprimer.png"/></button><div class="error-form" id="error-' + (counter) + '"></div></div>'); //Add field html
          counter++;
        });
      });
    } else if (d == "multiple") {
      document.getElementById('textreponse').style.display = "none";
      document.getElementById('question-button').style.marginLeft = "480px";
      document.getElementById('question-button').style.top = "200px";
      document.getElementById('question-button').style.display = "block";
      $(document).ready(function() {
        var counter = 0; //Input fields increment limitation
        var addButton = $('#question-button'); //Add button selector
        var wrapper = $('#apparait'); //Input field wrapper
        //Once add button is clicked
        $(addButton).click(function() {
          $(wrapper).append('<br><div><label for="">Réponse </label><input type="text" id="lab-4" name="reponse[]" error="error-' + (counter) + '" /><input type="checkbox" value="on" name="multiplechoix' + (counter) + '"><button class="remove_button"><img src="../assets/supprimer.png"/></button><div class="error-form" id="error-' + (counter) + '"></div></div>'); //Add field html
          counter++;
        });

      });
    }
    //Once remove button is clicked
    $('#apparait').on('click', '.remove_button', function(e) {
      e.preventDefault();
      $(this).parent('div').remove(); //Remove field html
      counter--; //Decrement field counter
    });
  }
  const inputs = document.getElementsByTagName("input");
  for (input of inputs) {
    input.addEventListener("keyup", function(e) {
      if (e.target.hasAttribute("error")) {
        var idDivError = e.target.getAttribute("error");
        document.getElementById(idDivError).innerText = ""
      }
    })
  }

  document.getElementById("mon-form").addEventListener("submit", function(e) {
    const inputs = document.getElementsByTagName("input");
    var error = false;
    for (input of inputs) {
      if (input.hasAttribute("error")) {
        var idDivError = input.getAttribute("error");
        if (!input.value) {
          document.getElementById(idDivError).innerText = "Veuillez remplire ce champ"
          error = true;
        }
      }
    }
    if (error) {
      e.preventDefault();
      return false;
    }
  })
</script>