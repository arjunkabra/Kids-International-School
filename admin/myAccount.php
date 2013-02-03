<?php 

require_once('config.php');
authenticate();
database_connect($DB_HOST, $DB_NAME, $DB_USER, $DB_PASSWORD);
admin_pass();

$error_1 = "";
$error_2 = "";
$error_3 = "";
$error_4 = "";
$success_msg = "";

if (isset($_POST['update_profile'])) {
	
   $name=$_POST['name'];
   $email=$_POST['email'];
   $new_password=$_POST['new_password'];
   $retype_password=$_POST['retype_password'];
   
   if (!empty($new_password) && empty($retype_password) ) { 
	    $error_1 = "Password did not match<br/>"; 
    }
	
   if (empty($new_password) && !empty($retype_password) ) { 
	    $error_1 = "Password did not match<br/>"; 
    }
	
   if(empty($name)) {
		$error_2 = "Name Cannot be empty<br/>";
	}
	
   if(empty($email)) {
		$error_3 = "Email Cannot be empty<br/>";
	}
	
   else if(!preg_match("/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is", $email)) {
		$error_4 = "The email you entered is not valid<br/>";
	}
	
   if (empty($new_password) && empty($retype_password) && !empty($name) && !empty($email) 
                            && (preg_match("/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is", $email))) { 
	    mysql_query("UPDATE admins SET admin_name='$name', admin_email='$email' WHERE admin_id='".$_SESSION['admin_id']."'");
        $success_msg = "Profile Updated<br/>" ;
    }
   else if (!empty($new_password) && !empty($retype_password) && !empty($name) && !empty($email) 
                                  && (preg_match("/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is", $email))) {
	    if($new_password!=$retype_password) {
		    $error_1 = "Password did not match<br/>";
	    }
	    if($new_password==$retype_password) {
          mysql_query("UPDATE admins SET admin_name='$name', admin_email='$email', admin_password=SHA('$new_password')
		                      WHERE admin_id='".$_SESSION['admin_id']."'");
          $success_msg = "Profile Updated<br/>" ;
	    }
    }
}

if(isset($_POST['reset_cookies'])) {
	
	    $auth_keys_length = 40;
        function make_auth_keys() {
        list($usec, $sec) = explode(' ', microtime());
        return (float) $sec + ((float) $usec * 100000);
        }
        srand(make_auth_keys());
        $alfa = "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
        $auth_keys = "";
        for($i = 0; $i < $auth_keys_length; $i ++) {
        $auth_keys .= $alfa[rand(0, strlen($alfa))];
        }
		
        mysql_query("UPDATE admins SET admin_auth_keys='$auth_keys' WHERE admin_id='".$_SESSION['admin_id']."'");
        $success_msg = "All existing cookies are invalidated succesfully<br/>
		                You will be logged out automatically with in 10 seconds" ;
	    echo "<meta http-equiv=\"refresh\" content=\"10; url=logout\" />";	
}

$db_data=mysql_query("SELECT * FROM admins WHERE admin_id='".$_SESSION['admin_id']."'");
$row=mysql_fetch_array($db_data);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/universal.css" type="text/css" />
<link rel="stylesheet" href="css/tableStyler.css" type="text/css" />
<link rel="stylesheet" href="css/formStyler.css" type="text/css" />
<link rel="shortcut icon" href="images/favicon.png" />
<title>My Account</title>
</head>

<body class="bgMain">

<?php include('includes/header.php'); ?>

<div class="mainIndex">

<?php include('includes/navigation.php'); ?>

<div class="pageName">
<img src="images/smallMyAccount.png" />My Account
</div>

<div class="addAdminMessage">
<?php
echo $error_1;
echo $error_2;
echo $error_3;
echo $error_4;
echo $success_msg;
?>
</div>

<?php

?>

<table class="tableAddAdmin">

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

<tr>
<td><label class="form1Label form1LabelFontWeight">User ID:</label></td>
<td><input class="form3Input" name="id" type="text" readonly="true" value="<?php  echo $row['admin_id']; ?>" /></td>
</tr>

<tr>
<td><label class="form1Label form1LabelFontWeight">Registered Date:</label></td>
<td><input class="form3Input" name="registered_date" type="text" readonly="true" value="<?php echo $row['admin_date']; ?>" /></td>
</tr>

<tr>
<td><label class="form1Label form1LabelFontWeight">Admin Type:</label></td>
<td><input class="form3Input" name="type" type="text" readonly="true" value="<?php echo $row['admin_type']; ?>" /></td>
</tr>


<tr>
<td><label class="form1Label form1LabelFontWeight">User Name:</label></td>
<td><input class="form3Input" name="username" type="text" readonly="true" value="<?php echo $row['admin_username']; ?>" /></td>
</tr>

<tr>
<td><label class="form1Label form1LabelFontWeight">Full Name:</label></td>
<td>
<input class="form3Input" name="name" type="text" 
value="<?php if(isset($_POST['update_profile'])) { echo $name;  } else { echo $row['admin_name']; } ?>" />
</td>
</tr>

<tr>
<td><label class="form1Label form1LabelFontWeight">Email:</label></td>
<td>
<input class="form3Input" name="email" type="text" 
value="<?php if(isset($_POST['update_profile'])) { echo $email;  } else { echo $row['admin_email']; } ?>" />
</td>
</tr>


<tr>
<td colspan="2" >
<p style="text-align:center;margin-top:10px"><font size="-2" face="Comic Sans MS, cursive">
If you would like to change the password type a new one. Otherwise leave this blank.
</font></p>
</td>
</tr>

<tr>
<td><label class="form1Label form1LabelFontWeight">New Password:</label></td>
<td><input class="form3Input" name="new_password" type="password" /></td>
</tr>

<tr>
<td><label class="form1Label form1LabelFontWeight">Re-type Password:</label></td>
<td><input class="form3Input" name="retype_password" type="password" /></td>
</tr>

<tr>
<td colspan="2"><input class="form1Button form3ButtonMargin" name="update_profile" type="submit" value="Update Profile" /></td>
</tr>
</form>

<tr>
<td colspan="2">
<p style="text-align:center;margin-top:10px"><font size="-2" face="Comic Sans MS, cursive">
You can reset cookies at any point in time to invalidate all existing cookies to<br />
logout universally. This will promt you to log in again.
</font></p>
</td>
</tr>

<tr>
<td colspan="2">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> 
<input class="form1Button form3ButtonMargin" type="submit" value="Reset Cookies" name="reset_cookies" />
</form>
</td>
</tr>

</table>

</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
<?php database_disconnect($con); ?>