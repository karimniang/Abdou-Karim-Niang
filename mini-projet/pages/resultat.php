<body>


  <form action="" method="POST" class="box">

    <div>
      <div>
        <?php
        $resultat = '';
        $bonResult = '<img src="../assets/big-tick.jpg" alt="" id="my-result">';
        $mauvaisResult = '<img src="../assets/big-faux.png" alt="" id="my-result">';
        $coche = [];
        $simple = [];
        $texto = [];
        ?>
        <?php
        for ($i = 0; $i < count($_SESSION['tabQuestion']); $i++) {
          echo '<br>';
          echo '<div class="titrebi"><div>Question' . ($i + 1) . '/' . count($_SESSION['tabQuestion']) . '</div>' . $_SESSION['tabQuestion'][$i]->question . '</div><br>';
        ?>


          <?php
          if ($_SESSION['tabQuestion'][$i]->type == 'multiple') {
            for ($j = 0; $j < count($_SESSION['tabQuestion'][$i]->tous); $j++) {
              if (empty($_SESSION['tabQuestion'][$i]->answer)) {
                $resultat = $mauvaisResult;
              }
              if (isset($_SESSION['tabQuestion'][$i]->answer) && in_array('result' . $j, $_SESSION['tabQuestion'][$i]->answer)) {
                $coche[] = $_SESSION['tabQuestion'][$i]->tous[$j];
                if ($coche === $_SESSION['tabQuestion'][$i]->bonne) {
                  $resultat = $bonResult;
                } else {
                  $resultat = $mauvaisResult;
                }
                echo  '<input type="checkbox" checked  value="result' . $j . '">' . $_SESSION['tabQuestion'][$i]->tous[$j] . '<br>';
              } else {
                echo  '<input type="checkbox"  value="result' . $j . '">' . $_SESSION['tabQuestion'][$i]->tous[$j] . '<br>';
              }
            }
            $coche = [];
          } elseif ($_SESSION['tabQuestion'][$i]->type == 'simple') {
            for ($j = 0; $j < count($_SESSION['tabQuestion'][$i]->tous); $j++) {
              if (empty($_SESSION['tabQuestion'][$i]->answer)) {
                $resultat = $mauvaisResult;
              }
              if ((!empty($_SESSION['tabQuestion'][$i]->answer)) && (in_array($j, $_SESSION['tabQuestion'][$i]->answer))) {
                $simple[] = $_SESSION['tabQuestion'][$i]->tous[$j];
                if ($simple === $_SESSION['tabQuestion'][$i]->bonne) {
                  $resultat = $bonResult;
                } else {
                  $resultat = $mauvaisResult;
                }
                echo  '<input type="radio" checked  value="' . $j . '">' . $_SESSION['tabQuestion'][$i]->tous[$j] . '<br>';
              } else {
                echo  '<input type="radio"  value="' . $j . '">' . $_SESSION['tabQuestion'][$i]->tous[$j] . '<br>';
              }
            }
            $simple = [];
          } elseif ($_SESSION['tabQuestion'][$i]->type == 'text') {
            if (!empty($_SESSION['tabQuestion'][$i]->answer)) {
              $texto[] = $_SESSION['tabQuestion'][$i]->answer;
              if ($texto === $_SESSION['tabQuestion'][$i]->bonne) {
                $resultat = $bonResult;
              } else {
                $resultat = $mauvaisResult;
              }
              echo  '<input type="text" name="result" value="' . $_SESSION['tabQuestion'][$i]->answer . '"><br>';
            } else {
              echo  '<input type="text" name="result"><br>';
            }
            $texto = [];
          }
          ?>
          <div class="bon-result"> <?php echo $resultat; ?></div>
        <?php
        }
        ?>

      </div>
      <div class="pagine">
        <button name="retour" class="sui-noor">Retour</button>
      </div>
      <?php
      if (isset($_POST['retour'])) {
        header("location:jeux.php");
      }
      ?>
    </div>
  </form>
</body>

</html>