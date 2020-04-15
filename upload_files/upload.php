<?php include ('config.php') ?>

<?php

// filename voor foto werkt nog niet. per klas kan een nieuwe folder worden aangemaakt. foldernaam kan nog geen spaties bevatten.

$target_dir = "uploads/";
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
  $uploadOk = 0;
}

  // Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Uw bestand is niet geüpload.<br>";

    // if everything is ok, try to upload file and send path to database.
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Het bestand ". basename( $_FILES["fileToUpload"]["name"]). " is geüpload.";
        
        $uploadFileQuery = "INSERT INTO images (fileName, filePath) VALUES ('$fileName', '$target_file')";
        mysqli_query($db, $uploadFileQuery);
        
        header('location: index.php');
    } else {
        echo "Er is een probleem opgetreden tijdens het uploaden van uw bestand.<br>";
    }
}

  // CREATE A FOLDER
$folderName = mysqli_real_escape_string($db, $_POST['folderName']);
$folderPath = "http://localhost/crm/upload_files/uploads/".$folderName;

if(isset($_POST["createFolderBtn"])) {
  //mkdir("$folderName");
  mkdir("./uploads/"."$folderName");

    $pagename = 'index';

    $newFileName = './uploads/'.$folderName.'/'.$pagename.".php";

    $newFileContent = 
    '<?php
      include (\'D:\xampp\htdocs\crm\upload_files\config.php\');

      $currentFolder = "'.$folderName.'";
      echo "Current folder: ".$currentFolder."<br>";      
    ?>
    
    <html>
      <body>

      <ul id="gallery">
      <?php			
        
        $sql_query = "SELECT filePath FROM images";
        $resultset = mysqli_query($db, $sql_query) or die("database error:". mysqli_error($db));
        while($rows = mysqli_fetch_array($resultset) ) { ?>
      
        <li>	
          <img src="http://localhost/crm/upload_files/<?php echo $currentFolder; ?>" class="images"></a>
        </li>

      <?php } ?>
    </ul>		





      </body>
    </html>';


    if (file_put_contents($newFileName, $newFileContent) !== false) {
        echo "File created (" . basename($newFileName) . ")";
    } else {
        echo "Cannot create file (" . basename($newFileName) . ")";
    }

    


  $createFolderQuery = "INSERT INTO imageFolders (folderName, folderPath) VALUES ('$folderName', '$folderPath')";
        mysqli_query($db, $createFolderQuery);
        header("location: index.php");
}
?>