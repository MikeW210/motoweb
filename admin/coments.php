<?php
include 'upload.php';
session_start();
$db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");
$sql = "SELECT * FROM coments ORDER BY id DESC";
$result= mysqli_query($db, $sql);
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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="homepage.php">MotoWeb ADMIN</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="nav navbar-nav navbar-right">
      <li class="nav-item active">
        <a class="nav-link" href="coments.php">Coments</a>
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


<div class="table-responsive">
    <table class="table table-striped table-dark">
    <thead>
        <tr>
        
        <th scope="col">Id komentarza</th>
        <th scope="col">Treść</th>
        <th scope="col">Użytkownik</th>
        <th scope="col">Data</th>
        <th scope="col">Id postu</th>
        <th scope="col">Usuń</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(mysqli_num_rows($result) > 0 ) {
        while($row=mysqli_fetch_assoc($result)) {

        
    
        $id = $row['id'];
        $comment = $row['comment'];
        $whose = $row['comment_sender_name'];
        $date = $row['date'];
        $post_id = $row['coment_post_id'];
        $typ = $row['typ']


        

        
        ?>
        <tr>
        
            <td><?php echo $id ?></td>
            <td><?php echo $comment ?></td>
            <td><?php echo $whose ?></td>
            <td><?php echo $date ?></td>
            <td><?php echo $typ ?></td>
            <td> 
            <form action="edition.php" method="post" >
                <input type = 'hidden' name='delete_comment' value="<?php echo $row['id']; ?>">
                <input type = 'hidden' name='nazwa_usera' value="<?php echo $row['comment_sender_name']; ?>">
                <button type="submit" name='delete_comment_button' class="btn btn-danger">Usuń</button>
                </form>
            </td>

        </tr>
        <?php
        }
        } else {
            echo "brak rekordów";
        }
        ?>
    </tbody>
    </table>
</div>


</body>
</html>