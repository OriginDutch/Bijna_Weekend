<?php
    $conn = new mysqli("remotemysql.com", "Fexz7WTpQa", "IREHEvij1U", "Fexz7WTpQa");



  //initializing variables
    $email = "";
    $errors = array();
    $fileToUpload = "";


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
        header("location: ../login.php");
    }
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


        $target_dir = "D:XAMPP/htdocs/Bijna_Weekend/photos/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $photoPath = "http://localhost/bijna_weekend/photos/" . basename($_FILES["fileToUpload"]["name"]);
        // UPLOADING A  FILE
        // Check if image file is an actual image or fake image.
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "Bestand is een afbeelding - " . $check["mime"] . ".<br>";
                $uploadOk = 1;
            } else {
                echo "Bestand is niet een afbeelding.<br>";
                $uploadOk = 0;
            }
        
        
        // Check if file already exists
        if (file_exists($target_file)) {
        echo "Het bestand bestaat al.<br>";
        $uploadOk = 0;
        }
        
        // Check if file size exceeds 500KB.
        if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Uw bestand is te groot.<br>";
        $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Alleen JPG, JPEG, PNG & GIF bestanden zijn toegestaan.<br>";
        echo $target_file;
        $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        echo "<br>Uw bestand is niet geüpload.<br>";
        
            // if everything is ok, try to upload file and send path to database.
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "Het bestand ". basename( $_FILES["fileToUpload"]["name"]). " is geüpload.";
                
            
                
                //header('location: index.php');
            } else {
                echo "Er is een probleem opgetreden tijdens het uploaden van uw bestand.<br>";
            }
            $target_dir = "D:XAMPP/htdocs/Bijna_Weekend/photos/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // UPLOADING A  FILE
            // Check if image file is an actual image or fake image.
            if(isset($_POST["uploadFileBtn"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "Bestand is een afbeelding - " . $check["mime"] . ".<br>";
                    $uploadOk = 1;
                } else {
                    echo "Bestand is niet een afbeelding.<br>";
                    $uploadOk = 0;
                }
            }
            
            // Check if file already exists
            if (file_exists($target_file)) {
            echo "Het bestand bestaat al.<br>";
            $uploadOk = 0;
            }
            
            // Check if file size exceeds 500KB.
            if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Uw bestand is te groot.<br>";
            $uploadOk = 0;
            }
            
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Alleen JPG, JPEG, PNG & GIF bestanden zijn toegestaan.<br>";
            echo $target_file;
            $uploadOk = 0;
            }
            
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
            echo "<br>Uw bestand is niet geüpload.<br>";
            
                // if everything is ok, try to upload file and send path to database.
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "Het bestand ". basename( $_FILES["fileToUpload"]["name"]). " is geüpload.";
                    
                    //$uploadFileQuery = "INSERT INTO users(photoPath) VALUES('$photoPath')";
                    $uploadFileQuery = "INSERT INTO users(firstName, surname, studentNumber, userType, email, password, loggedIn, photoPath) VALUES('$firstName', '$surname', '$studentNumber', '$userType', '$email', '$passwordOne', '$loggedIn', '$photoPath')";
                    mysqli_query($conn, $uploadFileQuery);
                    
                    header('location: ../index.php');
                } else {
                    echo "Er is een probleem opgetreden tijdens het uploaden van uw bestand.<br>";
                }
            }

            $sql = "INSERT INTO users(firstName, surname, studentNumber, userType, email, password, loggedIn, photoPath) VALUES('$firstName', '$surname', '$studentNumber', '$userType', '$email', '$passwordOne', '$loggedIn', '$photoPath')";
                    //echo $sql;
            mysqli_query($conn, $sql);
            header('location: studentList.php');
        }
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
		$sql = "SELECT id, firstName, surname, studentNumber, class, email, loggedIn FROM users";
		$result = mysqli_query($conn, $sql);
        if($result) 
        {
			echo "<table>";
            echo "<th>Voornaam</th>";
            echo "<th>Achternaam</th>";
            echo "<th>Studentnummer</th>";
            echo "<th>Klas</th>";
            echo "<th>Email</th>";
            echo "<th>Status</th>";
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
                echo "<td><input type='text' name='status' value='"         . $row['loggedIn']      . "'></td>";                
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
                    echo "<form method=post>";
                    echo "<td>" . $row['className'] . "</td>";
                    echo "<td>" . $row['study'] . "</td>";
                    
                    echo "<td><input type='hidden' value='" . $row['className'] . "' name='className'></td>";
                    echo "<td><button type='submit' name='goToClass'>Bekijken</button></td>";
                    echo "</form>";
                echo "</tr>";
            } 
        }
    }

    if(isset($_POST['goToClass']))
    {
        $_SESSION['currentClass'] = $_POST['className'];
        header('location: viewStudents.php');
    }

    function loadClassMembers() 
    {   
        global $conn;
        $class = $_SESSION['currentClass'];
        $sql = "SELECT id, firstName, surname, studentNumber, email, class, loggedIn FROM users WHERE class='$class'";
		$result = mysqli_query($conn, $sql);
        if($result) 
        {
			echo "<table>";
            echo "<th>Voornaam</th>";
            echo "<th>Achternaam</th>";
            echo "<th>Studentnummer</th>";
            echo "<th>Email</th>";
            echo "<th>Status</th>";
			while($row = mysqli_fetch_assoc($result)){
                echo "<form method='post'>";
				echo "<tr>";
                echo "<td><input type='text' name='firstName' value='"      . $row['firstName']     . "'></td>";
                echo "<td><input type='text' name='surname' value='"        . $row['surname']       . "'></td>";
                echo "<td><input type='text' name='studentNumber' value='"  . $row['studentNumber'] . "'></td>"; 
                echo "<td><input type='text' name='email' value='"          . $row['email']         . "'></td>";
                echo "<td><input type='text' name='status' value='"         . $row['loggedIn']      . "'></td>";                
                echo "<td><button type='submit' name='changeUserInfo'>Aanpassen     </button>            </td>";
                echo "<td><input type='hidden' name='studentID' value='"    . $row['id']            . "'></td>";
                echo "</tr>";	
                echo "</form>";		
			}
            echo "</table>";
        }
    }
?>