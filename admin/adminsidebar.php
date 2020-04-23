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
    <a href="../index.php">Dashboard</a>
    <a href="classview.php">Klas</a>
    <a class="active" href="adminhome.php">Admin</a>
    <a href="#about">4</a>
    <form method="post">
        <button type="submit" class="btn" name="logout_btn">Uitloggen</button>
	</form>
</div>