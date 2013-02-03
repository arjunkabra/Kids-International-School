<?php 

require_once('config.php');
authenticate();
database_connect($DB_HOST, $DB_NAME, $DB_USER, $DB_PASSWORD);
admin_pass();

$error_1 = "";
$error_2 = "";
$success_msg = "";

if(isset($_GET['student_id'])) {
$student_id = $_GET['student_id'];
$db_data = mysql_query("SELECT * FROM students WHERE student_id = '$student_id'");
$row = mysql_fetch_array($db_data);
}

if(isset($_GET['submit'])) {
	
	$edit_student_id = $_GET['edit_student_id'];
	$edit_register_no = $_GET['edit_register_no'];
	$edit_student_name = $_GET['edit_student_name'];
	$edit_class = $_GET['edit_class'];
	
	if(empty($edit_register_no) || empty($edit_student_name) || empty($edit_class)) {
		$error_1 = "Please fill in all the fields<br/>";
	}
	
	if(!empty($edit_register_no) && !empty($edit_student_name) && !empty($edit_class)) {
		$update = mysql_query("UPDATE students 
		          SET register_number = '$edit_register_no', student_name = '$edit_student_name', class = '$edit_class'
				  WHERE student_id = '$edit_student_id'");
		if($update) {
			$success_msg = "Student details updated successfully<br/>";
			echo '<meta http-equiv=Refresh content="5;url=addStudents">';
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
<title>Results - Edit Student</title>
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

<h1>Edit Student</h1>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">

<table class="tableAddSubject">

<tr>
<td><label class="form1Label form1LabelFontWeight">Register No.:</label></td>
<td>
<input class="form3Input" type="text" name="edit_register_no" 
value="<?php if(isset($_GET['submit'])) { echo $edit_register_no; } 
             else if(isset($_GET['student_id'])) { echo $row['register_number']; } ?>" />
</td>
<tr>

<tr>
<td><label class="form1Label form1LabelFontWeight">Student Name:</label></td>
<td>
<input class="form3Input" type="text" name="edit_student_name" 
value="<?php if(isset($_GET['submit'])) { echo $edit_student_name; } 
             else if(isset($_GET['student_id'])) { echo $row['student_name']; } ?>" />
</td>
<tr>

<tr>
<td><label class="form1Label form1LabelFontWeight">Class:</label></td>
<td>
<input class="form3Input" type="text" name="edit_class" 
value="<?php if(isset($_GET['submit'])) { echo $edit_class; } 
             else if(isset($_GET['student_id'])) { echo $row['class']; } ?>" />
</td>
<tr>

<input type="hidden" name="edit_student_id" 
value="<?php if(isset($_GET['submit'])) { echo $edit_student_id; }
             else if(isset($_GET['student_id'])) { echo $row['student_id']; } ?>" />

<tr>
<td colspan="2">
<input class="form1Button form3ButtonMargin" type="submit" name="submit" value="Update Student" /></td>
</tr>

</table>

</form>

</div>

</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
<?php database_disconnect($con); ?>