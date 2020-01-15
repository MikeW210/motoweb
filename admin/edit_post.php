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
      <li class="nav-item active">
        <a class="nav-link" href="coments.php">Coments <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="users.php">Users</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="posts.php">Posts</a>
      </li>
     
    </ul>
  </div>
</nav>

<div class="about_me">
<?php
session_start();
$db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");

if(isset($_POST['edit_post_button'])){
$id = $_POST['edit_post'];
$sql = "SELECT * FROM post_moto WHERE post_id = '$id' ";
$result= mysqli_query($db, $sql);
foreach($result as $row)
{

?>
<form action="edition.php" method="post" enctype="multipart/form-data">
<input type = 'hidden' name='edit_post' value="<?php echo $row['post_id']; ?>">
      <div>
      
      <input type="text" placeholder="Wpisz tytuł" name="title_edit" value=<?php echo $row['title']?> >
      <input type="file" name="files[]" multiple >
      <textarea name="description_edit" class="form-controla" placeholder="desc" ><?php echo $row['description']?></textarea>
      <input type="submit" id='anuluj' class="butt" name="anuluj_edycje" value="Anuluj" />
      <input type="submit" class="butt" name="edytuj_post" value="Edytuj post!" />
      </div>
</form>

   </div>
   <?php
    
}
}
   ?>

</body>
</html>