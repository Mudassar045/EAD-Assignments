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
        <h1 style="text-align:center;font-family:'Courier New', Courier, monospace"><b>ROLE INFO LIST</b></h1>              
                    <div class="col-lg-5 col-lg-offset-3">
                            <table class="table" name="infoTable">
                                <legend align="center">Role Info Table</legend>
                                <tr>
                                    <th>ID</th>
                                    <th>Role Name</th>
                                    <th>Description</th>
                                    <th>Login Date/Time</th>
                                    <th>Createdby</th>
                                </tr>
                                <?php
                                    getRoleInfo();
                                ?>
                            </table>
                    </div>
</body>
</html
