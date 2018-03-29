<?php
    require('function-utils.php');
?>
<?php
    if($_SESSION["utype"]!=1)
    {
        header('Location:login.php');
        exit();
    }
    $uuid ='';
    if (empty($_GET))
    {
      // nothing will be done   
    }
    else
    {
        $uuid = $_GET['uid'];
    }
    if($uuid!=null && $uuid!=0)
    {
        if(deleteUserByID($uuid))
        {
            echo '<script language="javascript">';
            echo 'alert("Record deleted successfully")';
            echo '</script>';
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Unable to delete record")';
            echo '</script>';
        }
    }
?>
<?php include('navbar.php')?>
<!DOCTYPE html>
<head>
<body>
        <h1 style="text-align:center;font-family:'Courier New', Courier, monospace"><b>USER INFO LIST</b></h1>              
                    <form>
                    <div class="col-lg-6 col-lg-offset-3">
                            <table class="table" name="infoTable" style="align:center;">
                                <legend align="center">   USER Info Table</legend>
                                <tr>
                                    <th>ID</th>
                                    <th>Login</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Country</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            <?php
                              getUserInfo();
                            ?>
                            </table>
                    </div>
                    </form>
</body>
</html
