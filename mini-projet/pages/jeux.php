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
            <a href="accueil.php?sortir" class="btn">Deconnexion</a>
        </div><br><br>
        <div class="contain-jeux">
            <div class="question-gauche">
                <div class="titre-question">
                    <p id="kaw">Questions 1/5</p>
                    <p>Les langages web</p>
                </div>
                <div id="point">
                    <p>3 pts</p>
                </div>
                <div class="question">
                    <p class="webjeux">
                        <input type="checkbox" name="html">Html<br>
                        <input type="checkbox" name="rr">R<br>
                        <input type="checkbox" name="java">Java
                    </p>
                </div>
                <button class="btn-pre">Précédent</button>
                <button class="btn-suit">Suivant</button>
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
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Prenom</th>
                                <th>Nom</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($array as $key => $value) {
                            ?>
                                <tr>
                                    <?php
                                    echo '<td>' . $value->prenom . '</td>';
                                    echo '<td>' . $value->nom . '</td>';
                                    echo '<td >' . $value->score . ' pts</td>';
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
                </div>
            </div>
        </div>
        <?php
        if (isset($_GET['sortir'])) {

            session_destroy();
            header("location: ../index.php");
        }
        ?>


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