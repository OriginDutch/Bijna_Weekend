<?php
    $conn = new mysqli("remotemysql.com", "Fexz7WTpQa", "IREHEvij1U", "Fexz7WTpQa");

    if(isset($_POST['fromPerson']))
    {
        $firstName      = mysql_real_escape_string($_POST['firstName']);
        $surname        = mysql_real_escape_string($_POST['surname']);
        $studentNumber  = mysql_real_escape_string($_POST['studentNumber']);
        $email          = mysql_real_escape_string($_POST['email']);
        $passwordOne    = mysql_real_escape_string($_POST['passwordOne']);
        $passwordTwo    = mysql_real_escape_string($_POST['passwordTwo']);
        $photoPath      = mysql_real_escape_string($_POST['']);

        $sql = "INSERT INTO Users(firstName, surname, studentNumber, email, passwordOne)
                VALUES('$firstName', '$surname', '$studentNumber', '$email', '$passwordOne')";
                echo $sql;
        //mysqli_query($conn, $sql);
    }
    




?>