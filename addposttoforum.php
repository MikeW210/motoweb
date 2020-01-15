<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MotoWeb</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/posts.css" rel="stylesheet">
  
</head>

<body>


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
    <!-- <div class="logo">  
            <img src="imgs/logo.png"/>
        </div> -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <?php
            if(isset($_SESSION['zalogowany'])){
              ?>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="homepage.php">Home
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="moto.php">Motocykle</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="php/about_me.php">Twój Profil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="forum.php">Forum</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="php/logout.php">Wyloguj</a>
          </li>
          
        </ul>
      </div>

      <?php 
      } else{
        
      ?>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="register.php">Zarejestruj się</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Zaloguj się!</a>
          </li>
        </ul>
      </div>

      <?php 
      }
      ?>
    </div>
  </nav>

  
                    
  <div class="container">


    <div class="row">
   
      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <h1 class="my-4">Dodaj 
          <small>swój własny post!</small>
        </h1>

        


       
        <form action="forumupload.php" method="post">
    <div class="col-md-12">
    
    <h3>Tytuł</h3>
    <input type="text"  class="form-control" placeholder="Wpisz tytuł" name="title" >
     <h3>Intro</h3>
     <textarea name="intro" id='texta1'  class="form-control" placeholder="intro" ></textarea>
      <h3>Cała reszta</h3>
     <textarea name="description"  class="form-control" placeholder="desc" ></textarea>
     
     </div>
     
     <div class="modal-footer">
       <input type="submit" id='anuluj' class="btn btn-warning" name="anuluj_forum" value="Anuluj" />
       <input type="submit" class="btn btn-primary" name="upload_forum" value="Dodaj post!" />
     </div>
     
   </div>
   </form>

</div>
  
</div>
  <!-- /.row -->

  </div>
  <!-- /.container -->

  
 
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/jquery/ta.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>

 $("#texta1").autoResize();

</script>
</body>

</html>
