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

        $nombreDePage = ceil(sizeof($tab) / 5);
        if (isset($_GET['page'])) {
            $page = intval($_GET['page']);
            if ($page > $nombreDePage) {
                $page = $nombreDePage;
            }
        } else {
            $page = 1;
        }

        $min = ($page - 1) * 5;
        $max = $min + 5;

        ?>
        <div class="pagine">
            <?php
            for ($i = 1; $i <= $nombreDePage; $i++) {

                if ($i == $page) {
                    echo ' [ ' . $i . ' ] ';
                } else {
                    echo ' <a href="accueil.php?lock=joueurs&page=' . $i . '">' . $i . '</a> ';
                }
            }
            echo '</p>';
            ?>
        </div>
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
</div>