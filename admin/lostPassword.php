<?php
require_once('config.php');

database_connect($DB_HOST, $DB_NAME, $DB_USER, $DB_PASSWORD);
	
$check_table=mysql_query("select * from admins");
$table_result=mysql_num_rows($check_table);
if($table_result==0) {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=installation\" />";
}
else {
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/universal.css" rel="stylesheet" type="text/css" />
<link href="css/formStyler.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon.png">
<title>Lost Password</title>
</head>

<body class="bgMain">

<?php

session_start();

if (isset($_SESSION['admin_id'])) {
	$_COOKIE['admin_id'] = $_SESSION['admin_id'];
    $_COOKIE['admin_name'] = $_SESSION['admin_name'];
	
     echo "<div class=\"logoutPromt\">You are logged in as ". $_SESSION['admin_name'] .". Please logout to access this page.<br/>
		  <input type=\"button\" onClick=\"location.href='logout'\" value=\"Log Out\" />
		  <input type=\"button\" onClick=\"location.href='main'\" value=\"Do It Later\" />
		  </div>";
}

if (!isset($_SESSION['admin_id'])) {
if(isset($_POST['submit'])) {
	$email=$_POST['email'];
	if(empty($email)) {  
    $error_msg = "<img src=\"images/exclamation.gif\" class=\"form1MessageImage\" />Please enter an email address";
    }
}

if(!empty($email)) {
	if (!preg_match("/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is", $email)) { 
	$error_msg =  "<img src=\"images/exclamation.gif\" class=\"form1MessageImage\" />The e-mail you entered is not valid";
	}
	if(preg_match("/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is", $email)) {
	$check_email = mysql_num_rows(mysql_query("SELECT * FROM admins WHERE admin_email='$email'"));
	if($check_email!=1) { 
	$error_msg = "<img src=\"images/exclamation.gif\" class=\"form1MessageImage\" />No admin registered with that email address";
	}
				
	else if($check_email==1) {
	require('includes/pwd-generator.php');
	$change_password=mysql_query("UPDATE admins SET admin_password=SHA('$random_password') WHERE admin_email='$email'");
	$fetch_username=mysql_query("SELECT * FROM admins WHERE admin_email='$email'");
	$row=mysql_fetch_array($fetch_username);
	$full_name=$row['admin_name'];
	$username=$row['admin_username'];
	$mail_to = $row['admin_email'];
	if(!$change_password) { 
	$error_msg = "Error: ".mysql_error();
	}
	
	else if($change_password) {
	require('includes/pwd-reset-mailer.php');
	$error_msg = "<img src=\"images/lightbulb.gif\" class=\"form1MessageImage\" />
	      <span id=\"form2SuccessMessage\">Check your email for new password</span>";
	$email = "";
	}
	}
	}
}
?>

<div class="form1Header"><?php echo $org_name; ?><br />Forgot your username or password?</div>

<form class="form1" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

<div class="form1Message"><?php if(isset($_POST['submit'])) { echo $error_msg; } ?></div>

<fieldset class="form1FieldSet">

<label class="fomm1Label form1LabelFontWeight">Email</label><br />
<input class="form1Input" type="text" name="email" value="<?php if (isset($_POST['submit'])) { echo $email; }  ?>" /><br />

<input class="form1Button form2ButtonMargin" type="submit" name="submit" value="Reset Password" />

</fieldset>

</form>
<div class="form1Footer"><a href="login">Back to Administrative Login</a></div>
</body>
</html>
<?php } } database_disconnect($con); ?>