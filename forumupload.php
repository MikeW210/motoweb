<?php
session_start();

if(isset($_POST['upload_forum'])){
  $db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");

    $name = $_SESSION['username'];
    $desc = $_POST['description'];
    $title = $_POST['title'];
    $intro = $_POST['intro'];

    $insert = $db->query("INSERT INTO forum (title, description, intro, name) VALUES ('$title','$desc', '$intro', '$name')");
    if($insert){
        header('Location:forum.php');
    }else{
       echo 'dupa';
    }
}
if(isset($_POST['anuluj_forum'])){
  header('Location:forum.php');
}
?>