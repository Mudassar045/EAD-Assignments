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
      $userID = getUserID($_REQUEST['cbUsers']);
      $roleID = getRoleID($_REQUEST['cbRoles']);
      if($userID!=null && $roleID!=null) 
      {
        if(saveUserRole($userID,$roleID))
        {
            echo '<script language="javascript">';
            echo 'alert("User-role saved successfully")';
            echo '</script>';
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Unable to save user-role")';
            echo '</script>';
        } 
      }   
    }
?>
<?php include('navbar.php')?>
<!DOCTYPE html>
<head>
</head>
<body>
        <h1 style="text-align:center;font-family:'Courier New', Courier, monospace"><b>WELCOME TO USER-ROLE MANAGEMENT</b></h1>              
        <div class="container-fluid">
                        <div class="row form-group col-lg-4 col-lg-offset-2">
                            <form method="POST">
                                <legend align="center">User-Role Info Form</legend>
                                <div class="form-group">
                                    <label>Roles:</label>
                                    <select name="cbRoles" class="form-control">
                                    <?php
                                        $rolesArr  = getAllRoles();
                                        echo "<option>---Select---</option>";
                                        foreach($rolesArr as $role)
                                        {
                                            echo "<option value='$role'>$role</option>";
                                        }
                                    ?> 
                                    </select>
                                </div>
                                <div class="form-group">
                                <label>User:</label>
                                <select name="cbUsers" class="form-control">
                                    <?php
                                        $usersArr  = getAllUsers();
                                        echo "<option>---Select---</option>";
                                        foreach($usersArr as $user)
                                        {
                                            echo "<option value='$user'>$user</option>";
                                        }
                                    ?> 
                                </select>
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
