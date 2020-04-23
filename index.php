<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <?php include 'functions.php'; ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/stylingglobal.css">
    

</head>
<body> 

    <!-- Sidebar -->
    <?php include 'usersidebar.php';?>

    <div class="content">
    <?php if (isset($_SESSION['email'])) : ?>
        <?php 
            $currentUserQuery = "SELECT firstName, surname, loggedIn FROM users WHERE email = '" . $_SESSION['email'] . "'";
            $resultUser = mysqli_query($conn, $currentUserQuery);
            $rowUser = mysqli_fetch_array($resultUser);
        ?>

        <p>Welkom <strong><?php echo $rowUser['firstName'] . " " . $rowUser['surname']; ?></strong></p>
        <p>
            <?php 
                if($rowUser['loggedIn']== 0){
                    echo 'Je bent niet ingeklokt';
                } else {
                    echo 'Je bent wel ingeklokt';
                }
                echo '<p>Klopt deze status niet? Check je opnieuw in/uit. Mocht dit probleem blijven voorkomen, <br>
            contacteer je netwerkbeheerder.</p>';
            ?>
        </p>
        <form action="functions.php" method="post">
            <button type="submit" name="checkInOut">
                <?php 
                    if($rowUser['loggedIn']== 0){
                        echo 'Inklokken';
                    } else {
                        echo 'Uitklokken';
                    }
                ?>
            </button>
        </form>
    <?php endif ?>
    <?php presenceHistory(); ?>
        
</div>
</body>
</html>