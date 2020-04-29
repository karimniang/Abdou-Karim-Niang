<div class="contantt">
  <div class="li-titre">
    <p>Nbre de questions/jeu</p>
    <input type="text" name="nombre" class="nombre">
    <button name="ok" class="btn-ok">OK</button>
  </div>
  <form action="" method="POST">
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

      $nombreDePage = ceil(sizeof($tabQuestion) / 5);
      if (!isset($_GET['page'])) {
        $page = 1;
      } else {
        $page = intval($_GET['page']);
      }
      $min = ($page - 1) * 5;
      $max = $min + 5;
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
                foreach ($_SESSION['tabQuestion'][$i]->autre as $key => $value) {

                  echo '<input type="checkbox" name="">' . $value . '<br>';
                }
                foreach ($_SESSION['tabQuestion'][$i]->bonne as $key => $value) {

                  echo '<input type="checkbox" name="" checked>' . $value . '<br>';
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
                foreach ($_SESSION['tabQuestion'][$i]->autre as $key => $value) {

                  echo '<input type="radio" name="">' . $value . '<br>';
                }
                foreach ($_SESSION['tabQuestion'][$i]->bonne as $key => $value) {

                  echo '<input type="radio" name="" checked>' . $value . '<br>';
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
      <button class="pre-noor" style="display:<?php echo $pre; ?>"><a href="accueil.php?lock=question&page=<?php echo $page - 1; ?>">Page précédente</a></button>

      <button class="sui-noor" style="display:<?php echo $sui; ?>"><a href="accueil.php?lock=question&page=<?php echo $page + 1; ?>">Page suivante</a></button>
    </div>
  </form>
</div>