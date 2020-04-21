<!--
    Author: Marcel & Aina
    Last edited: 16 April 2020
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/stylingglobal.css">
    <?php include('functions.php'); ?>

</head>
<body> 

    <!-- Sidebar -->
    <?php include 'sidebar.php';?>
    <div class="content">
        <form action="functions.php" method="post" enctype="multipart/form-data">
            <label for="text">Naam leerling</label><br>
            <input type="text" placeholder="voornaam" name="firstName"><br>
            <input type="text" placeholder="achternaam" name="surname"><br>
            <label for="text">Studentnummer</label><br>
            <input type="text" placeholder="studentnummer" name="studentNumber"><br>
            <label for="text">Email</label><br>
            <input type="email" placeholder="email" name="email"><br>
            <label for="text">Leerling of Admin</label><br>
            <select name="userType" placeholder="gebruikerstype" class="multiOption">
                <option value="0">Leerling</option>
                <option value="1">Leraar</option>
            </select><br>
            <label for="text">Wachtwoord</label><br>
            <input type="password" placeholder="wachtwoord" name="passwordOne"><br>
            <input type="password" placeholder="wachtwoord herhalen" name="passwordTwo"><br>
            <label for="text">Foto</label><br>
            <input type="file" placeholder="foto" name="fileToUpload" id="fileToUpload"><br> <!-- was photopath -->
            <br>
            <button type="submit" name="registerPerson">Aanmaken</button>
        </form>

        <button onclick="history.go(-1);">Back </button>
    </div>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>