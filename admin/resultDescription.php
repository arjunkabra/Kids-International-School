<?php 

require_once('config.php');
authenticate();
database_connect($DB_HOST, $DB_NAME, $DB_USER, $DB_PASSWORD);
admin_pass();

$success_msg = "";
$error_msg = "";

if(!isset($_POST['submit'])) {
$query = mysql_query("SELECT * FROM configuration WHERE id_configuration = 2");
$description = mysql_fetch_array($query);
$message = $description['additional_info'];
}

if(isset($_POST['submit'])) {
	$message = $_POST['description'];
	$query = mysql_query("UPDATE configuration SET additional_info = '$message' WHERE id_configuration = 2");
	if($query) {
		$success_msg = "Description Updated";
	}
	else {
		$error_msg = "Operation Failed";
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
<title>Result Description</title>
</head>

<body class="bgMain">

<?php include('includes/header.php'); ?>

<div class="mainIndex">

<?php include('includes/sub-navigation.php'); ?>

<div class="pageName">
<img src="images/smallDashboard.png" />Result Description
</div>

<div class="adminMessage">
<?php
echo $error_msg;
echo $success_msg;
?>
</div>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

<table style="margin:15px auto 15px auto;">

<tr>
<td style="text-align:center">
<label style="vertical-align:top;" class="form1Label form1LabelFontWeight">Enter Description.:</label></td>
</tr>

<tr>
<td><textarea class="form4Input" name="description"><?php echo $message; ?></textarea></td>
</tr>

<tr>
<td><input class="form1Button form3ButtonMargin" type="submit" name="submit" value="Update" /></td>
</tr>

</table>

</form>

</div>

<?php include('includes/footer.php'); ?>

</body>
</html>

<?php database_disconnect($con); ?>