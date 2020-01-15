<?php
session_start();
$db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");
$db->set_charset("utf8");

if(isset($_POST['zaloguj'])){
    $username= $_POST['use'];
    $password= $_POST['pass'];
    $password = md5($password);
    $sql = "select * from user where username = '$username'";
    $result= $db->query($sql);
    if($result-> num_rows>0){
        while($row=$result->fetch_assoc()){
            $numer = $row['phone'];
            $email = $row['email'];
        }
    }
    if(empty ($username) || empty ($password) ){
        $_SESSION['message']="Proszę uzupełnić wszystkie pola";
    }else{
        $spr="SELECT * FROM user WHERE username='$username' AND password='$password'";
        if(@$db->query($spr)->num_rows == 1){
            $_SESSION['username']=$username;
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $numer;
            $_SESSION['zalogowany']=true;

            header('Location:homepage.php');

        } else{
            $_SESSION['message']="Nie ma takiego użytkowanika o takim haśle";
        }
    }
}
if (isset($_POST['rejestruj'])){
    header('Location:register.php');
}

$db->close();
?>