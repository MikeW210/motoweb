<?php
include 'upload.php';
session_start();
$db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");
$sql = "SELECT * FROM main_posts";
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
      <li class="nav-item active">
        <a class="nav-link" href="news.php">News</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="forum.php">Forum</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href = "../index.php">Wyloguj</a>
      </li>
      
    </ul>
  </div>
</nav>
<div>
<button id="modal-btn" class="button">Dodaj nowy post!</button>

  <div id="my-modal" class="modal">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nowy post!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="upload.php" method="post" enctype="multipart/form-data">
      <!-- <div class="modal-body">
      
      <input type="text" placeholder="Wpisz tytuł" name="title" >
      <input type="file" name="files[]" multiple >
      <textarea name="intro" class="form-controla" placeholder="intro" ></textarea>
      <textarea name="description" class="form-controla" placeholder="desc" ></textarea>
      
      </div> -->
      <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name" placeholder="Wpisz tytuł" name="title">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Intro:</label>
            <textarea class="form-control" name="intro" placeholder="intro" id="message-text"></textarea>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Description:</label>
            <textarea class="form-control" name="description" placeholder="desc" id="message-text"></textarea>
          </div>
          <div class="form-group">
          <input type="file" name="files[]" multiple >
          </div>
      
      <div class="modal-footer">
        <input type="submit" id='anuluj' class="butt" name="anuluj" value="Anuluj" />
        <input type="submit" class="butt" name="upload_news" value="Dodaj post!" />
      </div>
    </div>
  </div>
  </form>
<div class="table-responsive">
    <table class="table table-striped table-dark">
    <thead>
        <tr>
        
        <th scope="col">Tytuł</th>
        <th scope="col">Intro</th>
        <th scope="col">Treść</th>
        <th scope="col">Usuń</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(mysqli_num_rows($result) > 0 ) {
        while($row=mysqli_fetch_assoc($result)) {

        
        $intro = $row['intro'];
        $title = $row['title'];
      
        $description = $row['description'];
        

        
        ?>
        <tr>
        
            <td><?php echo $row['title']; ?></td>
            
            <td><?php echo $row['intro']; ?></td>

            <td><?php echo $row['description']; ?></td>
          
            <td> 
            <form action="edition.php" method="post" >
                <input type = 'hidden' name='delete_news' value="<?php echo $row['news_id']; ?>">
                <button type="submit" name= 'delete_news_button' class="btn btn-danger">Usuń</button>
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