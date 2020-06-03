<div class="contant">
  <div class="lister-question">
    <?php
    $dataQuestions = getQuestion();

    for ($i = 0; $i < count($dataQuestions); $i++) {
      $dataQuestions[$i]['bonne'] = explode(";", $dataQuestions[$i]['bonne']);
      $dataQuestions[$i]['tous'] = explode(";", $dataQuestions[$i]['tous']);
    }
    var_dump($dataQuestions);
    ?>
  </div>
</div>