<?php
    require('function-utils.php');
?>
<?php
    if($_SESSION["utype"]!=2)
    {
        header('Location:login.php');
        exit();
    }
    $uid = $_SESSION['userid'];
?>
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
<!DOCTYPE html>
<head>
</head>
<body>
        <ul>
                <li><a href="./home.php" style="text-decoration:none;font-size:15">Home</a></li>
                <li><input type="submit" style="padding-top:13px;text-decoration:none;color:white;" class="btn-link btnlogout" name="logout" value='Logout'></li>
        </ul>
        <h1 style="text-align:center; font-family:'Courier New', Courier, monospace"><b>WELCOME USER TO HOMEPAGE</b></h1>
        <div>
        <div class="col-lg-6 col-lg-offset-3">
                            <table class="table" name="infoTable1" style="align:center;">
                                <legend align="center"> USER ROLE</legend>
                                <tr>
                                    <th>Role</th>
                                    <th>Description</th>
                                </tr>
                            <?php
                              getUserRoleByID($uid);
                            ?>
                            </table>
        </div>
        <br>
        <div class="col-lg-6 col-lg-offset-3">
                        <table class="table" name="infoTable2" style="align:center;">
                                <legend align="center"> USER PERMISSIONS</legend>
                                <tr>
                                    <th>Permission</th>
                                    <th>Description</th>
                                </tr>
                            <?php
                              getRolePermissionByID($uid);
                            ?>
                       </table>
        </div>
        </div>
</body>
</html>