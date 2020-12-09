<?php

session_start();

include '../libraries/chocolates.php';

$visit=$_SESSION['visit'];

function check_passwordu($user_name, $password)
{
    
    $con = getCon();
    
    $user = $con->query("select * from user where user_name='$user_name';");
    $res  = $user->fetch_assoc();
    
    echo var_dump($res) . "<br>";
    
    $password_hash = $res['password'];
    
    if (password_verify($password, $password_hash)) {
        echo "password verified<br>";
        return True;
    } else {
        echo "password not verified<br>";
        return False;
    }
}





if (isset($_POST['login_user'])) {
    $user_name = $_POST['user_name'];
    $email = $_POST['username'];
    //$user_name = str_replace(' ', '', $user_name);
    $user_name = strtolower($user_name);
    $password  = $_POST['password'];
    
    if (rowExists('user', 'user_name', $user_name)) {
        if (check_passwordu($user_name, $password)) {
            //echo "Yes";
            
            $_SESSION['user_name'] = $user_name;
            header("Location:../".$visit);
            die();
        } else {
            $wrongpassword = true;
            header("Location:sign_in.php?signinwhich=login&&wrongpassword=" . $wrongpassword."&&visit=".$visit);
            echo "no2 [password wrong]";
        }
    } else {
        //echo "no1 [user doesn't exist]";
        header("Location:sign_in.php?signinwhich=register&&visit=".$visit."&&user=no");
        die();
    }
}



?>
