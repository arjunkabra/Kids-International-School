<?php

require_once('config.php');

database_connect($DB_HOST, $DB_NAME, $DB_USER, $DB_PASSWORD);
	
$check_table=mysql_query("select * from admins");
$table_result=mysql_num_rows($check_table);
if($table_result==0) {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=installation\" />";
}
else {
	
session_start();
  $error_msg = "";

if ( (isset($_COOKIE['admin_id']) && isset($_COOKIE['admin_name'])) || (isset($_SESSION['admin_id']) && isset($_SESSION['admin_name'])) ) {
	$_COOKIE['admin_id'] = $_SESSION['admin_id'];
    $_COOKIE['admin_name'] = $_SESSION['admin_name'];
	$_COOKIE['admin_auth_keys'] = $_SESSION['admin_auth_keys'];
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/main';
    header('Location: ' . $home_url);
}

else if ( (!isset($_COOKIE['admin_id']) && !isset($_COOKIE['admin_name'])) || (!isset($_SESSION['admin_id']) && !isset($_SESSION['admin_name'])) )  {
     if (isset($_POST['submit'])) {

	 $username = mysql_real_escape_string(trim($_POST['username']));
     $password = mysql_real_escape_string(trim($_POST['password']));
	  
	 if (!empty($username) && !empty($password)) {
	 $query = "SELECT admin_id, admin_name, admin_username, admin_auth_keys FROM admins WHERE admin_username = '$username' AND               admin_password = SHA('$password')";
     $data = mysql_query($query);

     if (mysql_num_rows($data) == 1) {
     $row = mysql_fetch_array($data);
     if(isset($_POST['remember']) && $_POST['remember'] == 'yes') {
		  $_SESSION['admin_id'] = $row['admin_id'];
          $_SESSION['admin_name'] = $row['admin_name'];
		  $_SESSION['admin_auth_keys'] = $row['admin_auth_keys'];
          setcookie('admin_id', $row['admin_id'], time() + (60 * 60 * 24 * 15));
          setcookie('admin_name', $row['admin_name'], time() + (60 * 60 * 24 * 15));
		  setcookie('admin_auth_keys', $row['admin_auth_keys'], time() + (60 * 60 * 24 * 15));
		  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/main';
          header('Location: ' . $home_url);
		  }
	 else {
		  $_SESSION['admin_id'] = $row['admin_id'];
          $_SESSION['admin_name'] = $row['admin_name'];
		  $_SESSION['admin_auth_keys'] = $row['admin_auth_keys'];
		  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/main';
          header('Location: ' . $home_url);
		  }
		}
     else {
     $error_msg = "<img src=\"images/exclamation.gif\" class=\"form1MessageImage\" />Invalid username or password";
     }
     }
     else {
     $error_msg = "<img src=\"images/exclamation.gif\" class=\"form1MessageImage\" />Enter you username and password";
     }
   }
}

?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/universal.css" rel="stylesheet" type="text/css" />
<link href="css/formStyler.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon.png">
<title>Login | <?php echo $org_name; ?></title>
</head>

<body class="bgMain">
<div class="form1Header"><?php echo $org_name; ?><br />Administrative Login</div>

<form class="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

<div class="form1Message"><?php if (empty($_SESSION['admin_id'])) { echo $error_msg; } ?></div>

<fieldset class="form1FieldSet">

<label class="form1Label form1LabelFontWeight">Username</label><br />
<input class="form1Input" type="text" name="username" value="<?php if (!empty($username)) echo $username; ?>" /><br />

<label class="form1Label form1LabelFontWeight">Password</label><br />
<input class="form1Input" type="password" name="password" /><br />

<input style="margin-left:10px;" name="remember" type="checkbox" value="yes" />
<label class="form1Label">Remember Me</label><br />

<input class="form1Button form1ButtonMargin" type="submit" name="submit" value="Authentification" />

</fieldset>

</form>
<div class="form1Footer"><a href="lostPassword">Forgot your username or password?</a></div>
</body>
</html>
<?php } database_disconnect($con); ?>