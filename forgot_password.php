<?php
 include 'php/serwer.php'
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>MotoWeb</title>
  <link rel="stylesheet" href ="css/style.css">


</head>

<body>

<div class="login-bg">
<form action="forgot_password.php" method="post">
    
    <div class="login-box">
        <h1>Zmień hasło!</h1>
        <p>Prosze wpisz w okienko swój email a my wyślemy Ci maila z linkiem do zmiany hasła!</p>
        <?php if (count($errors)>0): ?>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="text-box">
            <i class="fas fa-user"></i>
            <label>Email</label>
            <input type="email" name="email" >
        </div>

        <div>
            <input type="submit" class="butt" name="forgot_password" value="Reset hasła!" />
        </div>

     


    </div>

</form>
</div>







</body>

</html>
