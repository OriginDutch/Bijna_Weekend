<?php
    $conn = new mysqli("remotemysql.com", "Fexz7WTpQa", "IREHEvij1U", "Fexz7WTpQa");

    if(isset($_POST['registerPerson']))
    {
        $firstName      = $_POST['firstName'];
        $surname        = $_POST['surname'];
        $studentNumber  = $_POST['studentNumber'];
        $email          = $_POST['email'];
        $userType       = $_POST['userType'];
        $passwordOne    = $_POST['passwordOne'];
        $passwordTwo    = $_POST['passwordTwo'];
        //$photoPath      = $_POST[''];
        $loggedIn       = 0;

        $sql = "INSERT INTO users(firstName, surname, studentNumber, userType, email, password, loggedIn) VALUES('$firstName', '$surname', '$studentNumber', '$userType', '$email', '$passwordOne', '$loggedIn')";
                //echo $sql;
        mysqli_query($conn, $sql);
    }

    if(isset($_POST['newClass']))
    {
        $className = $_POST['className'];
        $study     = $_POST['study'];

        $sql = "INSERT INTO classes(className, study) VALUES('$className', '$study')";
                //echo $sql;
        mysqli_query($conn, $sql);
    }

    if(isset($_POST['changeUserInfo']))
    {
        $studentID      = $_POST['studentID'];
        $firstName      = $_POST['firstName'];
        $surname        = $_POST['surname'];
        $studentNumber  = $_POST['studentNumber'];
        $class          = $_POST['personClass'];
		$email          = $_POST['email'];
		$sql = "UPDATE users SET firstName = '$firstName', surname = '$surname', studentNumber = '$studentNumber', class = '$class', email = '$email'  WHERE id='$studentID'";
        mysqli_query($conn, $sql);
		//header("location: studentList.php");
    }

    function loadUserListAdmin() 
    {				// Loads the list of teams available in the admin page to edit
		global $conn;
		$sql = "SELECT id, firstName, surname, studentNumber, class, email FROM users";
		$result = mysqli_query($conn, $sql);
        if($result) 
        {
			echo "<table>";
            echo "<th>Voornaam</th>";
            echo "<th>Achternaam</th>";
            echo "<th>Studentnummer</th>";
            echo "<th>Klas</th>";
            echo "<th>Email</th>";
			while($row = mysqli_fetch_assoc($result)){
                echo "<form method='post'>";
				echo "<tr>";
                echo "<td><input type='text' name='firstName' value='"      . $row['firstName']     . "'></td>";
                echo "<td><input type='text' name='surname' value='"        . $row['surname']       . "'></td>";
                echo "<td><input type='text' name='studentNumber' value='"  . $row['studentNumber'] . "'></td>";
                echo "<td> <select name='personClass' class='multiOption'>";
                    echo loadClassList();
                echo "</select></td>";   
                echo "<td><input type='text' name='email' value='"          . $row['email']         . "'></td>";
                
                echo "<td><button type='submit' name='changeUserInfo'>Aanpassen</button><td>";
                echo "<td><input type='hidden' name='studentID' value='" . $row['id'] . "'><td>";
                echo "</tr>";	
                echo "</form>";		
			}
			echo "</table";
		}
    }

    function loadClassList() 
    {  
        global $conn;
        $grabClass = "SELECT className from classes";
        $result = mysqli_query($conn, $grabClass);

        if($result)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                echo $row['className'];
                $value = $row['className'];
                echo "<option value='$value'>$value</option>";
            }
        }
    }

    function loadClassOverview()
    {
        global $conn;
        $grabClasses = "SELECT id, className, study FROM classes";
        $result = mysqli_query($conn, $grabClasses);
        if($result)
        {
            echo "<table>";
            echo "<th>Klas</th>";
            echo "<th>Studie</th>";
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>";
                    echo "<form method=submit>";
                    echo "<td>" . $row['className'] . "</td>";
                    echo "<td>" . $row['study'] . "</td>";
                    
                    echo "<td><input type='hidden' value='" . $row['className'] . "' name='name'></td>";
                    echo "<td><button type='submit' formaction='viewStudents.php()'>Bekijken</button></td>";
                    echo "</form>";
                echo "</tr>";
            } 
        }
    }


?>