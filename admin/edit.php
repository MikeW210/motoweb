

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>MotoWeb</title>
  <link rel="stylesheet" href ="../css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href ="admin.css">

</head>
<body>


<div class="login-box">
        <h1>Edit</h1>
        <!-- <?php if (count($errors)>0): ?>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        <?php endif; ?> -->
    <?php
    session_start();
    $db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");

   

    if(isset($_POST['edit_button'])){
        $id = $_POST['edit_id'];
        $sql = "SELECT * FROM user WHERE id='$id' ";
        $result= mysqli_query($db, $sql);
        foreach($result as $row)
    {

    ?>
        <form action="edition.php" method="POST">
        <input type = 'hidden' name='edit_id' value="<?php echo $row['id']; ?>">
                <div class="form-group">
                    <label> Username </label>
                    <input type="text" name="edit_username" value="<?php echo $row['username']; ?>" class="form-control" placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="edit_email" value="<?php echo $row['email']; ?>" class="form-control" placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="edit_password"  class="form-control" placeholder="Enter Password">
                </div>
                <div>
                    <input type="submit" class="butt" name="Anluj" value="Anuluj" />
                </div>
                <div>
                    <input type="submit" class="butt" name="Update" value="Zapisz" />
                </div>
        </form>
        <?php
          }
    }
    ?>


    </div>

</body>
</html>