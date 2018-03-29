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
      $permissionID = getPermissionID($_REQUEST['cbPerms']);
      $roleID = getRoleID($_REQUEST['cbRoles']);
      if($permissionID!=null && $roleID!=null) 
      {

        if(saveRolePermission($roleID,$permissionID))
        {
            echo '<script language="javascript">';
            echo 'alert("role-permission saved successfully")';
            echo '</script>';
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Unable to save role-permission")';
            echo '</script>';
        } 
      }
      else
        {
            echo '<script language="javascript">';
            echo 'alert("field not filled")';
            echo '</script>';
        } 
    }
?>
<?php include('navbar.php')?>
<!DOCTYPE html>
<head>
</head>
<body>
        <h1 style="text-align:center;font-family:'Courier New', Courier, monospace"><b>WELCOME TO ROLE-PERMISSION MANAGEMENT</b></h1>              
        <div class="container-fluid">
                        <div class="row form-group col-lg-4 col-lg-offset-2">
                            <form>
                                <legend align="center">Role Info Form</legend>
                                <div class="form-group">
                                    <label>Select Roles:</label>
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
                                    <label>Select Permissions:</label>
                                    <select name="cbPerms" class="form-control">
                                    <?php
                                        $permsArr  = getAllPermissions();
                                        echo "<option>---Select---</option>";
                                        foreach($permsArr as $perm)
                                        {
                                            echo "<option value='$perm'>$perm</option>";
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
