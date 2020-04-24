<?php 
    // function to get the current page name
    function pageName() 
    {
        return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
    }

    $currentPage = pageName(); 
?>

<div class="sidebar">
    <?php if (isset($_SESSION['email'])) : ?>
        <?php 
            $currentUserQuery = "SELECT firstName, surname, photoPath FROM users WHERE email = '" . $_SESSION['email'] . "'";
            $resultUser = mysqli_query($conn, $currentUserQuery);
            $rowUser = mysqli_fetch_array($resultUser);
        ?>

        <p><strong><?php echo $rowUser['firstName'] . " " . $rowUser['surname']; ?></strong></p>
    <?php endif ?>

    <img src="<?php echo $rowUser['photoPath']?>" width="100px" alt="userImg"> </br>
    <a class=<?php echo $currentPage == 'index.php' ? 'active':NULL;?> href="index.php">Dashboard</a>
    <a href="admin/classview.php">Klas</a>
    <a href="admin/adminhome.php">Admin</a>
    <form method="post">
        <button type="submit" class="btn" name="logout_btn">Uitloggen</button>
	</form>
</div>