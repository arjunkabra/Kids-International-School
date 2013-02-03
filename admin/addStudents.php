<?php 

require_once('config.php');
authenticate();
database_connect($DB_HOST, $DB_NAME, $DB_USER, $DB_PASSWORD);
admin_pass();

$error_1 = "";
$error_2 = "";
$error_3 = "";
$success_msg_1 = "";
$success_msg_2 = "";

if(isset($_GET['submit'])) {
	$register_number = $_GET['register_number'];
	$student_name = $_GET['student_name'];
	$class = $_GET['class'];
	
	if(empty($register_number) || empty($student_name) || empty($class)) {
		$error_1 = "Please fill in all the fields<br/>";
	}
	
	$check_register_number = mysql_num_rows(mysql_query("SELECT * FROM students WHERE register_number='$register_number'"));
	if($check_register_number == 1) {
		$error_2 = "Register number already assigned<br/>";
	}
	
	if(!empty($register_number) && !empty($student_name) && !empty($class) && ($check_register_number == 0)) {
		$query = mysql_query("INSERT INTO students(register_number, student_name, class)                                                            VALUES('$register_number','$student_name','$class')");
		if($query) {
			$success_msg_1 = "Student added successfully<br/>";
			$register_number = "";
			$student_name = "";
	        $class = "";
		}
		else {
			$error_3 = "Error: ".mysql_error()."<br/>";
		}
	}
}

if(isset($_GET['delete_id']))  {
    
	$delete_id=$_GET['delete_id'];
    mysql_query("DELETE FROM students WHERE student_id = '$delete_id'");
	mysql_query("DELETE FROM marks WHERE student_id = '$delete_id'");
	$success_msg_2 = "Student deleted successfully";

}

if(isset($_GET['delete_selected'])) {
  if(empty($_GET['checkbox'])) {
      $error_1 = "Use checkbox to select";
  }
  if(!empty($_GET['checkbox'])) {
  $id = array();
  $id = $_GET['checkbox'];
  if (count($id) > 0) {
     foreach ($id as $checkbox) {
		mysql_query("DELETE FROM students WHERE student_id = '$checkbox'");
	    mysql_query("DELETE FROM marks WHERE student_id = '$checkbox'");
		$success_msg_1 = "Selected students deleted successfully";
     }
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
<title>Results - Add Students</title>
</head>

<body class="bgMain">

<?php include('includes/header.php'); ?>

<div class="mainIndex">

<?php include('includes/sub-navigation.php'); ?>

<div class="pageName">
<img src="images/smallResults.png" />Results - Add Students and Marks
</div>

<div class="adminMessage">
<?php
echo $error_1;
echo $error_2;
echo $error_3;
echo $success_msg_1;
echo $success_msg_2;
?>
</div>

<div class="addSubject">

<h1>Add Student</h1>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">

<table class="tableAddSubject">

<tr>
<td><label class="form1Label form1LabelFontWeight">Register No.:</label></td>
<td>
<input class="form3Input" type="text" name="register_number" value="<?php if(isset($_GET['submit'])){ echo $register_number; } ?>" />
</td>
</tr>

<tr>
<td><label class="form1Label form1LabelFontWeight">Student Name:</label></td>
<td>
<input class="form3Input" type="text" name="student_name" value="<?php if(isset($_GET['submit'])){ echo $student_name; } ?>" />
</td>
</tr>

<tr>
<td><label class="form1Label form1LabelFontWeight">Class:</label></td>
<td>
<input class="form3Input" type="text" name="class" value="<?php if(isset($_GET['submit'])){ echo $class; } ?>" />
</td>
</tr>

<tr>
<td colspan="2"><input class="form1Button form3ButtonMargin" type="submit" name="submit" value="Add Student" /></td>
</tr>

</table>

</form>

</div>

<table class="tableAddStudents">

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">

<tr>
<th class="tdadminTableDashboard thadminTableDashboardFont thAddStudentsReg">Register No.</th>
<th class="tdadminTableDashboard thadminTableDashboardFont thAddStudentsName">Name</th>
<th class="tdadminTableDashboard thadminTableDashboardFont thAddStudentsClass">Class</th>
<th class="tdadminTableDashboard thadminTableDashboardFont thAddStudentsBtt1">
<input onclick="return confirm('Are you sure to delete selected entries permanently?')" 
	             class="clButtons" name="delete_selected" type="submit" value="Delete Selected">
</th>
<th class="tdadminTableDashboard thadminTableDashboardFont thAddStudentsBtt2"></th>
</tr>

<?php

if(isset($_GET['offset'])) { $offset= $_GET['offset']; }
if (empty($offset)) { $offset=0; }
$limit = 50;
$numresults=mysql_query("select * from students");
$numrows=mysql_num_rows($numresults);

$students = mysql_query("SELECT * FROM students ORDER BY student_id ASC LIMIT $offset, $limit");
while($row = mysql_fetch_array($students)) {
	echo "<tr>";
	echo "<td class=\"tdClStyle\">".$row['register_number']."</td>";
	echo "<td class=\"tdClStyle\">".$row['student_name']."</td>";
	echo "<td class=\"tdClStyle\">".$row['class']."</td>";
	echo "<td class=\"tdClStyle\">";
	echo "<a style=\"margin-top:10px\" class=\"clButtons clButtons1\" 
	                                   href=\"editStudents?student_id=".$row['student_id']."\">Edit</a>";
	echo "<a style=\"margin-top:10px\" onclick=\"return confirm('Are you sure to delete this entre permanently?')\" 
	         class=\"clButtons clButtons1\" href=\"addStudents?delete_id=".$row['student_id']."\">Delete</a>"; 
	echo "<input style=\"float:right;margin-top:14px;\" name=\"checkbox[]\" type=\"checkbox\" value=".$row['student_id']." />";
	echo "</td>";
	echo "<td class=\"tdClStyle\">";
	echo "<a style=\"margin-top:-10px\" class=\"clButtons clButtons1\" href=\"addMarks?student_id=".$row['student_id']."\">Marks</a>";
	echo "</td>";
	echo "</tr>";
} 
    echo "<tr>";
	echo "<td colspan=\"3\"></td>";
	echo "<td>";
	echo "<input style=\"margin:7px 0px 0px 34px\" onclick=\"return confirm('Are you sure to delete selected entries permanently?')\" 
	             class=\"clButtons\" name=\"delete_selected\" type=\"submit\" value=\"Delete Selected\">";
	echo "</td>";
	echo "<td></td>";
	echo "</tr>";
	echo "<tr><td colspan=\"5\"><hr/></td></tr>";
    echo "<tr><th class=\"TableOverflow\" colspan=\"6\">";
	      include('includes/overflow-function.php'); 
		  addStudentsPagination($offset,$limit,$numrows);
	echo "</th></tr>";

?>

</form>

</table>

</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
<?php database_disconnect($con); ?>