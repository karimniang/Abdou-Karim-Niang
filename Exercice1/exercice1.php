<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice 1</title>
</head>
<body>
<form method="POST" action="">
<?php
if(isset($_POST['val']) and preg_match("/^[0-9]+/",$_POST['val']) ){
    if($_POST['val']> 10000 ){
        ?>
        Entrée: <input name="val" id="input-val" class="btn btn-primary" type="text" value="<?php echo $_POST['val'] ?>">
    <?php
    }else{
        ?>
        Entrée: <input type="text" name="val">
        <?php
    }}else{
        ?>
        Entrée: <input type="text" name="val">
        <?php
    }
   
    ?>
    <input type="submit" name="submit" value="Envoyer">  <br> <br>
</form>
<?php
session_start();
if(!empty($_POST)){
    $val=$_POST['val'];
    $c=array();
    $a=0;
    $b=0;
    $T= [
        'nombreInf' => [],
        'nombreSup' => []
    ];
    $nbrinf=0;
    $nbrsup=0;
    if($val>10000){
        for($i=2;$i<=$val;$i++){
            $j=2;
            while(($i%$j)!=0){
            $j=$j+1;
            }
            if($i==$j){
            $c[]=$i;
            $b=$b+$i;
            $a++;
            }
        }
        $moy=$b/$i;
        echo 'La moyenne est '.$moy.'</br>';
        for ($l=0; $l <count($c) ; $l++) { 
        if ($c[$l]<$moy) {
        $nbrsup++;
        }elseif ($c[$l]>$moy) {
        $nbrinf++;
        }
    }
    foreach ($c as $value) {
        if ($value<$moy) {
            array_push($T['nombreInf'],$value);
        }elseif ($value>$moy) {
            array_push($T['nombreSup'],$value);
        }
    }
}
echo 'Les valeurs avant la moyenne sont '.$nbrsup.'</br>';
echo 'Les valeurs aprés la moyenne sont '.$nbrinf.'</br>';
$_SESSION['nbrInf'] = $T['nombreInf'];
$_SESSION['nbrSup'] = $T['nombreSup'];
}
    
$messagesParPage=100; //Nous allons afficher 100 messages par page.
//Une connexion doit être ouverte avant cette ligne...
$retour_total=count($_SESSION['nbrInf']); //Nous récupérons le contenu de la requête dans $retour_total
 
//Nous allons maintenant compter le nombre de pages.
$nombreDePages=ceil($retour_total/$messagesParPage);
 
if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
{
     $pageActuelle=intval($_GET['page']);
 
     if($pageActuelle>$nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
     {
          $pageActuelle=$nombreDePages;
     }
}
else // Sinon
{
     $pageActuelle=1; // La page actuelle est la n°1    
}
 
$premiereEntree=($pageActuelle-1)*$messagesParPage; // On calcule la première entrée à lire

// La requête pour récupérer les messages de la page actuelle.
echo '<div align="left">';
echo '<table border=1 id="table1"> <th>tableau inferieur</th> <tr>';
for ($i=$premiereEntree; $i < $pageActuelle*$messagesParPage; $i++) { 
    if ($i>$retour_total) {
    break;
    }
    else{
        if (($i!= $premiereEntree) && ($i%10 ==0) ) {
            echo"</tr> <br> <tr>";
        }
        echo '<td>'.$_SESSION['nbrInf'][$i].'</td>';
    }
}
echo '</tr> </table> <div>';
 
echo '<p align="left">Page : '; //Pour l'affichage, on centre la liste des pages
for($i=1; $i<=$nombreDePages; $i++) //On fait notre boucle
{
     //On va faire notre condition
     if($i==$pageActuelle) //S'il s'agit de la page actuelle...
     {
         echo ' [ '.$i.' ] '; 
     }    
     else //Sinon...
     {
          echo ' <a href="exercice1.php?page='.$i.'">'.$i.'</a> ';
     }
}

 
    
$messagesParPage_1 =100; //Nous allons afficher 100 messages par page.
 
//Une connexion SQL doit être ouverte avant cette ligne...
$retour_total_1 =count($_SESSION['nbrSup']); //Nous récupérons le contenu de la requête dans $retour_total
 
//Nous allons maintenant compter le nombre de pages.
$nombreDePages_1 =ceil($retour_total_1/$messagesParPage_1);
 
if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
{
     $pageActuelle_1=intval($_GET['page']);
 
     if($pageActuelle_1>$nombreDePages_1) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
     {
          $pageActuelle_1=$nombreDePages_1;
     }
}
else // Sinon
{
     $pageActuelle_1 =1; // La page actuelle est la n°1    
}
 
$premiereEntree_1=($pageActuelle_1-1)*$messagesParPage_1; // On calcule la première entrée à lire
 
// La requête pour récupérer les messages de la page actuelle.
echo '<div align="right">';
echo '<table border=1 id="table1"> <th>tableau superieur</th> <tr>';
for ($i=$premiereEntree_1; $i < $pageActuelle_1*$messagesParPage_1; $i++) { 
    if ($i>$retour_total_1) {
    break;
    }
    else{
        if (($i!= $premiereEntree_1) && ($i%10 ==0) ) {
            echo"</tr> <br> <tr>";
        }
        echo '<td>'.$_SESSION['nbrSup'][$i].'</td>';
    }
}
echo '</tr> </table> <div>';
 
echo '<p align="right">Page : '; //Pour l'affichage, on centre la liste des pages
for($i=1; $i<=$nombreDePages_1; $i++) //On fait notre boucle
{
     //On va faire notre condition
     if($i==$pageActuelle_1) //S'il s'agit de la page actuelle...
     {
         echo ' [ '.$i.' ] '; 
     }    
     else //Sinon...
     {
          echo ' <a href="exercice1.php?page='.$i.'">'.$i.'</a> ';
     }
}

?>
</body>
</html>