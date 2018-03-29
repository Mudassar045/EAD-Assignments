<?php
    require('function-utils.php');
?>
<?php 
    if($_SESSION["utype"]!=1)
    {
        header('Location:login.php');
        exit();
    }
?>
<?php include('navbar.php')?>
<!DOCTYPE html>
<head>
<body>
        <h1 style="text-align:center;font-family:'Courier New', Courier, monospace"><b>SYSTEM LOGIN HISTORY</b></h1>              
                    <div class="col-lg-5 col-lg-offset-3">
                            <table class="table" name="infoTable">
                                <legend align="center">LOGIN HISTORY</legend>
                                <tr>
                                    <th>ID</th>
                                    <th>UserID</th>
                                    <th>Login</th>
                                    <th>Login Date/Time</th>
                                    <th>MachineIP</th>
                                </tr>
                                <?php
                                    getLoginHistory();
                                ?>
                            </table>
                    </div>
</body>
</html
