<?php
//include 'change password.php';
$conn = new mysqli('localhost', 'root', '', 'accessaciti');
if (isset($_POST['Change password']));
//else $error = "An error has occured, go to previous page";
extract($_POST);

if (isset($_SESSION["valid"]) && $_SESSION["valid"]) :
    $username = $_SESSION['username'];

    $password_hash = password_hash($newpassword, PASSWORD_BCRYPT);

    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
    $verifypassword = $_POST['verifypassword'];
    if ($oldpassword != "" && $newpassword != "" && $verifypassword != "") :
        if ($newpassword == $verifypassword) :
            if ($newpassword != $oldpassword) :
                $sql = "SELECT * FROM user WHERE user_id = " . $_SESSION["userid"] . ";";
                $conn_check = $conn->query($sql);
                if (password_verify($oldpassword, $conn_check->fetch_assoc()['password_hash'])) :
                    $fetch = $conn->query("UPDATE user SET 'password_hash` = '$newpassword' WHERE username ='$username'");
                    if ($fetch === True) 
                    {
                        header ("location: Password changed.html");
                        exit();
                    } else 
                    {
                        echo "Not successfull";
                    }            
                    $oldpassword = '';
                    $newpassword = '';
                    $verifypassword = '';
                    $msg_sucess = "Password successfully updated!";
                else :
                    echo "Old password is incorrect. Please try again.";
                endif;
            else :
                echo "Old password and new password are the same. Please try again.";
            endif;
        else :
            echo "New password and confirm password do not match.";
        endif;
    else :
        echo "Please fill all the fields";
    endif;
else:
    echo "You are not logged in";
endif;
