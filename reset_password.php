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
<form action="reset_password.php" method="post">
    
    <div class="login-box">
        <h1>Zresetuj hasło!</h1>
        <?php if (count($errors)>0): ?>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="text-box">
            <i class="fas fa-user"></i>
            <input type="password" placeholder="Hasło" name="password" value=""" >
        </div>

        <div class="text-box">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Powtórz hasło" name="password1" value="" >
        </div>

        <div>
            <input type="submit" class="butt" name="reset_button" value="Resetuj!" />
        </div>
    </div>

</form>
</div>







</body>

</html>
