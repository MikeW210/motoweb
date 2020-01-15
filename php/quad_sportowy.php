<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>

    <title>MotoWeb</title>
    <link rel="stylesheet" href ="../css/maszyny.css">
    <link rel="stylesheet" href ="../css/sportowy.css">
</head>
<body>
<div class="calosc">
    <div class="row">
        <div class="logo">
            <img src="../imgs/logo.png"/>
        </div>
        <ul class="main-nav">
            <li><a href="../homepage.php">Home</a></li>
            <li><a href="../moto.php">Motocykle</a></li>
            <li><a href="../quad.php">Quady</a></li>
            <li><a href="../kontakt.php">Kontakt</a></li>
            <li><a href="about_me.php">Twój Profil</a></li>
            <?php
            if(isset($_SESSION['zalogowany'])){
                echo '<li><a href="php/logout.php">Wyloguj</a></li>';
            } else{
                echo '<li><a href="register.php">Zarejestruj się</a></li>';
                echo '<li><a href="index.php">Zaloguj się</a></li>';
            }
            ?>

        </ul>
    </div>
<table style="width: 95%">
    <tr>
        <th colspan="9"><h2>Quady sportowe:</h2></th>

    </tr>
    <tr>
        <th>Marka</th>
        <th>Model</th>
        <th>Rok produkcji</th>
        <th>Moc</th>
        <th>Pojemność</th>
        <th>Moment obrotowy</th>
        <th>Typ</th>
        <th>Ocena</th>
    </tr>
    <?php


    $db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");
    $db->set_charset("utf8");
    $find_data= "select * from rates_quad where typ = 'Sportowy'";
    $sql = "select * from quad where typ = 'Sportowy'";
    $result= $db->query($sql);
    $result2=$db->query($find_data);


    if($result-> num_rows>0 and $result2-> num_rows>0){
        while($row=$result->fetch_assoc() AND  $row3=$result2->fetch_assoc() ){
            $model=$row['model'];
            $id=$row3['id'];
            $marka=$row3['marka'];
            //$model2=$row3['model2'];
            $oceny=$row3['oceny'];
            $hits=$row3['hits'];


            echo     "<tr><td>" . $row["marka"] . "</td><td>" . $row["model"] . "</td><td>" . $row["rok_produkcji"] . "</td><td>" . $row["moc"] . "</td><td>" . $row["poj_silnika"] . "</td><td>" . $row["mom_obrot"] . "</td><td>" . $row["typ"] .  "</td><td>" ."<form action='ocena_quad_sportowy.php' method='POST'>
               $model: <select name='oceny'>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      
                        </select>
                 <input type='hidden' value='$model' name='model2'>
                 <input type='submit' value='Oceń!' name=''> Obecna ocena: $oceny
                        
                </form>
". "</td></tr>";



        }
        echo "</table>";
    }else{
        echo"0 rezultatów";
    }
    $db->close()
    ?>
</table>




</body>




</html>
