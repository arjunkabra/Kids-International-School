<?php 

require_once('config.php');
authenticate();
database_connect($DB_HOST, $DB_NAME, $DB_USER, $DB_PASSWORD);
admin_pass();

$error_1 = "";
$error_2 = "";
$error_3 = "";
$error_4 = "";
$success_msg_1 = "";
$success_msg_2 = "";

if(isset($_GET['submit'])) {
	$serial_no = $_GET['serial_no'];
	$subject_name = $_GET['subject_name'];
	$max_marks = $_GET['max_marks'];
	
	if(empty($serial_no) || empty($subject_name) || empty($max_marks)) {
		$error_1 = "Please fill in all the fields<br/>";
	}
	
	$check_serial = mysql_num_rows(mysql_query("SELECT * FROM subjects WHERE subject_serial_number='$serial_no'"));
	if($check_serial == 1) {
		$error_2 = "Serial number already assigned<br/>";
	}
	
	$check_subject = mysql_num_rows(mysql_query("SELECT * FROM subjects WHERE subject_name='$subject_name'"));
	if($check_subject == 1) {
		$error_3 = "Subject already exists<br/>";
	}
	
	if(!empty($serial_no) && !empty($subject_name) && !empty($max_marks) && ($check_subject == 0) && ($check_serial == 0)) {
		$query = mysql_query("INSERT INTO subjects(subject_serial_number, subject_name, max_marks)                                                            VALUES('$serial_no','$subject_name','$max_marks')");
		if($query) {
			$success_msg_1 = "Subject added successfully<br/>";
			$serial_no = "";
			$subject_name = "";
	        $max_marks = "";
		}
		else {
			$error_4 = "Error: ".mysql_error()."<br/>";
		}
	}
	
}

if(isset($_GET['delete']))  {
    
	$delete_id=$_GET['delete_id'];
    mysql_query("DELETE FROM subjects WHERE subject_id = '$delete_id'");
	$success_msg_2 = "Subject deleted successfully";
	
}

if(isset($_GET['change_status'])) {
	$result_status = $_GET['result_status'];
	$query2 = mysql_query("UPDATE configuration SET value = '$result_status' WHERE id_configuration = '1'");
	$success_msg_1 = "Result status changed";
}

$query1 = mysql_query("SELECT * FROM configuration WHERE id_configuration = '1'");
$enabled_disabled = mysql_fetch_assoc($query1);
$enabled_disabled = $enabled_disabled['value'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/universal.css" type="text/css" />
<link rel="stylesheet" href="css/tableStyler.css" type="text/css" />
<link rel="stylesheet" href="css/formStyler.css" type="text/css" />
<link rel="shortcut icon" href="images/favicon.png" />
<title>Results - Subject Details</title>
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
echo $error_3;
echo $error_4;
echo $success_msg_1;
echo $success_msg_2;
?>
</div>

<div class="addSubject">

<h1>Result status</h1>
<form style="margin:20px;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
<input <?php if($enabled_disabled == '1') { echo "checked"; } ?> type="radio" name="result_status" value="1" /><label> : Enable</label><br />
<input <?php if($enabled_disabled == '0') { echo "checked"; } ?> type="radio" name="result_status" value="0" /><label> : Disable</label><br />
<input style="float:none !important;margin:10px 0 0 35px;" class="form1Button" type="submit" name="change_status" value="Change_status" />
</form>

<h1>Add Subjects</h1>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">

<table class="tableAddSubject">

<tr>
<td><label class="form1Label form1LabelFontWeight">Serial No.:</label></td>
<td>
<input class="form3Input" type="text" name="serial_no" value="<?php if(isset($_GET['submit'])) { echo $serial_no; } ?>" />
</td>
<tr>

<tr>
<td><label class="form1Label form1LabelFontWeight">Subject Name:</label></td>
<td>
<input class="form3Input" type="text" name="subject_name" value="<?php if(isset($_GET['submit'])) { echo $subject_name; } ?>" />
</td>
<tr>

<tr>
<td><label class="form1Label form1LabelFontWeight">Max Marks:</label></td>
<td>
<input class="form3Input" type="text" name="max_marks" value="<?php if(isset($_GET['submit'])) { echo $max_marks; } ?>" />
</td>
<tr>

<tr>
<td colspan="2">
<input class="form1Button form3ButtonMargin" type="submit" name="submit" value="Add Subject" /></td>
</tr>

</table>

</form>

</div>

<table class="tableViewSubjects">

<tr>
<th class="tdadminTableDashboard thadminTableDashboardFont thTableSubjectsName" >Subject</th>
<th class="tdadminTableDashboard thadminTableDashboardFont thTableSubjectsMaxMarks">Max Marks</th>
<th class="tdadminTableDashboard thadminTableDashboardFont thTableSubjectsOperation">Operations</th>
</tr>

<?php

$subject = mysql_query("SELECT * FROM subjects ORDER BY subject_serial_number ASC");
while($subjects_list = mysql_fetch_array($subject)) {
	echo "<tr>";
	echo "<td class=\"tdClStyle\">".$subjects_list['subject_name']."</td>";
	echo "<td class=\"tdClStyle\">".$subjects_list['max_marks']."</td>";
	echo "<td class=\"tdClStyle\">";
	echo "<form action=\"editSubject\" method=\"GET\">";
	echo "<input type=\"hidden\" name=\"subject_id\" value=".$subjects_list['subject_id']." />";
	echo "<input class=\"clButtons clButtons1\" type=\"submit\" name=\"edit\" value=\"Edit\">";
	echo "</form>";
	echo "<form method=\"GET\" onSubmit=\"return confirm('Are you sure to trash this entre?')\">";
	echo "<input name=\"delete_id\" type=\"hidden\" value=".$subjects_list['subject_id']." />";
	echo "<input class=\"clButtons clButtons1\" type=\"submit\" name=\"delete\" value=\"Delete\" />";
    echo "</form>";
	echo "</td>";
	echo "</tr>";
}

?>

</table>
<div style="clear:both">&nbsp;</div>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
<?php database_disconnect($con); ?>