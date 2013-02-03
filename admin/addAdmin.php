<?php 

require_once('config.php');
authenticate();
database_connect($DB_HOST, $DB_NAME, $DB_USER, $DB_PASSWORD);
admin_pass();

$error_1 = "";
$error_2 = "";
$error_3 = "";
$error_4 = "";
$error_5 = "";
$error_6 = "";
$success_msg = "";

$access=mysql_query("SELECT * FROM admins where admin_id='".$_SESSION['admin_id']."'");
$check=mysql_fetch_array($access);

if($check['admin_priority']==1) {

if(isset($_POST['add_admin'])) {
	$name=$_POST['name'];
	$email=$_POST['email'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$retype_password=$_POST['retype_password'];
	$type=$_POST['type'];
	$date=date("y/m/d");
	
	if(empty($name) || empty($email) || empty($username) || empty($password) || empty($retype_password)) {  
	$error_1 = "Please fill in all the fields<br/>";
	}
	
	if($type=="Select-Type") {
	$error_2 = "Select Admin Type<br/>";
	}
	
	$check_username = mysql_num_rows(mysql_query("SELECT * FROM admins WHERE admin_username='$username'"));
	$check_email = mysql_num_rows(mysql_query("SELECT * FROM admins WHERE admin_email='$email'"));
	
	if($check_username==1) { 
	$error_3 = "Username already exists in our database, please choose a different username<br/>";
	}
	
	if($check_email==1) {
	$error_4 = "E-mail id already exists in our database, Please choose a different email id<br/>";
	}
}

if(!empty($name) && !empty($email) && !empty($username) && 
   !empty($password) && !empty($retype_password) && ($type=="Admin") && ($check_username==0) && ($check_email==0)) {  

    if (!preg_match("/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is", $email)) { 
	$error_5 = "Email you entered is not valid<br/>";
	}
	if ($password!=$retype_password) {
    $error_6 = "password did not match<br/>"; 
	}
	if (preg_match("/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is", $email) && ($password==$retype_password)) {
		
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
	 
	$query = mysql_query("INSERT INTO admins 
	         (admin_username, admin_password, admin_date, admin_name, admin_email, admin_auth_keys, admin_priority, admin_type)
				          VALUE('$username', SHA('$password'), '$date', '$name', '$email', '$auth_keys', '2', '$type')");
	if(!$query) { 
	echo "Error: " .mysql_error(); 
	}
	else {
	$success_msg = "Admin successfully added";
	$mail_to = $email;
    $subject = $org_name." Administrator Account";
	$body_message = "Your account is set on ".$org_name." as Admin\n";
    $body_message .= "User Name: ".$username."\n";
	$body_message .= "Password: You selected during registration\n";
	$body_message .= "Login to ".$org_name." admin panal to take further actions: ";
	$body_message .= "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
    $headers = "From: \"\"<".$reply_email.">\n";
    $headers .= "Reply-To: \"\"<".$reply_email.">\n";
	$mail_status = mail($mail_to, $subject, $body_message, $headers);
	$name="";
    $email="";
    $username="";
    $password="";
    $retype_password="";
	}
	}

}

else if(!empty($name) && !empty($email) && !empty($username) && 
		!empty($password) && !empty($retype_password) && ($type=="Super-Admin") && ($check_username==0) && ($check_email==0)) {  

    if (!preg_match("/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is", $email)) { 
	$error_5 = "Email you entered is not valid<br/>";
	}
	if ($password!=$retype_password) {
    $error_6 = "password did not match<br/>";
	}
	if (preg_match("/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is", $email) && ($password==$retype_password)) {
		
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
		
	$query = mysql_query("INSERT INTO admins 
	        (admin_username, admin_password, admin_date, admin_name, admin_email, admin_auth_keys, admin_priority, admin_type)
				          VALUE('$username', SHA('$password'), '$date', '$name', '$email', '$auth_keys', '1', '$type')");
	if(!$query) { 
	$message = mysql_error(); 
	}
	$success_msg = "Super admin successfully added";
	$mail_to = $email;
    $subject = $org_name." Administrator Account";
	$body_message = "Your account is set on ".$org_name." as Super-Admin\n";
    $body_message .= "User Name: ".$username."\n";
	$body_message .= "Password: You selected during registration\n";
	$body_message .= "Login to ".$org_name." admin panal to take further actions: ";
	$body_message .= "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
    $headers = "From: \"\"<".$reply_email.">\n";
    $headers .= "Reply-To: \"\"<".$reply_email.">\n";
	$mail_status = mail($mail_to, $subject, $body_message, $headers);
	$name="";
    $email="";
    $username="";
    $password="";
    $retype_password="";
	}
}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/universal.css" type="text/css" />
<link rel="stylesheet" href="css/tableStyler.css" type="text/css" />
<link rel="stylesheet" href="css/formStyler.css" type="text/css" />
<link rel="shortcut icon" href="images/favicon.png" />
<title>Add Admin</title>
</head>

<body class="bgMain">

<?php include('includes/header.php'); ?>

<div class="mainIndex">

<?php include('includes/navigation.php'); ?>

<div class="pageName">
<img src="images/smallAddAdmin.png" />Add Admin
</div>

<div class="addAdminMessage">
<?php
echo $error_1;
echo $error_2;
echo $error_3;
echo $error_4;
echo $error_5;
echo $error_6;
echo $success_msg;
?>
</div>
<?php 

if($check['admin_priority']==2) { 
echo "<div class=\"adminMessage\">
              This area can be viewed only by super administrators, You dont have enough permission
			  </div>";
}
if($check['admin_priority']==1) { 
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

<table class="tableAddAdmin">

<tr>
<td><label class="form1Label form1LabelFontWeight">Full Name:</label></td>
<td><input class="form3Input" name="name" type="text" value="<?php if(isset($_POST['add_admin'])) { echo $name; }  ?>" /></td>
</tr>

<tr>
<td><label class="form1Label form1LabelFontWeight">Email:</label></td>
<td><input class="form3Input" name="email" type="text" value="<?php if (isset($_POST['add_admin'])) { echo $email; }  ?>" /></td>
</tr>

<tr>
<td><label class="form1Label form1LabelFontWeight">User Name:</label></td>
<td><input class="form3Input" name="username" type="text" value="<?php if (isset($_POST['add_admin'])) { echo $username; }  ?>" /></td>
</tr>


<tr>
<td><label class="form1Label form1LabelFontWeight">Password:</label></td>
<td>
<input class="form3Input" name="password" type="password" value="<?php if (isset($_POST['add_admin'])) { echo $password; }  ?>" />
</td>
</tr>

<tr>
<td><label class="form1Label form1LabelFontWeight">Re-type Password:</label></td>
<td>
<input class="form3Input" name="retype_password" type="password" 
                         value="<?php if (isset($_POST['add_admin'])) { echo $retype_password; }  ?>" />
</td>
</tr>

<tr>
<td><label class="form1Label form1LabelFontWeight">Admin Type:</label></td>
<td>
<select class="form3Select" name="type">
<option>Select-Type</option>
<option>Admin</option>
<option>Super-Admin</option>
</select>
</td>
</tr>

<tr>
<td colspan="2">
<input class="form1Button form3ButtonMargin" name="add_admin" type="submit" value="Add Admin" />
</td>
</tr>

</table>

</form>

<?php } ?>

</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
<?php database_disconnect($con); ?>