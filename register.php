<?php
  include 'php/serwer.php';
//
  if(isset($_GET['token'])){
      $token = $_GET['token'];
      verifyUser($token);
  }
// jezeli user jest zalogowany
  if(isset($_SESSION['id'])){
      header('location: verify.php');
      exit();
  }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>MotoWeb</title>
    <link rel="stylesheet" href ="css/style.css">
    <link rel="stylesheet" href ="css/bootstrap.min.css">

</head>

<body>

<div class="login-bg">
    <div class="login-box">
        <h1>Rejestracja</h1>
    <form action="register.php" method="post">
    <?php if (count($errors)>0): ?>
        <?php foreach ($errors as $error): ?>
        <li><?php echo $error; ?></li>
        <?php endforeach; ?>
    <?php endif; ?>
        <div class="text-box">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Nazwa" name="username"  value="<?php echo $username; ?>"  >
        </div>

        <div class="text-box">
            <i class="fas fa-envelope-square"></i>
        <input type="EMAIL" placeholder="E-mail" name="email" value="<?php echo $email; ?>" >
        </div>

        <div class="text-box">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Hasło" name="password1" value="" >
        </div>
        <div class="text-box">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Powtórz hasło" name="password2" value="" >
        </div>

        <form>
            <input type="submit" class="butt" name="register" value="Rejestracja!" />
        </form>

        <form action="index.php">
            <input type="submit" class="butt" name="powrot" value="Powrót" />
        </form>
    </form>
    </div>
</div>






</body>

</html>
