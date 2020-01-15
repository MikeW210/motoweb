<?php
include 'upload.php';
session_start();
$db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");
$sql = "SELECT * FROM forum  ORDER BY forum_id DESC";
$result= mysqli_query($db, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>MotoWeb</title>
  <link rel="stylesheet" href ="css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script defer src="script.js"></script>
  <link rel="stylesheet" href ="../css/style.css">
  <link rel="stylesheet" href ="admin.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="homepage.php">MotoWeb ADMIN</a>
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
      <li class="nav-item ">
        <a class="nav-link" href="news.php">News</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="forum.php">Forum</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href = "../index.php">Wyloguj</a>
      </li>
      
    </ul>
  </div>
</nav>
<div>

<div class="table-responsive">
    <table class="table table-striped table-dark">
    <thead>
        <tr>
        
        <th scope="col">Tytuł</th>
        <th scope="col">Intro</th>
        <th scope="col">Treść</th>
        <th scope="col">Data</th>
        <th scope="col">Nick</th>
        <th scope="col">Usuń</th>
        
        </tr>
    </thead>
    <tbody>
        <?php
        if(mysqli_num_rows($result) > 0 ) {
        while($row=mysqli_fetch_assoc($result)) {

        
        $intro = $row['intro'];
        $title = $row['title'];
        $date = $row['forum_uploaded_on'];
        $description = $row['description'];
        $name = $row['name'];
        

        
        ?>
        <tr>
        
            <td><?php echo $row['title']; ?></td>
            
            <td><?php echo $row['intro']; ?></td>

            <td><?php echo $row['description']; ?></td>
            <td> 
            <?php echo $date ?></td>
            </td>
            <td> 
            <?php echo $name ?></td>
            </td>
            <td> 
            <form action="edition.php" method="post" >
            <input type = 'hidden' name='delete_forum_id' value="<?php echo $row['forum_id']; ?>">
                <button type="submit" name='delete_forum_button' class="btn btn-danger">Usuń</button>
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
</div>

</body>
</html>