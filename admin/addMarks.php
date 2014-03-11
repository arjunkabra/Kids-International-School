<?php 

require_once('config.php');
authenticate();
database_connect($DB_HOST, $DB_NAME, $DB_USER, $DB_PASSWORD);
admin_pass();

$error_1 = "";
$error_2 = "";
$success_msg = "";

$student_id = $_GET['student_id'];
$students = mysql_query("SELECT * FROM students WHERE student_id = '$student_id'");
$students_fetch = mysql_fetch_array($students);

if(isset($_GET['addmarks'])) {
for ( $i=0;$i<count($_GET['add_subject_id']);$i++) {
$marks_obtained = $_GET['marks_obtained'][$i];
$add_subject_id = $_GET['add_subject_id'][$i];
$query = mysql_query("
		 INSERT INTO marks(subject_id, student_id, marks_obtained) 
		 VALUES('$add_subject_id', '$student_id', '$marks_obtained')
				 ");
}
$success_msg = "Marks added successfully";
}

if(isset($_GET['editmarks'])) {
for ( $i=0;$i<count($_GET['add_subject_id']);$i++) {
$marks_obtained = $_GET['marks_obtained'][$i];
$add_subject_id = $_GET['add_subject_id'][$i];
$query = mysql_query("
		 UPDATE marks SET 
					  marks_obtained = '$marks_obtained' 
		              WHERE student_id = '$student_id' AND subject_id = '$add_subject_id'
				 ");
}
$success_msg = "Marks Updated successfully";
}

if(isset($_GET['clear_marks'])) {
	$student_id = $_GET['student_id'];
	$query = mysql_query("DELETE FROM marks WHERE student_id = '$student_id'");
	
	if($query) {
     $success_msg = "Marks of all the subjects cleared successfully";
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
<title>Dashboard | <?php echo $org_name; ?></title>
<script type="text/javascript">
function validate(){
	var marks_obtained = document.getElementsByName('marks_obtained[]');
		for (i=0; i<marks_obtained.length; i++) {
			 if (marks_obtained[i].value == "") {
			 	 alert('Please provide marks for all the subjects');		 
			 	 return false;
				}
			}
}
</script>
</head>

<body class="bgMain">

<?php include('includes/header.php'); ?>

<div class="mainIndex">

<?php include('includes/sub-navigation.php'); ?>

<div class="pageName">
<img src="images/smallDashboard.png" />Results
</div>

<div class="adminMessage">
<?php
echo $error_1;
echo $error_2;
echo $success_msg;
?>
</div>

<div class="addSubject">
<h1>Add Marks</h1>
</div>

<table class="tableAddStudents" style="margin-top:15px;">

<tr>
<th class="tdadminTableDashboard thadminTableDashboardFont thAddMarksSubject">Subject Name</th>
<th class="tdadminTableDashboard thadminTableDashboardFont thAddMarksMaxMarks">Max Marks</th>
<th class="tdadminTableDashboard thadminTableDashboardFont thAddMarksMaxMarks">Marks Obtained</th>
</tr>

<?php

$subjects = mysql_query("SELECT * FROM subjects ORDER BY subject_serial_number ASC");
while($row_subjects = mysql_fetch_array($subjects)) {
	echo "<tr>";
	echo "<td class=\"tdClStyle\">".$row_subjects['subject_name']."</td>";
	echo "<td class=\"tdClStyle\">".$row_subjects['max_marks']."</td>";
	$marks = mysql_query("SELECT * FROM marks WHERE subject_id = '".$row_subjects['subject_id']."' AND student_id = '$student_id' ");
	$row_marks = mysql_fetch_array($marks);
	
	echo "<td class=\"tdClStyle\">";
	echo "<form method=\"GET\" onSubmit=\"return validate(this);\">";
	echo "<input id=\"marksInput\" type=\"text\" name=\"marks_obtained[]\" placeholder=\"Enter Marks\" 
	value=".$row_marks['marks_obtained'].">";
	echo "<input type=\"hidden\" name=\"add_subject_id[]\" value=".$row_subjects['subject_id'].">";
	echo "<input type=\"hidden\" name=\"student_id[]\" value=".$student_id.">";
	echo "</td>";
	echo "</tr>";
    }
    $marks_total = mysql_query("SELECT marks_obtained FROM marks WHERE student_id = '$student_id' ");
    $total = 0;
	$ranking = "";
    while($row_total = mysql_fetch_array($marks_total)) {
	$total = $total + $row_total['marks_obtained'];
    }
	$max_marks = mysql_query("SELECT max_marks FROM subjects");
    $maxMarks_total = 0;
    while($maxMarks_row_total = mysql_fetch_array($max_marks)) {
	$maxMarks_total = $maxMarks_total + $maxMarks_row_total['max_marks'];
    }
	echo "<tr>";
	echo "<td class=\"tdClStyle\">Total</td>";
	echo "<td class=\"tdClStyle\">".$maxMarks_total."</td>";
	echo "<td class=\"tdClStyle\">".$total."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"tdadminTableDashboard thadminTableDashboardFont thAddMarksSubject\">Name: "
	     .$students_fetch['student_name']."</td>";
    echo "</tr>";
	echo "<tr>";
	echo "<td class=\"tdadminTableDashboard thadminTableDashboardFont thAddMarksSubject\">Register no.: "
	     .$students_fetch['register_number']."</td>";
    echo "</tr>";
	echo "<tr>";
	echo "<td class=\"tdadminTableDashboard thadminTableDashboardFont thAddMarksSubject\">Class: "
	     .$students_fetch['class']."</td>";
    echo "</tr>";
	echo "<tr>";
	echo "<td class=\"tdadminTableDashboard thadminTableDashboardFont thAddMarksSubject\">Total: ".$total."</td>";
    echo "</tr>";
	echo "<tr>";
	echo "<td class=\"tdadminTableDashboard thadminTableDashboardFont thAddMarksSubject\">";
	if($total>630) { echo $ranking = "Grade: A+"; }
	else if($total>=525 && $total<629) { echo $ranking = "Grade: A"; }
	else if($total>=420 && $total<524) { echo $ranking = "Grade: B+"; }
	else if($total>=350 && $total<419) { echo $ranking = "Grade: B"; }
	else if($total<=349) { echo $ranking = "C"; }
	echo "</td>";
	echo "<td colspan=\"3\">";
	echo "<input type=\"hidden\" name=\"student_id\" value=".$student_id." />";
	echo "<input class=\"overflow overflowPadding overflowMargin\" type=\"submit\" name=\"addmarks\" value=\"Add Marks\">";
	echo "<input class=\"overflow overflowPadding overflowMargin\" type=\"submit\" name=\"editmarks\" value=\"Edit Marks\"
	             onclick=\"return confirm('Are you sure to update the marks entry?')\" >";
	echo "<input class=\"overflow overflowPadding overflowMargin\" type=\"submit\" name=\"clear_marks\" value=\"Clear Marks\"
	             onclick=\"return confirm('Are you sure to clear the marks entry?')\"   />";
	echo "</form>";
?>

</table>
<a style="float:right;margin-right:195px;" class="overflow overflowPadding"  href="addStudents">Back to Students</a>
<div style="clear:both">&nbsp;</div>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
<?php database_disconnect($con); ?>