<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/stylingglobal.css">
    <?php include '../functions.php'; ?>
    <?php include 'adminfunctions.php'; ?>

</head>
<body> 
    <?php include 'adminsidebar.php';?>
    <div class="content">
        <form method="post" enctype="multipart/form-data">
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
</body>
</html>