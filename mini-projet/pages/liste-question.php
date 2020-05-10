<div class="contantt">
  <form action="" method="POST">
    <div class="li-titre">
      <p>Nbre de questions/jeu</p>
      <input type="text" name="nombre" error="error-1" value="<?= @$_SESSION['nombreParJeu'] ?>" class="nombre">
      <div class="error-form" id="error-1"></div>
      <button type="submit" name="ok" class="btn-ok">OK</button>
    </div>
    <?php
    if (isset($_POST['ok'])) {
      $qfile = '../modif.json';
      $qdata = file_get_contents($qfile);
      $arraymodif = json_decode($qdata);
      if (empty($_POST['nombre'])) {
        echo 'Veuillez entrer le nombre de questions par jeu';
      } elseif ($_POST['nombre'] < 5) {
        echo 'le nombre de question par jeu doit être superieur à 5';
      } else {
        $arraymodif->nombreParJeu = $_POST['nombre'];
        $jsondata = json_encode($arraymodif);
        file_put_contents($qfile, $jsondata);
        echo 'Vous avez fixé le nombre de question par jeu à ' . $_POST['nombre'];
      }
    }
    ?>
    <div class="contain-require">
      <?php
      $file = '../question.json';
      $data = file_get_contents($file);
      $arrayQuestion = json_decode($data);
      foreach ($arrayQuestion as $key => $value) {
        $tabQuestion[] = $value;
      }
      $_SESSION['tabQuestion'] = $tabQuestion;
      $pre = 'block';
      $sui = 'block';
      $elementParPages = 5;
      $nombreDePage = ceil(sizeof($tabQuestion) / $elementParPages);
      if (!isset($_GET['page'])) {
        $page = 1;
      } else {
        $page = intval($_GET['page']);
      }
      $min = ($page - 1) * $elementParPages;
      $max = $min + $elementParPages;
      if ($page <= 1) {
        $page = 1;
        $pre = 'none';
      } elseif ($page > $nombreDePage) {
        $page = $nombreDePage;
      }
      if ($page == $nombreDePage) {
        $max = sizeof($tabQuestion);
        $sui = 'none';
      }

      ?>
      <ol class="lister">
        <?php
        for ($i = $min; $i < $max; $i++) {
          if ($_SESSION['tabQuestion'][$i]->type == "multiple") {
        ?>
            <li value="<?php echo ($i + 1) ?>">
              <p><?php echo $_SESSION['tabQuestion'][$i]->question ?></p>
              <p class="web">
                <?php
                foreach ($_SESSION['tabQuestion'][$i]->tous as $key => $value) {
                  if (in_array($value, $_SESSION['tabQuestion'][$i]->bonne)) {
                    echo '<input type="checkbox" name="" checked>' . $value . '<br>';
                  } else {
                    echo '<input type="checkbox" name="">' . $value . '<br>';
                  }
                }
                ?>
              </p>
            </li>
          <?php
          } elseif ($_SESSION['tabQuestion'][$i]->type == "simple") {
          ?>
            <li value="<?php echo ($i + 1) ?>">
              <p><?php echo $_SESSION['tabQuestion'][$i]->question ?></p>
              <p class="web">
                <?php
                foreach ($_SESSION['tabQuestion'][$i]->tous as $key => $value) {
                  if (in_array($value, $_SESSION['tabQuestion'][$i]->bonne)) {
                    echo '<input type="radio" name="" checked>' . $value . '<br>';
                  } else {
                    echo '<input type="radio" name="">' . $value . '<br>';
                  }
                }
                ?>
              </p>
            </li>
          <?php
          } elseif ($_SESSION['tabQuestion'][$i]->type == "text") {
          ?>
            <li value="<?php echo ($i + 1) ?>">
              <p><?php echo $_SESSION['tabQuestion'][$i]->question ?></p>
              <p class="web">
                <?php
                foreach ($_SESSION['tabQuestion'][$i]->bonne as $key => $value) {
                  echo '<input type="text" value="' . $value . '" name=""><br>';
                }
                ?>
              </p>
            </li>
        <?php
          }
        }

        ?>
      </ol>
    </div><br>
    <div class="pagine">
      <button type="button" class="pre-noor" style="display:<?php echo $pre; ?>"><a href="accueil.php?lock=question&page=<?php echo $page - 1; ?>">Page précédente</a></button>

      <button type="button" class="sui-noor" style="display:<?php echo $sui; ?>"><a href="accueil.php?lock=question&page=<?php echo $page + 1; ?>">Page suivante</a></button>
    </div>
  </form>
</div>
<script>
  document.getElementById("mon-form").addEventListener("submit", function(e) {
    const inputs = document.getElementsByTagName("input");
    var error = false;
    for (input of inputs) {
      if (input.hasAttribute("error")) {
        var idDivError = input.getAttribute("error");
        if (!input.value) {
          document.getElementById(idDivError).innerText = "Veuillez remplire le nombre de question par jeu"
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