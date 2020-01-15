<?php
require_once 'php/serwer.php';

if(isset($_GET['vkey'])){
    $vkey = $_GET['vkey'];
    verifyUser($vkey);
} 
if(isset($_GET['password-vkey'])){
    $passwordVkey = $_GET['password-vkey'];
    resetPassword($passwordVkey);
} 
if(isset($_SESSION['id'])){
   header('location: index.php');
   exit();
} 
  
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>MotoWeb</title>
    <link rel="stylesheet" href ="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<body>

<div class="login-bg">
    <div class= "login-box">
        <div>
            <?php if(isset($_SESSION['message'])): ?>
            <h1>
                <?php 
                echo $_SESSION['message']; 
                //unset($_SESSION['message']);
                ?>
            </h1>
            <?php endif; ?>
            
            <h3>Hej <?php echo $_SESSION['username'];?> !</h3>
            

            <?php if(!$_SESSION['verified']): ?>
                <p>
                Musisz zweryfikować swoje konto! W tym celu wysłaliśmy Ci maila na <strong> <?php echo $_SESSION['email'];?></strong>!
            </p>
            <?php endif; ?> 
            <div>   
            <a href="index.php?logout=1" class="forgot">Logout<a/>
            </div>
            <?php if($_SESSION['verified']): ?>
                <button class="btn btn-block btn-lg btn-primary">Jestem zweryfikowany!</button>
            <?php endif; ?>  
        </div>
    </div>
</div>


</form>


