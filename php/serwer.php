<?php
session_start();

$db = new mysqli("localhost", "root", "","motodb") or die ("Błąd");
$db->set_charset("utf8");
require_once 'emailVerification.php';
$errors = array();
$username = "";
$email = "";


if( isset($_POST["register"])){

    $username= $_POST['username'];
    $email=$_POST['email'];
    $password1= $_POST['password1'];
    $password2= $_POST['password2'];
    
    if(empty ($username)) { 
        $errors['username'] = "Podaj nazwe użytkownika";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        $errors['email'] = "Podaj email jest niepoprawny!";
    }
    if(empty ($email)) { 
        $errors['email'] = "Podaj email użytkownika";
    }
    if(empty ($password1)) { 
        $errors['password1'] = "Podaj hasło użytkownika";
    }
    if( $password1!==$password2) { 
        $errors['username'] = "Hasła się nie są identyczne!";
    }
    $emailQuery = "SELECT * FROM user WHERE email=? LIMIT 1";
    $stmt = $db->prepare($emailQuery);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $userCount = $result->num_rows;
    $stmt->close();

    if($userCount > 0){
        $errors['email'] = "Już istnieje taki użytkownik o takim emailu!";
    }

    $emailQuery = "SELECT * FROM user WHERE username=? LIMIT 1";
    $stmt = $db->prepare($emailQuery);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $userCount = $result->num_rows;
    $stmt->close(); 
    if($userCount > 0){
        $errors['username'] = "Już istnieje taki użytkownik o takiej nazwie!";
    }
    if(count($errors) === 0){
        $password1 = md5($password1);
        $vkey = md5(time().$username);
        
        $insert = $db->query("INSERT INTO user  (username,email,password,vkey) VALUES ('$username','$email','$password1','$vkey')");
        $row = $result->fetch_assoc();
        $verified = $row['verified'];
        if ($insert){
            
            
            $_SESSION['verified'] = $verified;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email ;
            sendVerificationEmail($email, $vkey);
            header('Location:verify.php');
            $_SESSION['message'] = "Już blisko!";

            exit();

        }else {
            $errors['db_error'] = "Nie udało sie zalogować";
        }
    }


}

if(isset($_POST['zaloguj'])){
    $username= $_POST['username'];
    $password= $_POST['password'];
    $enpassword = md5($password);
    
    if(empty ($username)) { 
        $errors['username'] = "Podaj nazwe użytkownika";
    }
    if(empty ($password)) { 
        $errors['password'] = "Podaj hasło użytkownika";
    }
    
    if(count($errors) === 0){
    $result = $db->query("SELECT * FROM user WHERE username = '$username'"); 

    if($result->num_rows !=0){
        
        $row = $result->fetch_assoc();
        $passwd = $row['password'];
        if($passwd != $enpassword){
            $errors['password'] = "Podane hasło jest nieprawidłowe";
        } else{
        $id = $row['id'];
        $verified = $row['verified'];
        $email = $row['email'];
        $admin = $row['admin'];
        if($admin == 1){
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $username;
            $_SESSION['email'] =  $email;
            $_SESSION['verified'] = $verified;
            $_SESSION['zalogowany'] = 1;
            header('Location:admin/homepage.php');
        } else{

        
            //echo"cos jest";
        if($verified == 1){

        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] =  $email;
        $_SESSION['verified'] = $verified;
        $_SESSION['zalogowany'] = 1;
        header('Location:homepage.php');
        $_SESSION['message'] = "Już blisko!";
       
        } else{
           
            if($verified != 1){
                $errors['verified'] = "Najpierw zweryfikuj konto!";
            }
        
        }
    }
    }

    }else{
        $errors['username'] = "Nie ma użytkownika o takiej nazwie!";
    }

    }
    

}

if (isset($_POST['rejestruj'])){
    header('Location:register.php');
}



if (isset($_POST['powrot'])){
    header('Location:index.php');
}

if (isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['verify']);
    
    header('Location:index.php');
}

// verify user by token
function verifyUser($vkey)
{
    $db = new mysqli("localhost", "root", "","motodb");
    $result = $db->query("SELECT verified,vkey FROM user WHERE verified = 0 AND vkey='$vkey' LIMIT 1");

    if ($result -> num_rows == 1){
       
        $update = $db->query("UPDATE user SET verified=1 WHERE vkey='$vkey'");

        if($update){
            header('location:index.php');
            exit();
        }
        

    } else {
        echo 'nie znaleziono użytkownika';
    }

}


if(isset($_POST['forgot_password'])){

    $email = $_POST['email'];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        $errors['email'] = "Podaj email jest niepoprawny!";
    }
    if(empty ($email)) { 
        $errors['email'] = "Podaj email użytkownika";
    }

    if(count($errors) == 0) {
        $db = new mysqli("localhost", "root", "","motodb");
        $result = $db->query("SELECT * FROM user WHERE email= '$email' LIMIT 1");
        $row = $result->fetch_assoc();
        $vkey = $row['vkey'];
        sendPasswordResetLink($email, $vkey);
        header('location:change_message.php');
        exit(0);
    }
}

if(isset($_POST['reset_button'])){

    $password = $_POST['password'];
    $password1 = $_POST['password1'];

    if(empty ($password || $password1)) { 
        $errors['password1'] = "Podaj hasło użytkownika";
    }
    if( $password!==$password1) { 
        $errors['password'] = "Hasła się nie są identyczne!";
    }

    $newpassword = md5($password);
    $email = $_SESSION['email'];
    if(count($errors) == 0) {
        $db = new mysqli("localhost", "root", "","motodb");
        $result = $db->query("UPDATE user SET password = '$newpassword' WHERE email = '$email'");
        
        if($result){
            header('location:index.php');
            exit();
        }
        
        
    }
}


function resetPassword($vkey){

    $db = new mysqli("localhost", "root", "","motodb");
    $result = $db->query("SELECT * FROM user WHERE vkey = '$vkey' LIMIT 1");
    $row = $result->fetch_assoc();
    $email = $row['email'];
    $_SESSION['email'] = $email;
    header('location: reset_password.php');
    exit(0);
}


$db->close();

?>
