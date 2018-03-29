<?php
    if($_SESSION["utype"]!=1)
    {
        header('Location:login.php');
        exit();
    }
?>
<!DOCTYPE html>
<head>    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/jquery.js" type="text/javascript"></script>
    <script src='bootstrap/js/bootstrap.min.js'></script>
    <script src='bootstrap/js/jquery.min.js'></script>
    <script src="js/SecurityManager.js"></script>
    <link rel="stylesheet" href="css/adminhomeformat.css">
    <title>EAD Assignment-2</title>
</head>
<?php
    if(isset($_POST["logout"]))
    {
        echo "Logout";
        $_SESSION = array();
        // sends as Set-Cookie to invalidate the session cookie
        if (isset($_COOKIE[session_name()]))
         { 
            $params = session_get_cookie_params();
            setcookie(session_name(), '', 1, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
        }
        session_destroy();
        header('Location:login.php');
        exit();
    }
?>
<body>
        <ul>
                <li><a href="./home.php" style="text-decoration:none;font-size:15">Home</a></li>
                <li><a href="./user.php" style="text-decoration:none;font-size:15">User Management</a></li>
                <li><a href="./role.php"style="text-decoration:none;font-size:15">Role Management</a></li>
                <li><a href="./permission.php" style="text-decoration:none;font-size:15">Permission Management</a></li>
                <li><a href="./rolepermission.php" style="text-decoration:none;font-size:15">Role-Permission Management</a></li>
                <li><a href="./userrole.php" style="text-decoration:none;font-size:15">User-Role Management</a></li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="text-decoration:none;font-size:15">View Lists</a>
                  <ul class="dropdown-menu">
                    <a href="./LoginHistory.php">Login History</a>
                    <a href="./userlist.php">Users</a>
                    <a href="./rolelist.php">Roles</a>
                    <a href="./permissionlist.php">Permissions</a>
                    <a href="./userrole.php">User-role</a>
                    <a href="./rolepermission.php">Role-permission</a>
                  </ul>
                </li>
                <li><input type="submit" style="padding-top:13px;text-decoration:none;color:white;" class="btn-link btnlogout" name="logout" value='Logout'></li>
        </ul>
</body>
</html>