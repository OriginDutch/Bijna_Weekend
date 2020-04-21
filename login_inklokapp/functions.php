<?php include('config.php'); ?>

<?php 
session_start();

  //initializing variables
$email = "";
$errors = array();
$fileToUpload = "";

//CHECKS IF THE USER IS LOGGED IN
function checkLogin(){
    session_start();

    if (!isset($_SESSION['email'])) {
        $_SESSION['msg'] = "U moet eerst inloggen";
        header('location: login.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['email']);
        header("location: login.php");
    }
    
    session_write_close();
}

//LOGIN
if (isset($_POST['login_btn'])) {
    //create vars with input data
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

    //form validation
  if (empty($email)) { array_push($errors, "E-mailadres ontbreekt"); }
  if (empty($password)) { array_push($errors, "Wachtwoord ontbreekt"); }

    //if there are no errors check if login credentials are correct
  if (count($errors) == 0) {
    //$password = md5($password);
    $loginQuery = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $loginResult = mysqli_query($db, $loginQuery);

    if (mysqli_num_rows($loginResult) == 1) {
      $_SESSION['email'] = $email;
      $_SESSION['success'] = "U bent nu ingelogd";
      header('location: index.php');
    }else { array_push($errors, "Verkeerd e-mail/wachtwoord combinatie"); }
  }
}

if (isset($_POST['logout_btn'])) {
    session_destroy();
    //unset($_SESSION['email']);
    header("location: login.php");
}

//REGISTER
if(isset($_POST['registerPerson']))
    {
        $firstName      = $_POST['firstName'];
        $surname        = $_POST['surname'];
        $studentNumber  = $_POST['studentNumber'];
        $email          = $_POST['email'];
        $userType       = $_POST['userType'];
        $passwordOne    = $_POST['passwordOne'];
        $passwordTwo    = $_POST['passwordTwo'];
        //$photoPath      = $_POST[''];
        $loggedIn       = 0;


        $target_dir = "D:xampp/htdocs/photos/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $photoPath = "http://localhost/photos/" . basename($_FILES["fileToUpload"]["name"]);
    // UPLOADING A  FILE
      // Check if image file is an actual image or fake image.
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "Bestand is een afbeelding - " . $check["mime"] . ".<br>";
            $uploadOk = 1;
        } else {
            echo "Bestand is niet een afbeelding.<br>";
            $uploadOk = 0;
        }
    
    
      // Check if file already exists
    if (file_exists($target_file)) {
      echo "Het bestand bestaat al.<br>";
      $uploadOk = 0;
    }
    
      // Check if file size exceeds 500KB.
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Uw bestand is te groot.<br>";
      $uploadOk = 0;
    }
    
      // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Alleen JPG, JPEG, PNG & GIF bestanden zijn toegestaan.<br>";
      echo $target_file;
      $uploadOk = 0;
    }
    
      // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "<br>Uw bestand is niet geüpload.<br>";
    
        // if everything is ok, try to upload file and send path to database.
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "Het bestand ". basename( $_FILES["fileToUpload"]["name"]). " is geüpload.";
            
        
            
            //header('location: index.php');
        } else {
            echo "Er is een probleem opgetreden tijdens het uploaden van uw bestand.<br>";
        }
        $target_dir = "D:xampp/htdocs/photos/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
          // UPLOADING A  FILE
          // Check if image file is an actual image or fake image.
        if(isset($_POST["uploadFileBtn"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "Bestand is een afbeelding - " . $check["mime"] . ".<br>";
                $uploadOk = 1;
            } else {
                echo "Bestand is niet een afbeelding.<br>";
                $uploadOk = 0;
            }
        }
        
          // Check if file already exists
        if (file_exists($target_file)) {
          echo "Het bestand bestaat al.<br>";
          $uploadOk = 0;
        }
        
          // Check if file size exceeds 500KB.
        if ($_FILES["fileToUpload"]["size"] > 500000) {
          echo "Uw bestand is te groot.<br>";
          $uploadOk = 0;
        }
        
          // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          echo "Alleen JPG, JPEG, PNG & GIF bestanden zijn toegestaan.<br>";
          echo $target_file;
          $uploadOk = 0;
        }
        
          // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "<br>Uw bestand is niet geüpload.<br>";
        
            // if everything is ok, try to upload file and send path to database.
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "Het bestand ". basename( $_FILES["fileToUpload"]["name"]). " is geüpload.";
                
                $uploadFileQuery = "INSERT INTO users(photoPath) VALUES('$photoPath')";
                mysqli_query($db, $uploadFileQuery);
                
                header('location: index.php');
            } else {
                echo "Er is een probleem opgetreden tijdens het uploaden van uw bestand.<br>";
            }
        }

        $sql = "INSERT INTO users(firstName, surname, studentNumber, userType, email, password, loggedIn, photoPath) VALUES('$firstName', '$surname', '$studentNumber', '$userType', '$email', '$passwordOne', '$loggedIn', '$photoPath')";
                //echo $sql;
        mysqli_query($db, $sql);
    }
}   

if(isset($_POST['checkInOut'])) {
  session_start();

  $currentUserQuery = "SELECT loggedIn FROM users WHERE email = '" . $_SESSION['email'] . "'";
  $resultUser = mysqli_query($db, $currentUserQuery);
  $rowUser = mysqli_fetch_array($resultUser);
  
  
  if($rowUser['loggedIn']== 0){
    $sql = "UPDATE users SET loggedIn = 1 WHERE email = '" . $_SESSION['email'] . "'";
  } else {
    $sql = "UPDATE users SET loggedIn = 0 WHERE email = '" . $_SESSION['email'] . "'";
  }
  echo $sql;
  mysqli_query($db, $sql);
  header('location: index.php');

  session_write_close();
}

session_write_close();
?>