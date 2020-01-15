
<?php
session_start();
$db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");


if (isset($_POST['Update'])){
    
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];

    $password = md5($password);
    
    $result = "UPDATE user SET username='$username', email='$email', password='$password' WHERE id='$id'";
    $query_run = mysqli_query($db,$result);

    if($query_run){
        echo 'poszlo';
        header("Location:users.php");
    } else {
        echo 'dupa';
    }
    
}


if (isset($_POST['delete_forum_button'])){
    
    $id = $_POST['delete_forum_id'];
    
    
    $result = "DELETE FROM forum WHERE forum_id='$id'";
    $query_run = mysqli_query($db,$result);

    if($query_run){
        echo 'poszlo';
        header("Location:forum.php");
    } else {
        echo 'dupa';
    }
    
}

if (isset($_POST['delete_comment_button'])){
    $user = $_POST['nazwa_usera'];
    $find_data = "select * from user WHERE username='$user'";
    $result = @$db->query($find_data);
    while ($row = $result->fetch_assoc()) { 
      $current_hits = $row['number_of_comments'];
      
  }
  $new_hits = $current_hits - 1;
  $update_hits = "UPDATE user SET number_of_comments = '$new_hits' where username='$user'";
 
  if ($db->query($update_hits)) {
      echo "jest git";

  } else {
      echo "jest chujnia";
  }

    $id = $_POST['delete_comment'];
    
    
    $result = "DELETE FROM coments WHERE id='$id'";
    $query_run = mysqli_query($db,$result);

    if($query_run){
        echo 'poszlo';
        header("Location:coments.php");
    } else {
        echo 'dupa';
    }
    
}

if (isset($_POST['admin_logout'])){
session_start();
   session_destroy();
   header("Location:../index.php");
}


if (isset($_POST['delete_button'])){
    
    $id = $_POST['delete_id'];
    
    
    $result = "DELETE FROM user WHERE id='$id'";
    $query_run = mysqli_query($db,$result);
    if($query_run){
        echo 'poszlo';
        header("Location:users.php");
    } else {
        echo 'dupa';
    }
    
}

if (isset($_POST['delete_news_button'])){
    
    $id = $_POST['delete_news'];
    
    
    $result = "DELETE FROM main_posts WHERE news_id='$id'";
    $query_run = mysqli_query($db,$result);
    if($query_run){
        echo 'poszlo';
        header("Location:news.php");
    } else {
        echo 'dupa';
    }
    
}

if (isset($_POST['delete_post_button'])){
    
    $id = $_POST['delete_post'];
    
    
    $result = "DELETE FROM post_moto WHERE post_id='$id'";
    $query_run = mysqli_query($db,$result);
    if($query_run){
        echo 'poszlo';
        header("Location:posts.php");
    } else {
        echo 'dupa';
    }
    
}



if (isset($_POST['Anluj'])){
    header("Location:users.php");
  }

  

if (isset($_POST['anuluj_edycje'])){
    
    header("Location:posts.php");
  }

if (isset($_POST['edytuj_post'])){
    
   
    $id = $_POST['edit_post'];
    //$img=$_POST['files[]'];
    $title=$_POST['title_edit'];
    $description=$_POST['description_edit'];
    $targetDir = "uploads/";
    $allowTypes = array('jpg','png','jpeg','gif');
    


    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    if(!empty(array_filter($_FILES['files']['name']))){
        foreach($_FILES['files']['name'] as $key=>$val){
            // File upload path
            $fileName = basename($_FILES['files']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                    // Image db insert sql
                    $insertValuesSQL .= "('".$fileName."', NOW()),";
                }else{
                    $errorUpload .= $_FILES['files']['name'][$key].', ';
                }
            }else{
                $errorUploadType .= $_FILES['files']['name'][$key].', ';
            }
        }
        
        if(!empty($insertValuesSQL)){
            $insertValuesSQL = trim($insertValuesSQL,',');
            // Insert image file name into database
            $result = "UPDATE post_moto SET post_moto.title = '$title', post_moto.description = '$description' FROM post_moto pm WHERE pm.post_id = '$id'";
            $result2 = "UPDATE images SET images.file_name = '$insertValuesSQL',  FROM post_moto, images WHERE post_moto.post_id = '$id' AND post_moto.uploaded_on = images.uploaded_on";
            if($result && $result2){
                $errorUpload = !empty($errorUpload)?'Upload Error: '.$errorUpload:'';
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
                $statusMsg = "Files are uploaded successfully.".$errorMsg;
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }
    }
    else{
        $statusMsg = 'Please select a file to upload.';
    }

    header('Location:posts.php');

 }
   


?>