<?php include ('config.php'); ?>

<!DOCTYPE html>
<html>
<body>

  <!-- FORM TO UPLOAD IMAGE OR CREATE FOLDER -->
<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="text" name="fileName" id="fileName"> <br>
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload"> <br>
    <input type="submit" value="Upload Image" name="uploadFileBtn">
    <br> <br>
    <input type="text" name="folderName" id="folderName"><br>
    <input type="submit" value="Create Folder" name="createFolderBtn"><br>
    <br> <br>
    <input type="text" name="fileName" id="fileName"><br>
    <input type="submit" value="Create File" name="createFileBtn">
</form>

<hr>

    <!-- IMAGES ARE SHOWN HERE -->
  <ul id="gallery">
    <?php

      $sql_query="SELECT filePath FROM images";
      $resultset = mysqli_query($db, $sql_query) or die("database error:". mysqli_error($db));
      
      while($rows = mysqli_fetch_array($resultset) ) { ?>
        <li>					
            <!-- get $_SERVER['HTTP_REFERER'] from upload_files dir -->
            <!-- img a href here -->
          <img src="http://localhost/crm/upload_files/<?php echo $rows["filePath"]; ?>" class="images"></a>
        </li>

    <?php } ?>
  </ul>		

<hr>
    <!-- FOLDERS ARE SHOWN HERE -->
  <ul id="folders">   
    <?php

      $sql_query2="SELECT folderPath, folderName FROM imageFolders";
      $resultset = mysqli_query($db, $sql_query2) or die("database error:".mysqli_error($db));
      
      while($rows = mysqli_fetch_array($resultset)) { ?>
        <li>
          <a href= <?php echo $rows["folderPath"]; ?> >
          <img src="http://localhost/crm/upload_files/images/folder_inactive.png"></a>
          <?php echo $rows["folderName"]; ?>
        </li>

    <?php } ?>
  </ul>
       
<hr>

</body>
</html>

<style>
#gallery img {
    margin: 15px;
    padding: 5px;
    border: 2px black solid;
    height: 200px;
    width: 200px;
}
#gallery li {
  display: inline;
}
#gallery img:hover{
  border: 2px solid orange;
}
#gallery img:active{
  height: 30%;
  width: 30%;

}

#folders li{
  display: inline;
}
#folders img{
  height: 100px;
  width: 100px;
}
#folders img:hover{
  content: url("http://localhost/crm/upload_files/images/folder_active.png");
}
</style>


<?php
/*
<a href="http://localhost/upload_files/<?php echo $rows["filePath"]; ?>" data-title="<?php echo $rows["filePath"]; ?>">
*/
?>
