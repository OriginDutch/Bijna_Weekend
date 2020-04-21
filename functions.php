<?php
    //Connection string
    $conn = new mysqli("remotemysql.com", "Fexz7WTpQa", "IREHEvij1U", "Fexz7WTpQa");
    $currentUser = '101';

    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }

    //Is the student present?
    function presence()
    {
        global $conn,$currentUser;
        $query = "SELECT loggedIn FROM users WHERE studentNumber='$currentUser'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result)) 
            {
                echo $row['loggedIn'] = 1 ? "aanwezig" : "afwezig";
            }
        }
    }

    function presenceHistory()
    {
        global $conn, $currentUser;
        $date = date('Y-m-d H:i:s');
    
        $weekStartTime = (new DateTime())->setISODate(date("Y"), idate('W'))->format('Y-m-d');   //start date monday
        $weekEndTime   = (new DateTime())->setISODate(date("Y"), idate('W'), 5)->format('Y-m-d'); //end date friday

        //echo $weekStartTime;
        //echo "<br>";
        //echo $weekEndTime;
        //echo "<br>";
        $query = "SELECT dateStamp, checkTime, newStatus FROM checkInOutTimes WHERE studentNumber = '$currentUser'"; //AND $date >= $weekStartTime AND $date <= $weekEndTime
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0)
        {
            
            while($row = mysqli_fetch_assoc($result))
            {
                if(($row['dateStamp'] != $weekStartTime) && ($row['dateStamp'] != $weekEndTime)) 
                {
                    echo "<table>";
                    echo "<th>Datum</th>";
                    {
                        echo "<tr>";
                        echo "<td>" . $row['dateStamp'] . "";
                        echo "</tr>";
                    } 
                   
                }
            }         
        }

    }
?>