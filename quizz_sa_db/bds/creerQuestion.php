<?php
include('../includes/fonctions.php');
global $pdo;

$question = $_POST['question'];
$nbreDePoint = $_POST['point'];
$type = $_POST['type'];
$bonneReponse;
$repText = $_POST['reptxt'];
$tabDesReponses = $_POST['reponse'];
if ($type == 'text') {
  $bonneReponse = $repText;
} elseif ($type == 'simple') {
  for ($i = 0; $i < count($tabDesReponses); $i++) {
    if (!empty($_POST['simplechoix' . $i])) {
      $bonneReponse[] = $tabDesReponses[$i];
    }
  }
  $simple[] = $bonneReponse;
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



if ($nbreDePoint < 5) {
  echo 'superieur';
} elseif (empty($bonneReponse)) {
  echo 'reponse';
} elseif ($type == 'simple' && sizeof(explode(';', $bonneReponse)) > 1) {
  echo 'seule';
} else {
  $dataQuestion = [
    "question" => $question,
    'score' => $nbreDePoint,
    "type" => $type,
    "tous" => $tabDesReponses,
    "bonne" => $bonneReponse
  ];

  $sql = 'insert into `bd_quizz_sa`.`questions` (`id`, `question`, `score`, `type`, `tous`, `bonne`) VALUES (NULL, " ' . $question . ' ", "' . $nbreDePoint . '", "' . $type . '", " ' . $tabDesReponses . ' ", "' . $bonneReponse . '");';
  $pdo->query($sql);
  echo 'ajouter';
}
