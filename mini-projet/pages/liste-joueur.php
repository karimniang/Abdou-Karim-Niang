<div class="contantt">
  <div class="titre-joueur">
    <p>LISTE DES JOUEURS PAR SCORE</p>
  </div>
  <div class="affichage-joueur">
    <?php
    $file = '../file.json';
    $data = file_get_contents($file);
    $array = json_decode($data);
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
    foreach ($array as $key => $value) {
      $tab[] = $value;
    }
    $_SESSION['tab'] = $tab;
    $pre = 'block';
    $sui = 'block';

    $nombreDePage = ceil(sizeof($tab) / 5);
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
      $max = sizeof($tab);
      $sui = 'none';
    }

    ?>

    <table>
      <thead>
        <tr>
          <th class="titre-liste">Prenom</th>
          <th class="titre-liste">Nom</th>
          <th class="titre-liste">Score</th>
        </tr>
      </thead>
      <tbody class="nom-contain">
        <?php
        for ($i = $min; $i < $max; $i++) {
        ?>
          <tr>
            <?php
            echo '<td align="center">' . $_SESSION['tab'][$i]->prenom . '</td>';
            echo '<td align="center">' .  $_SESSION['tab'][$i]->nom . '</td>';
            echo '<td align="center">' . $_SESSION['tab'][$i]->score . ' pts</td>';

            ?>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
  <div class="pagine">
    <button class="pre-noor" style="display:<?php echo $pre; ?>"><a href="accueil.php?lock=joueurs&page=<?php echo $page - 1; ?>">Page précédente</a></button>

    <button class="sui-noor" style="display:<?php echo $sui; ?>"><a href="accueil.php?lock=joueurs&page=<?php echo $page + 1; ?>">Page suivante</a></button>
  </div>
</div>