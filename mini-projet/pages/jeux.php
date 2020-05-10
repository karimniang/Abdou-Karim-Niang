<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quizz S.A</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
  <?php
  session_start();
  if (!isset($_SESSION['name']) && !isset($_SESSION['lastname'])) {
    header("location: ../index.php");
    exit();
  }
  ?>
  <nav id="header">
    <img src="../assets/logo-QuizzSA.png" class="logo" alt="">
    <h2>Le plaisir de jouer</h2>
  </nav>
  <form action="" method="POST" class="box">
    <div class="contain">
      <div class="user">
        <img src="<?php echo $_SESSION['image'] ?>" class="avatar" alt="avatar">
        <h6><?php echo $_SESSION['name'] . ' ' . $_SESSION['lastname'] ?></h6>
      </div>
      <div class="titre">
        <h3>BIENVENUE SUR LA PLATFORME DE JEU DE QUIZZ <br> JOUER ET TESTER VOTRE NIVEAU DE CULTURE GENERALE</h3>
      </div>
      <a href="jeux.php?sortir" class="btn">Deconnexion</a>
    </div><br><br>
    <?php
    if (isset($_GET['sortir'])) {
      session_destroy();
      header("location: ../index.php");
    }
    ?>
    <div class="contain-jeux">
      <div class="question-gauche">
        <?php

        $pre = 'block';
        $sui = 'block';
        $term = 'none';
        $question = 'block';
        if (isset($_GET['link'])) {
          if ($_GET['link'] == 'result') {
            require_once("./resultat.php");
            $question = 'none';
            $pre = 'none';
            $sui = 'none';
            $term = 'none';
          }
        }
        $_SESSION['tabQuestion'] = [];
        $essai = [];
        $repFile = '../repondu.json';
        $repData = file_get_contents($repFile);
        $repObj = json_decode($repData);
        foreach ($repObj as $kk => $vv) {
          $logs[] = $vv->user;
        }
        foreach ($repObj as $key => $value) {
          if (in_array($_SESSION['login'], $logs)) {
            if ($value->user === $_SESSION['login']) {
              for ($l = 0; $l < count($value->repondu); $l++) {
                for ($m = 0; $m < count($_SESSION['mesquestions']); $m++) {
                  if (!in_array($_SESSION['mesquestions'][$m]->question, $value->repondu)) {
                    array_push($essai, $_SESSION['mesquestions'][$m]);
                  }
                }
              }
            }
          } else {
            $essai = $_SESSION['mesquestions'];
          }
        }

        for ($i = 0; $i < $_SESSION['nombreParJeu']; $i++) {
          array_push($_SESSION['tabQuestion'], $essai[$i]);
        }

        $elementParPages = 1;
        $nombreDePage = ceil(sizeof($_SESSION['tabQuestion']) / $elementParPages);


        if (isset($_POST['suiv'])) {
          if (isset($_POST['position'])) {
            $position = intval($_POST['position']);
            $_SESSION['tabQuestion'][$position]->answer = answerplayer($position);
            $position++;
            if ($position == $_SESSION['nombreParJeu']) {
              $sui = 'none';
              $term = 'block';
              $position = $_SESSION['nombreParJeu'] - 1;
              $point =  monscore($_SESSION['tabQuestion']);

              //Mettre à jour le score du joueur
              $file = '../file.json';
              $data = file_get_contents($file);
              $obj = json_decode($data);
              foreach ($obj as $key => $value) {
                if ($value->user === $_SESSION['login']) {
                  if ($value->score < $point) {
                    $value->score = $point;
                  }
                }
              }
              $newdata = json_encode($obj);
              file_put_contents($file, $newdata);

              // ajouter les questions déja répondu
              $mesReponses = monresult($_SESSION['tabQuestion']);
              $repFile = '../repondu.json';
              $repData = file_get_contents($repFile);
              $repObj = json_decode($repData);
              if (in_array($_SESSION['login'], $logs)) {
                foreach ($repObj as $key => $value) {
                  for ($p = 0; $p < count($mesReponses); $p++) {
                    if (!in_array($mesReponses[$p], $value->repondu)) {
                      array_push($value->repondu, $mesReponses[$p]);
                    }
                  }
                }
                $newRepData = json_encode($repObj);
                file_put_contents($repFile, $newRepData);
              } else {
                $dejaRepondu = [
                  "user" => $_SESSION['login'],
                  "repondu" => $mesReponses
                ];
                array_push($repObj, $dejaRepondu);
                $newRepData = json_encode($repObj);
                file_put_contents($repFile, $newRepData);
              }
            }
          }
        } else {
          $position = 0;
        }
        $debut = ($position - 1) * $elementParPages;
        if (isset($_POST['prev'])) {
          $position = intval($_POST['position']);
          if ($position) {
            $position--;
            if ($position < 0) {
              $position = 0;
            }
          }
        }
        function answerplayer($i)
        {
          $answerplayer = array();
          if (!empty($_POST['result'])) {
            $answerplayer = $_POST['result'];
            $i++;
          }
          return $answerplayer;
        }
        function monscore($question)
        {
          $score = 0;
          $cocher = [];
          $multiple = [];
          $text = [];
          for ($i = 0; $i < count($question); $i++) {
            if ($question[$i]->type == 'multiple') {
              for ($j = 0; $j < count($question[$i]->tous); $j++) {
                if (!empty($question[$i]->answer) && in_array('result' . $j, $question[$i]->answer)) {
                  $multiple[] = $question[$i]->tous[$j];
                }
              }
              if ($multiple === $question[$i]->bonne) {
                $score +=  $question[$i]->score;
              }
              $multiple = [];
            } elseif ($question[$i]->type == 'simple') {
              for ($j = 0; $j < count($question[$i]->tous); $j++) {
                if ((!empty($question[$i]->answer)) && (in_array($j, $question[$i]->answer))) {
                  $cocher[] = $question[$i]->tous[$j];
                }
              }
              if ($cocher === $question[$i]->bonne) {

                $score += $question[$i]->score;
              }
              $cocher = [];
            } elseif ($question[$i]->type == 'text') {
              if (!empty($question[$i]->answer)) {
                $text[] = $question[$i]->answer;
              }
              if ($text === $question[$i]->bonne) {
                $score +=  $question[$i]->score;
              }
              $text = [];
            }
          }
          return $score;
        }
        function monresult($question)
        {
          $repondu = [];
          $cocher = [];
          $multiple = [];
          $text = [];
          for ($i = 0; $i < count($question); $i++) {
            if ($question[$i]->type == 'multiple') {
              for ($j = 0; $j < count($question[$i]->tous); $j++) {
                if (!empty($question[$i]->answer) && in_array('result' . $j, $question[$i]->answer)) {
                  $multiple[] = $question[$i]->tous[$j];
                }
              }
              if ($multiple === $question[$i]->bonne) {
                array_push($repondu, $question[$i]->question);
              }
              $multiple = [];
            } elseif ($question[$i]->type == 'simple') {
              for ($j = 0; $j < count($question[$i]->tous); $j++) {
                if ((!empty($question[$i]->answer)) && (in_array($j, $question[$i]->answer))) {
                  $cocher[] = $question[$i]->tous[$j];
                }
              }
              if ($cocher === $question[$i]->bonne) {
                array_push($repondu, $question[$i]->question);
              }
              $cocher = [];
            } elseif ($question[$i]->type == 'text') {
              if (!empty($question[$i]->answer)) {
                $text[] = $question[$i]->answer;
              }
              if ($text === $question[$i]->bonne) {
                array_push($repondu, $question[$i]->question);
              }
              $text = [];
            }
          }
          return $repondu;
        }

        ?>
        <input type="hidden" value="<?php echo $_SESSION['nombreParJeu']; ?>" id="limit">
        <input type="hidden" value="<?php echo $_SESSION['tabQuestion'][$position]->type; ?>" id="type">
        <input type="hidden" name="position" value="<?php echo $position; ?>" id="position">
        <div style="display: <?php echo $question; ?>">
          <?php
          for ($i = $debut; $i < ($debut + $elementParPages); $i++) {
          ?>
            <div class="titre-question">
              <p id="kaw">Questions <?php echo $position + 1 . '/' . sizeof($_SESSION['tabQuestion']) ?></p>
              <p><?php echo $_SESSION['tabQuestion'][$position]->question ?></p>
            </div>
            <div id="point">
              <p><?php echo $_SESSION['tabQuestion'][$position]->score . 'pts ?' ?></p>
            </div>
            <div>
              <p class="webjeux">
                <?php
                if ($_SESSION['tabQuestion'][$position]->type == "multiple") {
                  for ($j = 0; $j < count($_SESSION['tabQuestion'][$position]->tous); $j++) {
                    if (!empty($_SESSION['tabQuestion'][$position]->answer) && in_array('result' . $j, $_SESSION['tabQuestion'][$position]->answer)) {
                      echo  '<input type="checkbox" checked name="result[]" value="result' . $j . '">' . $_SESSION['tabQuestion'][$position]->tous[$j] . '<br>';
                    } else {
                      echo  '<input type="checkbox" name="result[]" value="result' . $j . '">' . $_SESSION['tabQuestion'][$position]->tous[$j] . '<br>';
                    }
                  }
                } elseif ($_SESSION['tabQuestion'][$position]->type == "simple") {
                  for ($j = 0; $j < count($_SESSION['tabQuestion'][$position]->tous); $j++) {
                    if (!empty($_SESSION['tabQuestion'][$position]->answer) && in_array($j, $_SESSION['tabQuestion'][$position]->answer)) {
                      echo  '<input type="radio" checked name="result[]" value="' . $j . '">' . $_SESSION['tabQuestion'][$position]->tous[$j] . '<br>';
                    } else {
                      echo  '<input type="radio" name="result[]" value="' . $j . '">' . $_SESSION['tabQuestion'][$position]->tous[$j] . '<br>';
                    }
                  }
                } elseif ($_SESSION['tabQuestion'][$position]->type == "text") {
                  if (!empty($_SESSION['tabQuestion'][$position]->answer)) {
                    echo  '<input type="text" name="result" value="' . $_SESSION['tabQuestion'][$position]->answer . '"><br>';
                  } else {
                    echo  '<input type="text" name="result"><br>';
                  }
                }
                ?>
              </p>
            </div>

          <?php
          }
          ?>
        </div>

      </div>
      <div class="pagine">
        <button name="prev" type="submit" class="btn-pre" style="display:<?php echo $pre; ?>">Page précédente</button>
        <button name="suiv" type="submit" class="btn-suit" style="display:<?php echo $sui; ?>">Page suivante</button>
        <button name="term" class="sui-noor" style="display:<?php echo $term; ?>"><a href="jeux.php?link=result">Terminer</a></button>
      </div>


      <div class="score">
        <div class="tab">
          <button type="button" class="tablinks" onclick="openCity(event, 'top-score')" id="defaultOpen">Top Score</button>
          <button type="button" class="tablinks" onclick="openCity(event, 'meilleurScore')">Mon meilleur score</button>
        </div>
        <div id="top-score" class="tabcontent">
          <?php
          $file = '../file.json';
          $data = file_get_contents($file);
          $array = json_decode($data);
          $pt = "pts";
          function sortByScore($a, $b)
          {
            $a = $a->score;
            $b = $b->score;
            if ($a == $b) {
              return 0;
            }
            return ($a > $b) ? -1 : 1;
          }
          usort($array, "sortByScore");
          $classe;
          foreach ($array as $key => $value) {
            if ($value->profil == 'user') {
              $tab[] = $value;
            }
          }
          $_SESSION['tab'] = $tab;
          ?>
          <table style="width: 90%">
            <thead>
              <tr>
                <th>Prenom</th>
                <th>Nom</th>
                <th>Score</th>
              </tr>
            </thead>
            <tbody>

              <?php
              for ($i = 0; $i <= 4; $i++) {
                if ($_SESSION['tab'][$i]->score < 50) {
                  $classe = 'dessous1';
                } elseif (($_SESSION['tab'][$i]->score >= 50) && ($_SESSION['tab'][$i]->score < 100)) {
                  $classe = 'dessous2';
                } else {
                  $classe = 'dessous3';
                }
              ?>
                <tr>
                  <?php
                  echo '<td align="center">' . $_SESSION['tab'][$i]->prenom . '</td>';
                  echo '<td align="center">' .  $_SESSION['tab'][$i]->nom . '</td>';
                  echo '<td align="center">' . $_SESSION['tab'][$i]->score . ' pts <div class=' . $classe . '></div> </td>';

                  ?>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
        <div id="meilleurScore" class="tabcontent">
          <h2>Meilleur</h2>
          <p>Mes scores</p>
          <table style="width: 90%">
            <?php
            for ($i = 0; $i < count($_SESSION['tab']); $i++) {
              if ($_SESSION['tab'][$i]->user === $_SESSION['login']) {
            ?>
                <tr>
                  <?php

                  echo '<td align="center">' . $_SESSION['tab'][$i]->prenom . '</td>';
                  echo '<td align="center">' . $_SESSION['tab'][$i]->nom . '</td>';
                  echo '<td align="center">' . $_SESSION['tab'][$i]->score . ' pts</td>';
                  ?>
                </tr>
            <?php
              }
            }
            ?>
          </table>
        </div>
      </div>
    </div>



  </form>
  <script>
    function openCity(evt, affiche) {
      // Declarer tous les variables
      var i, tabcontent, tablinks;

      // Prendre les elements avec class="tabcontent" 
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }

      // Prendre les elements avec class="tablinks" et supprime la class "active"
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace("active", "");
      }

      // Voir le tab courrat, et ajouter une classe "active" au button qui ouvre le tab
      document.getElementById(affiche).style.display = "block";
      evt.currentTarget.className += "active";
    }
    // obtenir l'élèment avec l'id="defaultOpen"
    document.getElementById("defaultOpen").click();
  </script>
</body>

</html>