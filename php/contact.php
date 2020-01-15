<?php


if (isset($_POST["zapytaj"])){
    echo'qwe';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $title = $_POST['title'];
    $message = $_POST['message'];

    $mailTo = "michalwalenciak50@gmail.com";
    $headers = "From: ".$email;
    
    mail($mailTo, $title, $message, $headers);
    echo'poszlo';

    header("location:kontakt.php");
}
