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
                foreach ($array as $key => $value) {
                ?>
                    <tr>
                        <?php
                        echo '<td>' . $value->prenom . '</td>';
                        echo '<td>' . $value->nom . '</td>';
                        echo '<td>' . $value->score . ' pts</td>';
                        ?>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>