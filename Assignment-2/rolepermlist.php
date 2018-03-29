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
        <h1 style="text-align:center;font-family:'Courier New', Courier, monospace"><b>ROLE PERMISSION INFO LIST</b></h1>              
                    <div class="col-lg-5 col-lg-offset-3">
                            <table class="table" name="infoTable">
                                <legend align="center">Role-Permission Info Table</legend>
                                <tr>
                                    <th>RoleID</th>
                                    <th>Name</th>
                                    <th>PermissionID</th>
                                    <th>Role</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            <?php
                              getRolePermissionInfo();
                            ?>
                            </table>
                    </div>
</body>
</html
