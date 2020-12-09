<?php include '../libraries/chocolates.php';

if (isset($_POST['register_user']))
{
    $con = getCon();

    $u = $_POST['user_name'];
    //$u = str_replace(' ', '', $u);
    $e = $_POST['email'];
    $p = $_POST['password'];
    $u=strtolower($u);

    
    if (rowExists('commonpasswords', 'possible_password', $p) || $u == $p)
    {
        $commonpassword = true;
        header("Location:signin.php?signinwhich=register&&commonpassword=" . $commonpassword . "user_name=" . $u . "email=" . $e);
        die();
    }
    
    $p = password_hash($p, PASSWORD_DEFAULT);

    if (rowExists('user', 'user_name', $u))
    {
        $userexists = true;
        header("Location:signin.php?signinwhich=register&&userexists=" . $userexists);
        die();

    }
    else if (rowExists('user', 'email', $e))
    {
        $emailexists = true;
        header("Location:signin.php?signinwhich=register&&emailexists=" . $emailexists);
        die();

    }
    else
    {
        if (($con->query("insert into user(user_name,email,password) values('$u','$e','$p');")) === True)
        {
            //echo "YES";
            header("Location:signin.php?singinwhich=login&&loginnow=yes");
            die();
        }
        else
        {
            $error = true;
            header("Location:signin.php?signinwhich=register&&emailexists=" . $error);
            die();
        }
    }
}

?>
