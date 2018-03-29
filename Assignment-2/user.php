<?php
    require('function-utils.php');
?>
<?php
    $uuid = '';
    if($_SESSION["utype"]!=1)
    {
        header('Location:login.php');
        exit();
    }
    if (empty($_GET))
    {
      // nothing will be done   
    }
    else
    {
        $uuid = $_GET['uid'];
    }
    $userUpdateInfoArr1 ='';
    $userUpdateInfoArr2 ='';
    $userUpdateInfoArr3 ='';
    $userUpdateInfoArr4 ='';
    if(isset($_POST["btnSave"]))
    {  
        $userInfoArr = [];
        $userInfoArr[0]=$_REQUEST['login'];
        $userInfoArr[1]=$_REQUEST['pass'];
        $userInfoArr[2]=$_REQUEST['username'];
        $userInfoArr[3]=$_REQUEST['email'];
        $userInfoArr[4]=$_REQUEST['cmbCountries'];
        $userInfoArr[5]=$_SESSION['userid'];
        if($_REQUEST['isadmin']==null || $_REQUEST['isadmin']==0)
        $userInfoArr[6]=0;
        else
        $userInfoArr[6]=1;
        $userInfoArr[7]=$uuid;
        if(saveUser($userInfoArr)===TRUE)
        {
            echo '<script language="javascript">';
            echo 'alert("User saved successfully")';
            echo '</script>';
        }
        else if(saveUser($userInfoArr)==2)
        {
            echo '<script language="javascript">';
            echo 'alert("User record updated successfully")';
            echo '</script>';
        }
        else if(saveUser($userInfoArr)==3)
        {
            echo '<script language="javascript">';
            echo 'alert("User record can not be updated")';
            echo '</script>';
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Invalid information")';
            echo '</script>';
        }
    }
    if($uuid!=null && $uuid!=0)
    {
        $sql = "SELECT login,name,password,email FROM users WHERE userid='$uuid'";
        $result = mysqli_query($con, $sql);
        $recordsFound = mysqli_num_rows($result);
        if ($recordsFound > 0) 
        {
            while($row = mysqli_fetch_assoc($result)) 
            {
                $userUpdateInfoArr1=$row['login'];
                $userUpdateInfoArr2=$row['name'];
                $userUpdateInfoArr3=$row['password'];
                $userUpdateInfoArr4=$row['email'];  
            }
        }
    }
 ?>   
<?php include('navbar.php');?>
<html>
<head>
</head>
<body>
    <h1 style="text-align:center; font-family:'Courier New', Courier, monospace">
        <b>WELCOME TO USER MANAGEMENT</b>
    </h1>
    <div class="container-fluid">
        <div class="row form-group col-lg-4 col-lg-offset-2">
            <form method="POST">
            <legend align="center">User Info Form</legend>
                <div class="form-group">
                    <label>Login:</label>
                    <input type="text" name="login" value ='<?php echo $userUpdateInfoArr1?>'class="form-control">
                </div>
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="username"value ='<?php echo $userUpdateInfoArr2?>' class="form-control">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" value ='<?php echo $userUpdateInfoArr4?>'class="form-control">
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="pass" value ='<?php echo $userUpdateInfoArr3?>'class="form-control">
                </div>
                <label>Confirm Password:</label>
                <input type="password" name="cpass" class="form-control">
                <div class="form-group">
                <label>Country:</label>
                <select name="cmbCountries" class="form-control">
                    <?php
                      $countries  = getAllCountries();
                      echo "<option>---Select---</option>";
                      $index = 1;
                      foreach($countries as $country)
                      {
                         echo "<option value='$index'>$country</option>";
                         $index++;
                      }
                    ?> 
                    </select>
                </div>
                <div class="form-group">
                        <input type="checkbox" name="isadmin" value='0'> IsAdmin </input>
                </div>
                <div class="form-group">
                        <input type="reset" value="Clear" class="btn  btn-danger col-lg-6">
                        <input type="submit" id="savebtn" value="Save" name="btnSave" class="btn  btn-success col-lg-6">
                </div>
            </form>
        </div>
    </div>
</body>

</html>