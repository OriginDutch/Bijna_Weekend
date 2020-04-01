<?php
    //Connection string
    $conn = new mysqli("remotemysql.com", "Fexz7WTpQa", "IREHEvij1U", "Fexz7WTpQa");

    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    } 

    //Is the student present?
    function presence()
    {
        global $conn;
        $CurrentUser = '101';
        $Sql = "SELECT loggedIn FROM Users WHERE studentNumber='$CurrentUser'";
        $Result = mysqli_query($conn, $Sql);
        if (mysqli_num_rows($Result) > 0) 
        {
            while($row = mysqli_fetch_assoc($Result)) 
            {
                echo $row['loggedIn'] = 1 ? "aanwezig" : "afwezig";
            }
        }
    }
?>