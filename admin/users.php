<?php
$db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");
$sql = "SELECT * FROM user";
$result= mysqli_query($db, $sql);
include_once 'edition.php'
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
  <a class="navbar-brand" href="homepage.php">MotoWeb ADMIN</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="nav navbar-nav navbar-right">
      <li class="nav-item">
        <a class="nav-link" href="coments.php">Coments </a>
      </li>
      <li class="nav-item active">
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
        
        <th scope="col">Nazwa użytkownika</th>
        <th scope="col">Email</th>
        <th scope="col">Liczba komentarzy</th>
        <th scope="col">Edytuj</th>
        <th scope="col">Usuń</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(mysqli_num_rows($result) > 0 ) {
        while($row=mysqli_fetch_assoc($result)) {

        
        $id = $row['id'];
        $username = $row['username'];
        $email = $row['email'];
        $createdate = $row['createdate'];
        $num = $row['number_of_comments'];
        
        ?>
        <tr>
        
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $num; ?></td>
            <td> <form action="edit.php" method="post" >
                <input type = 'hidden' name='edit_id' value="<?php echo $row['id']; ?>">
                <button type="submit" name="edit_button" class="btn btn-success">Edytuj</button>
                </form>
            </td>
            <td> <form action="edition.php" method="post" >
                <input type = 'hidden' name='delete_id' value="<?php echo $row['id']; ?>">
                <button type="submit" name='delete_button' class="btn btn-danger">Usuń</button>
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