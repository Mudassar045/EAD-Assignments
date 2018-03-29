<?php
    require('function-utils.php');
?>
<!DOCTYPE html>
<head>
    <?php 
        $Login_Status = false;
        if(isset($_POST["btn_loguser"]))
        {
            $username = $_REQUEST["username"];
            $password = $_REQUEST["password"];
            $isValidated = isUserValidated($username,$password);
            if($isValidated==1)
            {
                setLoginHistory($username,$_SESSION['userid']);
                header("Location:home.php");
                exit();
            }
            else if($isValidated==2)
            {
                setLoginHistory($username,$_SESSION['userid']);
                header("Location:home.php");
                exit();
            }
            else
            {
                session_destroy();
                header('Location:login.php');
                exit();
            }
        }
    ?>
    <link rel="stylesheet" href="css/loginformat.css">
    <meta charset="UTF-8">
    <title>EAD Assignment-2</title>
</head>
<body>
    <table align="center" style="margin:150px 200px 150px 470px">
    <tr>
    <td>
        <div style="margin:-40px 0px; position:center">
        <h1 style="color:white; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">SECURITY MANAGER</h1>
        </div>    
        <div class="login-page">
            <div class="form">
                <form class="login-form" method="POST">
                    <h3><b>User Login<b></h3>
                    <input required type="text" name="username" placeholder="username"/>
                    <input required type="password" name="password" placeholder="password"/>
                    <input style="background:green;cursor:progress;" name="btn_loguser" type="submit" value="Login">
                </form>
            </div>
        </div>
    </div>
    </td>
   </tr> 
   </table>
</body>
</html>