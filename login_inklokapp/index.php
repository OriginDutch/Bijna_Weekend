<?php
include('functions.php');
include('sidebar.php');
?>

<?php
checkLogin();
session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css?version=51">
</head>

<body>
    <h2>Home</h2>

<?php if (isset($_SESSION['email'])) : ?>
    <?php 
        $currentUserQuery = "SELECT firstName, surname, loggedIn FROM users WHERE email = '" . $_SESSION['email'] . "'";
        $resultUser = mysqli_query($db, $currentUserQuery);
        $rowUser = mysqli_fetch_array($resultUser);
    ?>

    <p>Welkom <strong><?php echo $rowUser['firstName'] . " " . $rowUser['surname']; ?></strong></p>
    <p>Je inklokstatus is <strong><?php echo $rowUser['loggedIn']; ?></strong></p>
    <p>
        <?php 
            if($rowUser['loggedIn']== 0){
                echo 'Je bent niet ingeklokt';
            } else {
                echo 'Je bent wel ingeklokt';
            }
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




</body>

</html>

<?php session_write_close(); ?>