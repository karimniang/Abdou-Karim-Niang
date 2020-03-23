<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
#style-tableau{
    background-color: blueviolet;
}
.container{
    align-content: center;
    width: 50%;
    margin-left: auto;
    margin-right: auto;
   text-align: center;
}
#tableau{
    background-color: blue;
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Veuillez choisir votre langue</h1>
    <form method="POST"action="">
        <select name="choix" id="choix-id">
            <option value="fr"> Français </option>
            <option value="ang"> Anglais </option>
            <option value="aucun"> Aucun </option>
        </select><br></br>
        <input type="submit" name="submit" value="Envoyer"><br><br>
</form>
<?php

$Langue =[
    
    'fr' => ['Janvier','Fevrier','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Décembre'],
    'ang' => ['January','February','Marche','April','May','June','Juley','August','September','October','November','Décember']
];
    
if(isset($_POST['submit'])){
    
    if($_POST['choix'] == "fr") {
        echo '<table>';
        $m=0;
        for ($i=0; $i <=3; $i++) { 
            echo '<tr id="style-tableau">';
            for ($j=0; $j <=5 ; $j++) { 
                if (($j%2)!=0) {
                    echo '<td id= "tableau">'.$Langue["fr"][$m].'</td>';
                    $m=$m+1;
                }else {
                    echo '<td>';
                    echo $m+1;
                    echo '</td>';
                }
            }
            echo '</tr>';
        }
        echo  '</table>';

    } elseif ($_POST['choix']== "ang"){
        echo '<table>';
        $m=0;
        for ($i=0; $i <=3; $i++) { 
            echo '<tr id= "style-tableau">';
            for ($j=0; $j <=5 ; $j++) { 
                if (($j%2)!=0) {
                    echo '<td id="tableau">'.$Langue["ang"][$m].'</td>';
                    $m=$m+1;
                }else {
                    echo '<td>';
                    echo $m+1;
                    echo '</td>';
                }
            }
            echo '</tr>';
        }
        echo  '</table>';

    }else {
        echo 'Ce choix n\'existe pas !!';
    }
         
}
?>
    </div>
</body>
</html>