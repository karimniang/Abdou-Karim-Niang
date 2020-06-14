<?php
include('../includes/fonctions.php');
global $pdo;
$rowid = $_POST['offset'];
$rowperpage = $_POST['limit'];

/* Selecting rows */
$query = "SELECT * FROM questions ORDER BY id LIMIT " . $rowid . "," . $rowperpage;

$result = $pdo->query($query);

$questions = array();
while ($row = $result->fetch()) {
    $id = $row['id'];
    $question = $row['question'];
    $score = $row['score'];
    $type = $row['type'];
    $tous = $row['tous'];
    $bonne = $row['bonne'];

    $questions[] = array("id" => $id, "question" => $question, "score" => $score, "type" => $type, "tous" => $tous, "bonne" => $bonne);
}
for ($i = 0; $i < count($questions); $i++) {
    $questions[$i]['bonne'] = explode(";", $questions[$i]['bonne']);
    $questions[$i]['tous'] = explode(";", $questions[$i]['tous']);
}
/* encoding array to json format */
echo json_encode($questions);
