<?php session_start();?>
<?php
    require('conn.php');
?>
 <?php 
 function isUserValidated($user, $pass)
 {
	 		global $con;
			$Login_Status = 0;
			$sql = "SELECT userid,login,password,isadmin FROM users";
			$result = mysqli_query($con, $sql);
			$recordsFound = mysqli_num_rows($result);
			if ($recordsFound > 0) 
			{
				while($row = mysqli_fetch_assoc($result)) 
				{
					if($row["login"]==$user && $row["password"]==$pass)
					{	
						if($row['isadmin']==1)
						{
							$Login_Status = 1;
							$_SESSION["user"]=$username;
                			$_SESSION["utype"]=1;
               				$_SESSION['userid']=$row['userid'];
							break;
						}
						else
						{
							$_SESSION["user"]=$user;
                			$_SESSION["utype"]=2;
               				$_SESSION['userid']=$row['userid'];
							$Login_Status=2;
							$uid = $row['userid'];
							break;
						}
					}
				}
			}
			return $Login_Status; 
 }
 function getAllCountries()
 {
	global $con;
	$countries=[];
	$sql = "SELECT *FROM country";
	$result = mysqli_query($con, $sql);
	$recordsFound = mysqli_num_rows($result);
	$index = 0;
	if ($recordsFound > 0) 
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
		  $countries[$index]=$row["name"];
		  $index++;
		}
	}
	return $countries;
	mysql_close($con);
 }
 // function to save user
 function saveUser(&$infoArr)
 {
	 global $con;
	if($infoArr[7]==null)
	{
		$sql = "INSERT INTO users (login,password,name,email,countryid,createdon,createdby,isadmin)
		VALUES ('$infoArr[0]', '$infoArr[1]', '$infoArr[2]','$infoArr[3]','$infoArr[4]',CURRENT_TIMESTAMP,'$infoArr[5]','$infoArr[6]')";
		if (mysqli_query($con, $sql)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	else
	{
		$sql = "UPDATE users SET login='$infoArr[0]',password='$infoArr[1]', name='$infoArr[2]',email='$infoArr[3]',countryid='$infoArr[4]',isadmin='$infoArr[6]' WHERE userid='$infoArr[7]'";
		if (mysqli_query($con, $sql)) {
			return 2; // on update success
		} else {
			return 3; // on update failure
		}
	}
	mysqli_close($con);
 }
 // Function to get the client IP address
function getClientIP() 
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
// Function to put data into Login-History
function setLoginHistory($user, $userid)
{
	global $con;
	$clientIP = getClientIP();
	$sql = "INSERT INTO loginhistory (userid,login,logintime,machineip)
	VALUES ('$userid','$user',CURRENT_TIMESTAMP,'$clientIP')";
	if (mysqli_query($con, $sql)) {
		return TRUE;
	} else {
		return FALSE;
	}
	mysqli_close($con);
}
//Funtion to get all users (excluding admins)
function getAllUsers()
{
			global $con;
			$userArr = [];
			$sql = "SELECT login FROM users WHERE isadmin=0";
			$result = mysqli_query($con, $sql);
			$recordsFound = mysqli_num_rows($result);
			if ($recordsFound > 0) 
			{
				$index = 0;
				while($row = mysqli_fetch_assoc($result)) 
				{
					$userArr[$index++]=$row['login'];		
				}
			}
			return $userArr;
}
function getUserID($user)
{
			global $con;
			$uid='';
			$sql = "SELECT userid FROM users WHERE login='$user'";
			$result = mysqli_query($con, $sql);
			$recordsFound = mysqli_num_rows($result);
			if ($recordsFound > 0) 
			{
				while($row = mysqli_fetch_assoc($result)) 
				{
					$uid=$row['userid'];		
				}
			}
			return $uid;
}
function getUserNameByID($uid)
{
			global $con;
			$uname='';
			$sql = "SELECT login FROM users WHERE userid='$uid'";
			$result = mysqli_query($con, $sql);
			$recordsFound = mysqli_num_rows($result);
			if ($recordsFound > 0) 
			{
				while($row = mysqli_fetch_assoc($result)) 
				{
					$uname=$row['login'];		
				}
			}
			return $uname;
}
// Function to get all roles
function getAllRoles()
{
		global $con;
		$roleArr = [];
		$sql = "SELECT name FROM role";
		$result = mysqli_query($con, $sql);
		$recordsFound = mysqli_num_rows($result);
		if ($recordsFound > 0) 
		{
			$index = 0;
			while($row = mysqli_fetch_assoc($result)) 
			{
				$roleArr[$index++]=$row['name'];		
			}
		}
		return $roleArr;
}
// function get role id
function getRoleID($role)
{
			global $con;
			$rid='';
			$sql = "SELECT roleid FROM role WHERE name='$role'";
			$result = mysqli_query($con, $sql);
			$recordsFound = mysqli_num_rows($result);
			if ($recordsFound > 0) 
			{
				while($row = mysqli_fetch_assoc($result)) 
				{
					$rid=$row['roleid'];		
				}
			}
			return $rid;
}
//function get role name by id
function getRoleNameByID($rid)
{
			global $con;
			$rname='';
			$sql = "SELECT name FROM role WHERE roleid='$rid'";
			$result = mysqli_query($con, $sql);
			$recordsFound = mysqli_num_rows($result);
			if ($recordsFound > 0) 
			{
				while($row = mysqli_fetch_assoc($result)) 
				{
					$rname=$row['name'];		
				}
			}
			return $rname;
}
// Function to save user-role
function saveUserRole($uid,$rid)
{
	global $con;
	$sql = "INSERT INTO userrole (userid,roleid)
	VALUES ('$uid','$rid')";
	if (mysqli_query($con, $sql)) {
		return TRUE;
	} else {
		return FALSE;
	}
	mysqli_close($con);
}
//Function to save role
function saveRole($role,$desc,$uid)
{
	global $con;
	$sql = "INSERT INTO role (name,description,createdon,createdby)
	VALUES ('$role','$desc',CURRENT_TIMESTAMP,'$uid')";
	if (mysqli_query($con, $sql)) 
	{
		return TRUE;
	} else 
	{
		return FALSE;
	}
	mysqli_close($con);
}
//Function to save role
function savePermission($perm,$desc,$uid)
{
	global $con;
	$sql = "INSERT INTO permission (name,description,createdon,createdby)
	VALUES ('$perm','$desc',CURRENT_TIMESTAMP,'$uid')";
	if (mysqli_query($con, $sql)) 
	{
		return TRUE;
	} else 
	{
		return FALSE;
	}
	mysqli_close($con);
}
// Function to get all roles
function getAllPermissions()
{
		global $con;
		$permArr = [];
		$sql = "SELECT name FROM permission";
		$result = mysqli_query($con, $sql);
		$recordsFound = mysqli_num_rows($result);
		if ($recordsFound > 0) 
		{
			$index = 0;
			while($row = mysqli_fetch_assoc($result)) 
			{
				$permArr[$index++]=$row['name'];		
			}
		}
		return $permArr;
}
// Function to get permission id
function getPermissionID($perm)
{
			global $con;
			$permid='';
			$sql = "SELECT permissionid FROM permission WHERE name='$perm'";
			$result = mysqli_query($con, $sql);
			$recordsFound = mysqli_num_rows($result);
			if ($recordsFound > 0) 
			{
				while($row = mysqli_fetch_assoc($result)) 
				{
					$permid=$row['permissionid'];		
				}
			}
			return $permid;
}
// function to get permission name by id
function getPermNameByID($pid)
{
			global $con;
			$permname='';
			$sql = "SELECT name FROM permission WHERE permissionid='$pid'";
			$result = mysqli_query($con, $sql);
			$recordsFound = mysqli_num_rows($result);
			if ($recordsFound > 0) 
			{
				while($row = mysqli_fetch_assoc($result)) 
				{
					$permname=$row['name'];		
				}
			}
			return $permname;
}
// Function to save role-permission
function saveRolePermission($pid,$rid)
{
	global $con;
	$sql = "INSERT INTO rolepermission (roleid,permissionid)
	VALUES ('$rid','$pid')";
	if (mysqli_query($con, $sql)) {
		return TRUE;
	} else {
		return FALSE;
	}
	mysqli_close($con);
}
 
 // Function to get user info
 function getUserInfo()
 {
	global $con;
	$sql = "SELECT userid,login,name,email,countryid FROM users";
	$result = mysqli_query($con, $sql);
	$recordsFound = mysqli_num_rows($result);
	if ($recordsFound > 0) 
	{
		$id = '';
		$country ='';
		while($row = mysqli_fetch_assoc($result)) 
		{
			$id = $row['userid'];
			$cid = $row['countryid'];
			$country = getCountryNameByID($cid);
			echo"<tr>";
			echo"<td>".$row['userid']."</td>";
			echo"<td>".$row['login']."</td>";
			echo"<td>".$row['name']."</td>";
			echo"<td>".$row['email']."</td>";
			echo"<td>".$country."</td>";
			echo "<td><a href='./user.php?uid=$id'>Edit</a></td>";
			echo "<td><a href='./userlist.php?uid=$id' onClick=\'javascript: return confirm('Are you sure to delete?);\'>Delete</a></td>";
			echo"</tr>"; 
		}
	}
 }
 // Function to get country name by id;
 function getCountryNameByID($cid)
 {
	global $con;
	$country;
	$sql = "SELECT name FROM country where id='$cid'";
	$result = mysqli_query($con, $sql);
	$recordsFound = mysqli_num_rows($result);
	$index = 0;
	if ($recordsFound > 0) 
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
		  $country=$row["name"];
		}
	}
	return $country;
 }
 //function to getRoles
 function getRoleInfo()
 {
	global $con;
	$sql = "SELECT *FROM role";
	$result = mysqli_query($con, $sql);
	$recordsFound = mysqli_num_rows($result);
	if ($recordsFound > 0) 
	{
		$user = '';
		$id = '';
		while($row = mysqli_fetch_assoc($result)) 
		{
			$id = $row['roleid'];
			$user = getUserNameByID($row['createdby']);
			echo"<tr>";
			echo"<td>".$id."</td>";
			echo"<td>".$row['name']."</td>";
			echo"<td>".$row['description']."</td>";
			echo"<td>".$row['createdon']."</td>";
			echo"<td>".$user."</td>";
			echo "<td><a href='role.php?rid=$id'>Edit</a></td>";
			echo "<td><a href='#?rid=$id'>Delete</a></td>";
			echo"</tr>"; 			
		}
	}
 }
 // Function to get permission info
 function getPermissionInfo()
 {
	global $con;
	$sql = "SELECT *FROM permission";
	$result = mysqli_query($con, $sql);
	$recordsFound = mysqli_num_rows($result);
	if ($recordsFound > 0) 
	{
		$user = '';
		$id = '';
		while($row = mysqli_fetch_assoc($result)) 
		{
			$id = $row['permissionid'];
			$user = getUserNameByID($row['createdby']);
			echo"<tr>";
			echo"<td>".$id."</td>";
			echo"<td>".$row['name']."</td>";
			echo"<td>".$row['description']."</td>";
			echo"<td>".$row['createdon']."</td>";
			echo"<td>".$user."</td>";
			echo "<td><a href='role.php?pid=$id'>Edit</a></td>";
			echo "<td><a href='#?pid=$id'>Delete</a></td>";
			echo"</tr>"; 			
		}
	}
 }
 //funtion to get userrole info
 function getUserRoleInfo()
 {
	global $con;
	$sql = "SELECT *FROM userrole";
	$result = mysqli_query($con, $sql);
	$recordsFound = mysqli_num_rows($result);
	if ($recordsFound > 0) 
	{
		$uname = '';
		$rname = '';
		$id = '';
		while($row = mysqli_fetch_assoc($result)) 
		{
			$uname = getUserNameByID($row['userid']);
			$rname = getRoleNameByID($row['roleid']);
			$id = $row['id'];
			echo"<tr>";
			echo"<td>".$row['userid']."</td>";
			echo"<td>".$uname."</td>";
			echo"<td>".$row['roleid']."</td>";
			echo"<td>".$rname."</td>";
			echo "<td><a href='role.php?pid=$id'>Edit</a></td>";
			echo "<td><a href='#?pid=$id'>Delete</a></td>";
			echo"</tr>"; 			
		}
	}	 
 }
 //funtion to get userrole info
 function getRolePermissionInfo()
 {
	global $con;
	$sql = "SELECT *FROM rolepermission";
	$result = mysqli_query($con, $sql);
	$recordsFound = mysqli_num_rows($result);
	if ($recordsFound > 0) 
	{
		$pname = '';
		$rname = '';
		$id = '';
		while($row = mysqli_fetch_assoc($result)) 
		{
			$pname = getPermNameByID($row['permissionid']);
			$rname = getRoleNameByID($row['roleid']);
			$id = $row['id'];
			echo"<tr>";
			echo"<td>".$row['permissionid']."</td>";
			echo"<td>".$pname."</td>";
			echo"<td>".$row['roleid']."</td>";
			echo"<td>".$rname."</td>";
			echo "<td><a href='role.php?id=$id'>Edit</a></td>";
			echo "<td><a href='#?id=$id'>Delete</a></td>";
			echo"</tr>"; 			
		}
	}	 
 }
 //Function to get login history
 function getLoginHistory()
 {
	global $con;
	$sql = "SELECT *FROM loginhistory";
	$result = mysqli_query($con, $sql);
	$recordsFound = mysqli_num_rows($result);
	if ($recordsFound > 0) 
	{
		$uname = '';
		$id = '';
		while($row = mysqli_fetch_assoc($result)) 
		{
			$uname = getUserNameByID($row['userid']);
			$id = $row['id'];
			echo"<tr>";
			echo"<td>".$id."</td>";
			echo"<td>".$row['userid']."</td>";
			echo"<td>".$uname."</td>";
			echo"<td>".$row['logintime']."</td>";
			echo"<td>".$row['machineip']."</td>";
			echo"</tr>"; 			
		}
	}	 
 }
 //function to fill field to update data
 function deleteUserByID($uid)
 {
	global $con;
	$sql = "DELETE FROM users WHERE userid='$uid'";
	$result = mysqli_query($con,$sql);
	if($result==TRUE)
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
 }
 // USER FUNCTIONALITY
 //function to get user roles by user id
 function getUserRoleByID($uid)
 {
	global $con;
	$sql = "SELECT r.name, r.description FROM userrole ur,role r WHERE userid='$uid' AND ur.roleid=r.roleid";
	$result = mysqli_query($con, $sql);
	$recordsFound = mysqli_num_rows($result);
	if ($recordsFound > 0) 
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
			echo"<tr>";
			echo"<td>".$row['roleid']."</td>";
			echo"<td>".$row['name']."</td>";
			echo"</tr>"; 			
		}
	}
 }
 // function to get role permission by uid
 function getRolePermissionByID($uid)
 {
	global $con;
	$sql = "SELECT rp.name, rp.description FROM userrole ur ,permission p Where ur.userid='$uid' AND ur.roleid=p.roleid";
	$result = mysqli_query($con, $sql);
	$recordsFound = mysqli_num_rows($result);
	if ($recordsFound > 0) 
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
			echo"<tr>";
			echo"<td>".$row["name"]."</td>";
			echo"<td>".$row["description"]."</td>";
			echo"</tr>"; 			
		}
	}	 
 }
?>