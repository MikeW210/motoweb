<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>MotoWeb</title>
  <link rel="stylesheet" href ="css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href ="admin.css">
  <link rel="stylesheet" href ="../css/style.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="#">MotoWeb ADMIN</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="nav navbar-nav navbar-right">
      <li class="nav-item ">
        <a class="nav-link" href="coments.php">Coments </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="users.php">Users</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="posts.php">Posts</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="news.php">News</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="forum.php">Forum</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href = "../index.php">Wyloguj</a>
      </li>
    </ul>
  </div>
</nav>

<div class="about_me">

       <?php
       if(isset($_SESSION['zalogowany'])){
          $nazwa = $_SESSION['username'];
          $email = $_SESSION['email'];
          
           echo "<div id='login_name'><a>Witaj $nazwa !<br><br>Oto twoj panel sterowania!<br></a>";
           echo '</div>'; } else{
           echo "nic nie ma";
       }


       ?>

   </div>

</body>
</html>