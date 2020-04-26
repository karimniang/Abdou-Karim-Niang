<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="contantt">
    <form action="" method="POST" id="form-dynamic">
        <h2>PARAMETRER VOTRE QUESTION</h2>
        <div class="creer">
            <div class="laquestion">
                <label for="question">Questions</label>
                <input type="text" name="question" id="lab-1">
            </div>
            <div class="laquestion">
                <label for="point">Nbre de Points</label>
                <input type="number" name="point" id="lab-2">
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
if (isset($_POST['enregistrer'])) {
    $question = $_POST['question'];
    $nbreDePoint = $_POST['point'];
    $type = $_POST['choice'];
    $bonneReponse = [];
    $tabDesReponses = $_POST['reponse'];
    if (empty($question)) {
        echo 'Veuillez remplir la question';
    } elseif (empty($nbreDePoint)) {
        echo 'Veuillez donnez le nombre de point';
    } elseif ($nbreDePoint < 1) {
        echo 'Le nombre de point doit etre superieur à 1';
    } elseif (empty($tabDesReponses)) {
        echo 'Veuillez remplir la(les) réponse(s)';
    } else {
        if ($type == 'text') {
            array_push($bonneReponse, $tabDesReponses);
            $dataQuestion = [
                "question" => $question,
                "score" => $nbreDePoint,
                "type" => $type,
                "bonne-reponse" => $bonneReponse
            ];
            $file = '../question.json';
            $data = file_get_contents($file);
            $obj = json_decode($data);
            array_push($obj, $dataQuestion);
            $jsonData = json_encode($obj);
            file_put_contents($file, $jsonData);
            echo 'Votre Question a été ajouté';
        } elseif ($type == 'simple') {
            for ($i = 0; $i < count($tabDesReponses); $i++) {
                if (!empty($_POST['simplechoix'][$i])) {
                    array_push($bonneReponse, $tabDesReponses[$i]);
                    $dataQuestion = [
                        "question" => $question,
                        "score" => $nbreDePoint,
                        "type" => $type,
                        "bonne-reponse" => $bonneReponse,
                        "tous-les-reponse" => $tabDesReponses
                    ];
                    $file = '../question.json';
                    $data = file_get_contents($file);
                    $obj = json_decode($data);
                    array_push($obj, $dataQuestion);
                    $jsonData = json_encode($obj);
                    file_put_contents($file, $jsonData);
                    echo 'Votre Question a été ajouté';
                }
            }
        } elseif ($type == 'multiple') {
            for ($i = 0; $i < count($tabDesReponses); $i++) {
                if (!empty($_POST['multiplechoix' . $i])) {
                    array_push($bonneReponse, $tabDesReponses[$i]);
                    $dataQuestion = [
                        "question" => $question,
                        "score" => $nbreDePoint,
                        "type" => $type,
                        "bonne-reponse" => $bonneReponse,
                        "tous-les-reponse" => $tabDesReponses
                    ];
                    $file = '../question.json';
                    $data = file_get_contents($file);
                    $obj = json_decode($data);
                    array_push($obj, $dataQuestion);
                    $jsonData = json_encode($obj);
                    file_put_contents($file, $jsonData);
                    echo 'Votre Question a été ajouté';
                }
            }
        }
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
                    $(wrapper).append('<br><div><label for="">Réponse </label><input type="text" id="lab-4" name="reponse[]" /><input type="radio" name="simplechoix[' + (counter) + ']"><button class="remove_button"><img src="../assets/supprimer.png"/></button></div>'); //Add field html
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
                    $(wrapper).append('<br><div><label for="">Réponse </label><input type="text" id="lab-4" name="reponse[]" /><input type="checkbox" value="on" name="multiplechoix' + (counter) + '"><button class="remove_button"><img src="../assets/supprimer.png"/></button></div>'); //Add field html
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
</script>