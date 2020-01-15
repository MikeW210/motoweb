<?php
$name=$_POST['name'];
$visitor_email=$_POST['email'];
$message=$_POST['message'];

$email_to="mw.mysza@gmail.com";
$headers="Od: ".$visitor_email;
$txt = "Dostałeś maila od: ".$name. "\n\n".$message;

mail($email_to,$txt,$headers);
header("Location: homepage.php")
?>