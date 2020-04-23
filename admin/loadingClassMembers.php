<?php
    include 'admin.php';
    //$class = $_POST['name'];
    echo "no";
    echo $class;
    echo "yes";
    $grabMembers = "SELECT firstName, surName, studentNumber, email, loggedIn FROM users WHERE class='$class'";
    $result = mysqli_query($conn, $grabMembers);
    if($result) 
    {
        echo "<table>";
        echo "<th>Voornaam</th>";
        echo "<th>Achternaam</th>";
        echo "<th>Studentnummer</th>";
        echo "<th>Email</th>";
        echo "<th>Status</th>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td><input type='text' name='firstName' value='"      . $row['firstName']     . "'></td>";
            echo "<td><input type='text' name='surname' value='"        . $row['surname']       . "'></td>";
            echo "<td><input type='text' name='studentNumber' value='"  . $row['studentNumber'] . "'></td>"; 
            echo "<td><input type='text' name='email' value='"          . $row['email']         . "'></td>";
            echo "<td><input type='text' name='status' value='"         . $row['status']        . "'></td>";
            echo "</tr>";		
        }
        echo "</table";
    }
?>