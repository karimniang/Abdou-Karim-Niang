<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document-4</title>
    <style>
        .container{
            align-content: center;
            text-align: center;
        }
        #btn{
            background-color: greenyellow;
        }
    </style>
</head>
<body>
    <form method="POST" action="" class="container">
    <label for="text"> Entrer les phrases. </label><br><br>
    <textarea name="text" id="text" cols="70" rows="10"> <?= @$_POST['text']?> </textarea><br><br>
    <input type="submit" id="btn" name ="submit" value="Envoyer"><br><br>
   
    <?php
    if (isset($_POST['submit'])) {
        $texte=$_POST['text'];
        $phrasErreur = [];
        $texte = textlower($texte);
        $newTexte = decouper($texte);
        foreach ($newTexte as $value) {
            if (monstrlen($value) >200 ) {
                $phrasErreur[]= 'la phrase '.($key+1).' dépasse les 200 caractères';
            }
        }
        if (empty($phrasErreur)) {
            echo '<textarea cols="70" rows="10">';
            foreach ($newTexte as $value) {
                for ($i=0; $i < monstrlen($value) ; $i++) { 
                    $value[0]= car_upper($value[0]);
                }
                echo $value ;
            }
            echo '</textarea>';
        }else {
            foreach ($phrasErreur as $val) {
                echo '<h4> '.$val.' <h4>';
            }
        }
        
        

    }

    // Fonctions utilisées
    // Retourne la taille
    function monstrlen($chaine){
        $i=0;
        while(isset($chaine[$i])) $i++;
        return $i;
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
    // Metttre un texte en minuscule
    function textlower($chaine){
        for ($i=0; $i < monstrlen($chaine) ; $i++) { 
            $chaine[$i] = car_lower($chaine[$i]);
        } return $chaine;
    }
    // Decouper un texte et réparer les espaces...
    function decouper($chaine){
        $reg = '#[A-z0-9][^.!?]+[.!?]*#';
        if (preg_match_all($reg,$chaine,$result)) {
            foreach ($result as $newChaine) {
                for ($i=0; $i < monstrlen($newChaine) ; $i++){
                    $newChaine[$i] = preg_replace('/\s\s+/',' ', $newChaine[$i]);
                    for ($j=0; $j < monstrlen($newChaine[$i]) ; $j++) { 
                        if (($newChaine[$i][$j] == "'") && (($newChaine[$i][$j+1] == " ") || ($newChaine[$i][$j-1] == " "))) {  
                            $newChaine[$i][$j+1] = null;
                            $newChaine[$i][$j-1] = null;
                        }elseif ((($newChaine[$i][$j] == ",") || ($newChaine[$i][$j] == ";")) && ($newChaine[$i][$j-1] == " ")) {
                            $newChaine[$i][$j-1] = null;
                        }
                    }
                }
                return $newChaine;
            }
        }
    }
    ?>
     </form>
</body>
</html>