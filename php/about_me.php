<?php
session_start();
$db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");
?>

<?php
       if(isset($_SESSION['zalogowany'])){
          $nazwa = $_SESSION['username'];
          $email = $_SESSION['email'];
          $userId = $_SESSION['id'];
          $find_data = "select * from user WHERE id='$userId'";
          $result = @$db->query($find_data);
          while ($row = $result->fetch_assoc()) { 
            $username =   $row['username'];
            $current_hits = $row['number_of_comments'];
            $email =   $row['email'];
          
           
        }
           
           } else{
           echo "nic nie ma";
       }


       ?>
<!DOCTYPE html>
<html>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MotoWeb</title>

  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../css/blog-post.css" rel="stylesheet">

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
            <a class="nav-link" href="../homepage.php">Home
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="../moto.php">Motocykle</a>
          </li>
        
          <li class="nav-item active">
            <a class="nav-link" href="about_me.php">Twój Profil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../forum.php">Forum</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Wyloguj</a>
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




<div class="row justify-content-md-center">
  <div class="col col-lg-3"> <div class="row">
    <?php
     if($current_hits < 5){
    ?>
      <img class="d-flex mr-3 rounded-circle avatar" src="../imgs/noob.jpg" alt="">
    <?php
    }
     if($current_hits < 15 && $current_hits >= 5){
    ?>
    <img class="d-flex mr-3 rounded-circle avatar" src="../imgs/wielki_ptak.jpeg" alt="">
    <?php
     }
     if($current_hits > 50 && $current_hits >= 15 ){
    ?>
    <img class="d-flex mr-3 rounded-circle avatar" src="../imgs/pro.png" alt="">
    <?php
     }
     
    ?>
      <div class="media-body">
        <h5 class="mt-0"><?php echo $_SESSION['username']?></h5>
       
      </div>
    </div></div>
  <div class="col col-lg-3"><div class="col-xs-6">
                <label for="email"><h4>Email</h4></label>
                <h3><?php echo $email ?></h3>
                <!-- <input type="email" class="form-control" value=<?php echo $email ?> title="enter your email."> -->
            </div></div>
  <div class="w-100"></div>
  <div class="col col-lg-3"><div class="col-xs-6">
            <label for="email"><h4>Nazwa</h4></label>
            <h3><?php echo $nazwa ?></h3>
            <!-- <input type="email" class="form-control"  value = <?php echo $nazwa ?>> -->
        </div></div>
  <div class="col col-lg-3"><div class="col-xs-6">
            <label for="email"><h4>Ilość komentarzy</h4></label>
            <p> <?php echo $current_hits ?> </p>
    </div>
  </div>
  <div class="w-100"></div>
  <div class="col col-lg-6">
  <form action=" about_me.php" method="post">
   <input type="submit" name='edycja_profilu' value = 'Edytuj profil' class="btn btn-success btn-lg btn-block"/>
   </form>
   </div>

</div>

<?php
if(isset($_POST['edycja_profilu'])){


?>
<form action=" about_me.php" method="post">
<div class="row justify-content-md-center">

  <div class="col col-lg-3"><div class="col-xs-6">
                <label for="email"><h4>Email</h4></label>
                
                <input type="email" name='zmien_email' class="form-control" value=<?php echo $email ?> title="enter your email.">
            </div></div>
  <div class="w-100"></div>
  <div class="col col-lg-3"><div class="col-xs-6">
            <label for="email"><h4>Nazwa</h4></label>
           
            <input type="text" name = 'zmien_username'class="form-control"  value = <?php echo $nazwa ?>>
        </div></div>
  
        <div class="w-100"></div>
  <div class="col col-lg-3">
  
   <input type="submit" name='zapisz_profil' value = 'Zapisz' class="btn btn-success btn-lg btn-block"/>
  
   </div>
  </div>
 

</div>
</form>
<?php
}
if(isset($_POST['zapisz_profil'])){
  $currentuser = $_SESSION['username'];
  $userid = $_SESSION['id'];
  $newusername= $_POST['zmien_username'];
  $newemail= $_POST['zmien_email'];
  $db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");
  $sql = "UPDATE user SET username = '$newusername', email = '$newemail' where username='$currentuser'";
  $result= $db->query($sql);
  if($result){
    $_SESSION['username'] = $newusername;
    header('Location:about_me.php');
  }else{
    echo 'dupa';
  }
  
}


?>


</body>

</html>


