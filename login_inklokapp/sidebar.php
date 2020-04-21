

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box;}

body { 
  font-family: Arial, Helvetica, sans-serif;
}

.sidebar {
  height: 100%;
  overflow: hidden;
  background-color: rgb(43, 43, 43);
  padding: 20px 10px;
  position: fixed;
  top: 0px;
  right: 0px;
}

.sidebar a {
  float: left;
  color: rgb(100, 179, 79);
  text-align: center;
  padding: 15px;
  text-decoration: none;
  line-height: 25px;
}


.sidebar a:hover {
  border-style: none none solid none;
}

.sidebar a.active {
  background-color: dodgerblue;
  color: white;
}

.sidebar img {
  height: 80px;
  width: 80px;
  border-radius: 50px;
}

.sidebar img:hover {
  border-radius: 0px;
}

@media screen and (max-width: 500px) {
  .sidebar a {
    float: none;
    display: block;
    text-align: left;
  }
}
</style>
</head>

<body>

<div class="sidebar">

<?php if (isset($_SESSION['email'])) : ?>
    <?php 
        $currentUserQuery = "SELECT firstName, surname, photoPath FROM users WHERE email = '" . $_SESSION['email'] . "'";
        $resultUser = mysqli_query($db, $currentUserQuery);
        $rowUser = mysqli_fetch_array($resultUser);
    ?>

    <p><strong><?php echo $rowUser['firstName'] . " " . $rowUser['surname']; ?></strong></p>
<?php endif ?>

  <img src="<?php echo $rowUser['photoPath']?>" width="100px" alt="userImg"> </br>
  <a href="index.php">Home</a> </br> 
  <a href="login.php">Inloggen</a> </br>
  <a href="addNewStudent.php">Registreren</a> </br>
  <a href="faceRecognition.py">Face Rec</a> </br>
  <form method="post">
    <button type="submit" class="btn" name="logout_btn">Uitloggen</button>
	</form>
</div>

</body>
</html>