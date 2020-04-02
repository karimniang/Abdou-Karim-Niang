<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        h4{
            color: red;
        }
        .container{
            align-content: center;
            text-align: center;
        }
        #btn1{
            color: green;
        }
        #btn2{
            background-color:#00c300;
        }
    </style>
</head>
<body>
    <div class="container">
    <form method="post">
    <div>
    <label for="number">Entrer le nombre de mots</label>
    <input type="text" name="number" value="<?= @$_POST['number']?>" placeholder="Entrer un nombre" >
    <button id="btn1" name="submit" type="submit"> Envoyer </button></br><br>
    <?php
    if (isset($_POST['number'])) {
        for ($i=1; $i <= $_POST['number'] ; $i++) {?>
        <label for=""> <?='Mot '.$i?></label>
        <input type="text" name="mot[]" placeholder="<?= 'Entrer le mot '.$i?>" value="<?= @$_POST['mot'][$i-1]; ?>"></br></br>
        <?php } ?>
        <button name="resultat" id="btn2"> Resultat </button>
    <?php } ?>
    </div>
    </form>
    <?php
    $erreurs =[];
    $nbr = 0;
    $char = 'm';
    $N = monstrlen($_POST['mot']);
    if (isset($_POST['submit'])) {
        if (!numeric($_POST['number'] == true) || ($_POST['number']<=0)) {
            echo 'Entrer un numéro';
        }
    }
    if (isset($_POST['resultat'])) {
        foreach ($_POST['mot'] as $key => $mot) {
            $mot = delSpace($mot);
            if (monstrlen($mot) > 20) {
                $erreurs[] = 'Le mot '.($key+1).' dépasse les 20 caractères';
            }elseif (!is_valid($mot)) {
                $erreurs[] = 'Le mot '.($key+1).' est incorrecte (non alphabbétique, est numérique, contient des espaces)';
            }elseif ($mot === '') {
                $erreurs[] = 'Le mot '.($key+1).' est vide';
            }
        }
        if (empty($erreurs)) {
            foreach ($_POST['mot'] as $mot) {
                if (isInString($mot,$char)==true) {
                    $nbr++;
                }
            }
            echo 'Vous avez saisi '.$N.' mots dont '.$nbr.' avec la lettre M';
        }else {
            foreach ($erreurs as $err) {
                echo '<h4> '.$err.' <h4>';
            }
        }     
    }
    
    


    


    //...Fonctions utilisées
    // Taille d'un tableau ou d'une chaine de caractères
    function monstrlen($chaine){
        $i=0;
        while(isset($chaine[$i])) $i++;
        return $i;
    }
    // Vérifier si un caractère est alphabétique
    function alpha($char){
        return((($char >= 'a')||($char >= 'A')) && (($char <= 'z')||($char <= 'Z')));
    }
    // Vérifier si un mot est valide
    function is_valid($mot){
        for ($i=0; $i < monstrlen($mot) ; $i++) { 
            if (alpha($mot[$i])== true) {
                return true;
            }else {
                return false;
            }
        }
    }
    // Vérifier unn chiffre
    function chiffre($num){
       return ($num >= "0" && $num <= "9");
    }
    // Vérifier si un nombre est numérique
    function numeric($nbr){
        for ($i=0; $i < monstrlen($nbr) ; $i++) { 
            if (!chiffre($nbr[$i])) {
                return false;
            }
        }
        return true;
    }
    // Vérifier si un caractère est dans une chaine
    function isInString( $chaine,$char){
        for ($i=0 ; $i < monstrlen($chaine) ; $i++ ) { 
            if ($chaine[$i] == $char) {
                return true;  
            }
        } return false;
    }
    // Supprimer les espaces au debut et à la fin d'une chaine
    function delSpace($chaine){
        $new ='';
        for ($i=0; $i < monstrlen($chaine) ; $i++) { 
            if ($chaine[$i] != ' ') {
                $new .= $chaine[$i];
            }
        } return $new;
    }
    // Mettre un caractére en minuscule
    function car_lower($char){
        $tab=['a'=>'A','b'=>'B','c'=>'C','d'=>'D','e'=>'E','f'=>'F',
              'g'=>'G','h'=>'H','i'=>'I','j'=>'J','k'=>'K','l'=>'L',
              'm'=>'M','n'=>'N','o'=>'O','p'=>'P','q'=>'Q','r'=>'R',
              's'=>'S','t'=>'T','u'=>'U','v'=>'V','w'=>'W','x'=>'X',
              'y'=>'Y','z'=>'Z'];
              foreach ($tab as $key => $value) {
                  if ($char == $value) {
                      $char = $key;
                  }
              }return $char;
    }
    // Mettre un caractére en majuscule
    function car_upper($char){
        $tab=['a'=>'A','b'=>'B','c'=>'C','d'=>'D','e'=>'E','f'=>'F',
              'g'=>'G','h'=>'H','i'=>'I','j'=>'J','k'=>'K','l'=>'L',
              'm'=>'M','n'=>'N','o'=>'O','p'=>'P','q'=>'Q','r'=>'R',
              's'=>'S','t'=>'T','u'=>'U','v'=>'V','w'=>'W','x'=>'X',
              'y'=>'Y','z'=>'Z'];
              foreach ($tab as $key => $value) {
                  if ($char == $key) {
                      $char = $value;
                  }
              }return $char;
    }
    ?>
    </div>
</body>
</html>