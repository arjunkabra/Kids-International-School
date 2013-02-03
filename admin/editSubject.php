<?php 

require_once('config.php');
authenticate();
database_connect($DB_HOST, $DB_NAME, $DB_USER, $DB_PASSWORD);
admin_pass();

$error_1 = "";
$error_2 = "";
$success_msg = "";

if(isset($_GET['subject_id'])) {
$subject_id = $_GET['subject_id'];
$db_data = mysql_query("SELECT * FROM subjects WHERE subject_id = '$subject_id'");
$row = mysql_fetch_array($db_data);
}

if(isset($_GET['submit'])) {
	
	$edit_subject_id = $_GET['edit_subject_id'];
	$edit_serial_no = $_GET['edit_serial_no'];
	$edit_subject_name = $_GET['edit_subject_name'];
	$edit_max_marks = $_GET['edit_max_marks'];
	
	if(empty($edit_serial_no) || empty($edit_subject_name) || empty($edit_max_marks)) {
		$error_1 = "Please fill in all the fields<br/>";
	}
	
	if(!empty($edit_serial_no) && !empty($edit_subject_name) && !empty($edit_max_marks)) {
		$update = mysql_query("UPDATE subjects 
		          SET subject_serial_number = '$edit_serial_no', subject_name = '$edit_subject_name', max_marks = '$edit_max_marks'
				  WHERE subject_id = '$edit_subject_id'");
		if($update) {
			$success_msg = "Subject successfully updated<br/>";
			echo '<meta http-equiv=Refresh content="5;url=subjects">';
		}
		else {
			$error_2 = "Error: ".mysql_error()."<br/>";
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
<title>Results - Edit Subject</title>
</head>

<body class="bgMain">

<?php include('includes/header.php'); ?>

<div class="mainIndex">

<?php include('includes/sub-navigation.php'); ?>

<div class="pageName">
<img src="images/smallResults.png" />Results
</div>

<div class="adminMessage">
<?php
echo $error_1;
echo $error_2;
echo $success_msg;
?>
</div>

<div class="addSubject">

<h1>Edit Subjects</h1>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">

<table class="tableAddSubject">

<tr>
<td><label class="form1Label form1LabelFontWeight">Serial No.:</label></td>
<td>
<input class="form3Input" type="text" name="edit_serial_no" 
value="<?php if(isset($_GET['submit'])) { echo $edit_serial_no; } 
             else if(isset($_GET['subject_id'])) { echo $row['subject_serial_number']; } ?>" />
</td>
<tr>

<tr>
<td><label class="form1Label form1LabelFontWeight">Subject Name:</label></td>
<td>
<input class="form3Input" type="text" name="edit_subject_name" 
value="<?php if(isset($_GET['submit'])) { echo $edit_subject_name; } 
             else if(isset($_GET['subject_id'])) { echo $row['subject_name']; } ?>" />
</td>
<tr>

<tr>
<td><label class="form1Label form1LabelFontWeight">Max Marks:</label></td>
<td>
<input class="form3Input" type="text" name="edit_max_marks" 
value="<?php if(isset($_GET['submit'])) { echo $edit_max_marks; } 
             else if(isset($_GET['subject_id'])) { echo $row['max_marks']; } ?>" />
</td>
<tr>

<input type="hidden" name="edit_subject_id" 
value="<?php if(isset($_GET['submit'])) { echo $edit_subject_id; }
             else if(isset($_GET['subject_id'])) { echo $row['subject_id']; } ?>" />

<tr>
<td colspan="2">
<input class="form1Button form3ButtonMargin" type="submit" name="submit" value="Update Subject" /></td>
</tr>

</table>

</form>

</div>

</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
<?php database_disconnect($con); ?>