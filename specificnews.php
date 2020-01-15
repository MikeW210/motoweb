<?php
session_start();

if(isset($_GET['id']) && $_GET['id'] !== ''){
    $postid = $_GET['id']; 
    $_SESSION['post_id'] = $postid;
  } 

  
  
  
  if( isset($_POST["submit_coment"])){
    $db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");
    $user = $_SESSION['username'];
    $find_data = "select * from user WHERE username='$user'";
    $result = @$db->query($find_data);
    while ($row = $result->fetch_assoc()) { 
      $current_hits = $row['number_of_comments'];
      
  }
  $new_hits = $current_hits + 1;
  $update_hits = "UPDATE user SET number_of_comments = '$new_hits' where username='$user'";
 
  if ($db->query($update_hits)) {
      echo "jest git";

  } else {
      echo "jest chujnia";
  }

    $postid = $_SESSION['post_id'];
    $comment = $_POST['comment_content'];
    $username = $_SESSION['username'];
    $typ = 'news';
  
      if(empty($comment)){
          echo"wpisz cos pajacu";
      }
      $sql = $db->query("INSERT INTO coments (comment,comment_sender_name, coment_post_id, typ) VALUES ('$comment','$username','$postid', '$typ')");
     
      $insert = $db->query($sql);
      header('Location:specificnews.php?id=' .$postid);
  
  }





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
  <link href="css/blog-post.css" rel="stylesheet">

    <!-- <meta charset="utf-8">
    <title>Moto Page</title>
    <link rel="stylesheet" href ="css/moto.css">
    <link rel="stylesheet" href ="css/motopost.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content=""> -->

  



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

  <?php
            $db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");
            $sql = "SELECT * from images JOIN main_posts ON images.uploaded_on = main_posts.uploaded_on_main_post WHERE news_id='$postid'"   ;
           
            $result= $db->query($sql);
        
            if($result-> num_rows > 0 ){
                while($row=$result->fetch_assoc()  ){
                    
                    $date = $row['uploaded_on_main_post'];
                    $postid = $row['news_id'];
                    $title = $row['title'];
                    $desc = $row['description'];
                    $intro = $row['intro'];
                   
                    $imageURL = 'admin/uploads/'.$row["file_name"];
                   

                   
                    
                    
                    

                }

            }
        ?>

  <div class="container">

<div class="row">

  <!-- Post Content Column -->
  <div class="col-lg-12">

    <!-- Title -->
    <h1 class="mt-4"><?php echo $title ?></h1>

    <!-- Author -->
    <p class="lead">
      by
      <a href="#">Mike</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><?php echo $date ?></p>

    <hr>

    <!-- Preview Image -->
    <img class="img-fluid rounded" src=<?php echo $imageURL ?> alt="">

    <hr>
    <p class="lead"><?php echo $intro ?></p>
    

    <!-- Post Content -->
    <p > <?php echo $desc ?></p>

    

    <hr>

   
                   

    <!-- Comments Form -->
    <div class="card my-4">
      <h5 class="card-header">Nie bądź taki, zostaw ślad po sobie!</h5>
      <div class="card-body">
      <form action="specificnews.php" method="POST">
          <div class="form-group">
          <textarea name="comment_content" class="form-control" rows="3" placeholder="Napisz coś!"></textarea>
            
          </div>
        
          <input type="hidden" name="comment_id" value="0" />
          <input type="submit" name="submit_coment"  class="btn btn-primary"" value="Pozdro!" />
        </form>
      </div>
    </div>
    <?php
      $db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");
      $sql = "SELECT  coments.comment, coments.id, coments.comment_sender_name, coments.coment_post_id, main_posts.news_id, user.number_of_comments FROM coments INNER JOIN main_posts ON coments.coment_post_id = main_posts.news_id INNER JOIN user ON coments.comment_sender_name = user.username WHERE news_id='$postid' AND typ = 'news' ORDER BY coments.id DESC";
      $result= $db->query($sql);
                   

    
          if($result-> num_rows > 0){
          while($row=$result->fetch_assoc()){
          $coment = $row['comment']; 
          $name = $row['comment_sender_name'];
          $num_com = $row['number_of_comments'];         
                            
                   
                ?>


    <!-- Single Comment -->
    <div class="media mb-4">
    <?php
     if($num_com < 5){
    ?>
      <img class="d-flex mr-3 rounded-circle avatar" src="imgs/noob.jpg" alt="">
    <?php
    }
     if($num_com < 15 && $num_com >= 5){
    ?>
    <img class="d-flex mr-3 rounded-circle avatar" src="imgs/wielki_ptak.jpeg" alt="">
    <?php
     }
     if($num_com > 50 && $num_com >= 15 ){
    ?>
    <img class="d-flex mr-3 rounded-circle avatar" src="imgs/pro.png" alt="">
    <?php
     }
     
    ?>
      <div class="media-body">
      
        <h5 class="mt-0"><?php echo $name?></h5>
       <?php echo $coment?>
      </div>
    </div>

    <?php 
     }
    }

    ?>
  

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>


