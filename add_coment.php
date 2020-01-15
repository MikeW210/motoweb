<?php

session_start();


$db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");


$postid = $_SESSION['post_id'];
$comment = $_POST['comment_content'];
$username = $_SESSION['username'];


if( isset($_POST["submit_coment"])){

    if(empty($comment)){
        echo"wpisz cos pajacu";
    }
    $sql = $db->query("INSERT INTO coments (comment,comment_sender_name, post_id) VALUES ('$comment','$username','$postid')");
    $insert = $db->query($sql);
    header('Location:specificpost.php?id=1');

}

?>