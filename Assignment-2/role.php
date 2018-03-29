<?php
    require('function-utils.php');
?>
<?php 
    if($_SESSION["utype"]!=1)
    {
        header('Location:login.php');
        exit();
    }
    if(isset($_POST['savebtn']))
    {
        $roleName = $_REQUEST['roleName'];
        $roleDescription = $_REQUEST['description'];
        $userID = $_SESSION['userid'];
        if($roleName!=null && $roleDescription!=null)
        {
            if(saveRole($roleName,$roleDescription,$userID))
            {
                echo '<script language="javascript">';
                echo 'alert("role saved successfully")';
                echo '</script>';
            }
            else
            {
                echo '<script language="javascript">';
                echo 'alert("Unable to save role")';
                echo '</script>';
            } 
        }
        else
        {
                echo '<script language="javascript">';
                echo 'alert("fill all required fields")';
                echo '</script>';
        }
    }
?>
<?php include('navbar.php')?>
<!DOCTYPE html>
<head>
<body>
        <h1 style="text-align:center;font-family:'Courier New', Courier, monospace"><b>WELCOME TO ROLE MANAGEMENT</b></h1>              
        <div class="container-fluid">
                        <div class="row form-group col-lg-4 col-lg-offset-2">
                            <form method="GET">
                                <legend align="center">Role Info Form</legend>
                                <div class="form-group">
                                    <label>Role:</label>
                                    <input type="text" name="roleName" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Description:</label>
                                    <input type="text" name="description" class="form-control">
                                </div>
                                <div class="form-group">
                                <input type="reset" value="Clear" class="btn  btn-danger col-lg-6">
                                <input type="submit" name="savebtn" value="Save" class="btn  btn-success col-lg-6">
                                </div>
                            </form>
                        </div>
                </div>
                </body>
</html
