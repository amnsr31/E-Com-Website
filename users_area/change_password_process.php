<?php
    if(isset($_GET['code'])) {
        $code = $_GET['code'];

        $con = new mySqli('localhost', 'root', '', 'mystore');
        if($con->connect_error) {
            die('Could not connect to the database');
        }

        $verifyQuery = $con->query("SELECT * FROM user_table WHERE code = '$code' and updated_time >= NOW() - Interval 1 DAY");

        if($verifyQuery->num_rows == 0) {
            header("Location: index.php");
            exit();
        }
    if(isset($_POST['change'])) {
        $user_email = $_POST['user_email'];
        $new_password = $_POST['new_password'];
    
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    
        $changeQuery = $con->prepare("UPDATE user_table SET user_password = ? WHERE user_email = ? and code = ? and updated_time >= NOW() - INTERVAL 1 DAY");
        $changeQuery->bind_param("sss", $hashed_password, $user_email, $code);
        $changeQuery->execute();
    
        if($changeQuery->affected_rows > 0) {
            header("Location: success.php");
            exit();
        } 
        }
        $con->close();
    }
        else {
            header("Location: index.php");
            exit();
    }
