<?php
 include 'php/serwer.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    Login Page</title>
  <link rel="stylesheet" href ="css/style.css">


</head>

<body>

<div class="login-bg">
<form action="index.php" method="post">
    
    <div class="login-box">
        <h1>Login</h1>
        <?php if (count($errors)>0): ?>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="text-box">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Email albo nazwa" name="username" value="<?php echo $username; ?>" >
        </div>

        <div class="text-box">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Hasło" name="password" value="" >
        </div>

        <div>
            <input type="submit" class="butt" name="zaloguj" value="Zaloguj się!" />
        </div>

        <div>
            <input type="submit" class="butt" name="rejestruj" value="Zarejestruj się!" />
        </div>

        <div>
        <a href = "forgot_password.php" class='forgot'>zapomniałeś hasła?</a>
        </div>


    </div>

</form>
</div>







</body>

</html>
