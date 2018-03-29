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
        <h1 style="text-align:center;font-family:'Courier New', Courier, monospace"><b>USER-ROLE INFO LIST</b></h1>              
                    <div class="col-lg-6 col-lg-offset-3">
                            <table class="table" name="infoTable" style="align:center;">
                                <legend align="center"> USER-ROLE Info Table</legend>
                                <tr>
                                    <th>UserID</th>
                                    <th>Name</th>
                                    <th>Role ID</th>
                                    <th>Role</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            <?php
                              getUserRoleInfo();
                            ?>
                            </table>
                    </div>
</body>
</html
