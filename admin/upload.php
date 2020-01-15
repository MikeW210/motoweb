<?php

if(isset($_POST['upload'])){
  $db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");
    
    // File upload configuration
    $targetDir = "uploads/";
    $allowTypes = array('jpg','png','jpeg','gif');
    $desc = $_POST['description'];
    $intro = $_POST['intro'];
    $title = $_POST['title'];

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
            $insert = $db->query("INSERT INTO images (file_name, uploaded_on) VALUES $insertValuesSQL");
            $insert2 = $db->query("INSERT INTO post_moto (title, description, intro) VALUES ('$title','$desc' ,'$intro')");
            if($insert){
                $errorUpload = !empty($errorUpload)?'Upload Error: '.$errorUpload:'';
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
                $statusMsg = "Files are uploaded successfully.".$errorMsg;
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }
    }else{
        $statusMsg = 'Please select a file to upload.';
    }
    
    // Display status message
    echo $statusMsg;
    header('Location:posts.php');
}



if(isset($_POST['upload_news'])){
    $db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");
      
      // File upload configuration
      $targetDir = "uploads/";
      $allowTypes = array('jpg','png','jpeg','gif');
      $desc = $_POST['description'];
      $title = $_POST['title'];
      $intro = $_POST['intro'];
  
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
              $insert = $db->query("INSERT INTO images (file_name, uploaded_on) VALUES $insertValuesSQL");
              $insert2 = $db->query("INSERT INTO main_posts (title, description, intro) VALUES ('$title','$desc', '$intro')");
              if($insert){
                  $errorUpload = !empty($errorUpload)?'Upload Error: '.$errorUpload:'';
                  $errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
                  $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
                  $statusMsg = "Files are uploaded successfully.".$errorMsg;
              }else{
                  $statusMsg = "Sorry, there was an error uploading your file.";
              }
          }
      }else{
          $statusMsg = 'Please select a file to upload.';
      }
      
      // Display status message
      echo $statusMsg;
      header('Location:news.php');
  }
?>