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
          <li class="nav-item ">
            <a class="nav-link" href="homepage.php">Home
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="moto.php">Motocykle</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="php/about_me.php">Twój Profil</a>
          </li>
          <li class="nav-item active">
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
  <h1 class="my-4">Coś Cię trapi?
          <small>Zadaj pytanie!</small>
          <a href=<?php echo 'addposttoforum.php'?> class="btn btn-primary">Załóż nowy temat! &rarr;</a>
        </h1>
        
        

<form action=" forum.php" method="post">
  <div class="card my-4">
  <h5 class="card-header">Search</h5>
  <div class="card-body">
    <div class="input-group">
    
      <input type="text" class="form-control" name ='search' placeholder="Search for...">
      <span class="input-group-btn">
        <input type='submit' class="btn btn-secondary" name = 'search_but'type="button" value = 'szukaj!'/>
      </span>
     
    </div>
  </div>
</div>
</form>
    <div class="row">
   <?php
    
    if(isset($_POST['search_but'])){
      $db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");
      $searchq = $_POST['search'];
      
                $sql = "SELECT * from forum Where title LIKE '%$searchq%' ORDER BY forum_id DESC";
                $result= $db->query($sql);
                if($result-> num_rows > 0 ){
                    while($row=$result->fetch_assoc()){
                        
                        $date = $row['forum_uploaded_on'];
                        $forum_id = $row['forum_id'];
                        $title = $row['title'];
                        $intro = $row['intro'];
                        $desc = $row['description'];

                    
                    
                   ?> 

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        

        <!-- Blog Post -->
        <div class="card mb-4">
          <div class="card-body">
            <h2 class="card-title"><?php echo $title?></h2>
            <p class="card-text"><?php echo $intro?></p>
            <a href=<?php echo 'specificforum.php?id='.$forum_id?> class="btn btn-primary">Wiecej &rarr;</a>
          </div>
          <div class="card-footer text-muted">
          <?php echo $date ?>
           
          </div>
        </div>
        
    </div>
    <?php
                    }
        }
    } else {

    
    ?>
    <?php
      $db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");
      
      
                $sql = "SELECT * from forum ORDER BY forum_id DESC";
                $result= $db->query($sql);
                if($result-> num_rows > 0 ){
                    while($row=$result->fetch_assoc()){
                        
                        $date = $row['forum_uploaded_on'];
                        $forum_id = $row['forum_id'];
                        $title = $row['title'];
                        $intro = $row['intro'];
                        $desc = $row['description'];

                    
                    
                   ?> 

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        

        <!-- Blog Post -->
        <div class="card mb-4">
          <div class="card-body">
            <h2 class="card-title"><?php echo $title?></h2>
            <p class="card-text"><?php echo $intro?></p>
            <a href=<?php echo 'specificforum.php?id='.$forum_id?> class="btn btn-primary">Wiecej &rarr;</a>
          </div>
          <div class="card-footer text-muted">
          <?php echo $date ?>
           
          </div>
        </div>
        
    </div>
    <?php
                    
        }
    }
  }
    ?>
    
    <div class="col-md-4">

<!-- Search Widget -->


</div>
  
</div>
  <!-- /.row -->

  </div>
  <!-- /.container -->

  
 
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>

</html>
