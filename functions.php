<?php
     session_start();

    //Connection string
    $conn = new mysqli("remotemysql.com", "Fexz7WTpQa", "IREHEvij1U", "Fexz7WTpQa");
    $currentUser = '101';

    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }

    //initializing variables
    $email = "";
    $errors = array();
    $fileToUpload = "";

    //CHECKS IF THE USER IS LOGGED IN
    function checkLogin(){
        session_start();

        if (!isset($_SESSION['email'])) {
            $_SESSION['msg'] = "U moet eerst inloggen";
            header('location: login.php');
        }

        if (isset($_GET['logout'])) {
            session_destroy();
            unset($_SESSION['email']);
            header("location: login.php");
        }
        
        session_write_close();
    }

    //LOGIN
    if (isset($_POST['login_btn'])) {
        //create vars with input data
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

            //form validation
        if (empty($email)) { array_push($errors, "E-mailadres ontbreekt"); }
        if (empty($password)) { array_push($errors, "Wachtwoord ontbreekt"); }

            //if there are no errors check if login credentials are correct
        if (count($errors) == 0) {
            //$password = md5($password);
            $loginQuery = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $loginResult = mysqli_query($conn, $loginQuery);

            if (mysqli_num_rows($loginResult) == 1) {
            $_SESSION['email'] = $email;
            $_SESSION['success'] = "U bent nu ingelogd";
            header('location: index.php');
            }else { array_push($errors, "Verkeerd e-mail/wachtwoord combinatie"); }
        }
    }

    if (isset($_POST['logout_btn'])) {
        session_destroy();
        //unset($_SESSION['email']);
        header("location: login.php");
    }

    function presenceHistory()
    {
        global $conn, $currentUser;
        $date = date('Y-m-d H:i:s');
    
        $weekStartTime = (new DateTime())->setISODate(date("Y"), idate('W'))->format('Y-m-d');   //start date monday
        $weekEndTime   = (new DateTime())->setISODate(date("Y"), idate('W'), 5)->format('Y-m-d'); //end date friday

        echo $weekStartTime;
        echo "<br>";
        echo $weekEndTime;
        echo "<br>";
        $query = "SELECT dateStamp, checkTime, newStatus FROM checkInOutTimes WHERE studentNumber = '$currentUser'"; //AND $date >= $weekStartTime AND $date <= $weekEndTime
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                if(($row['dateStamp'] <= $weekStartTime) && ($row['dateStamp'] >= $weekEndTime)) 
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

    if(isset($_POST['checkInOut'])) {
        session_start();
      
        $currentUserQuery = "SELECT loggedIn FROM users WHERE email = '" . $_SESSION['email'] . "'";
        $resultUser = mysqli_query($conn, $currentUserQuery);
        $rowUser = mysqli_fetch_array($resultUser);
        
        
        if($rowUser['loggedIn']== 0){
          $sql = "UPDATE users SET loggedIn = 1 WHERE email = '" . $_SESSION['email'] . "'";
        } else {
          $sql = "UPDATE users SET loggedIn = 0 WHERE email = '" . $_SESSION['email'] . "'";
        }
        echo $sql;
        mysqli_query($conn, $sql);
        header('location: index.php');
      
        session_write_close();
      }
?>