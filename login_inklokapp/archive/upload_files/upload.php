<?php include ('../config.php') ?>

<?php

// filename voor foto werkt nog niet. per klas kan een nieuwe folder worden aangemaakt. foldernaam kan nog geen spaties bevatten.

//$target_dir = "uploads/";
$target_dir = "D:xampp/htdocs/login_inklokapp/photos/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$fileName = mysqli_real_escape_string($db, $_POST['fileName']);
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
        
        $sql = "INSERT INTO users(firstName, surname, studentNumber, userType, email, password, loggedIn) VALUES('firstName', 'surname', 'studentNumber', 'userType', 'email', 'passwordOne', 'loggedIn')";
                //echo $sql;
        mysqli_query($db, $sql);

        //$uploadFileQuery = "INSERT INTO users(photoPath) VALUES('eyo')";
        //mysqli_query($db, $uploadFileQuery);
        
        header('location: index.php');
    } else {
        echo "Er is een probleem opgetreden tijdens het uploaden van uw bestand.<br>";
    }
}

?>