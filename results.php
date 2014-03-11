<?php

require_once('admin/config.php');
database_connect($DB_HOST, $DB_NAME, $DB_USER, $DB_PASSWORD);

$error_1 = "";
$error_2 = "";
$student_name = "";
$student_number = "";
$student_class = "";

if(isset($_POST['result_fetch'])) {
$register_no = $_POST['register_no'];

if(empty($register_no)) {
$error_1 = "Please enter register number";
}

if(!empty($register_no)) {
$student_query = mysql_query("SELECT * FROM students WHERE register_number = '$register_no'");
if(mysql_num_rows($student_query) == 0) {
$error_2 = "Student with this register number does not exist";
}

if(mysql_num_rows($student_query) == 1) {
	
$student_details = mysql_fetch_array($student_query);
$student_name = $student_details['student_name'];
$student_number = $student_details['register_number'];
$student_class = $student_details['class'];
$result_query = mysql_query("SELECT 
mr.marks_obtained,sd.register_number,sd.student_name,sd.class,sj.subject_serial_number,sj.subject_name,sj.max_marks
FROM marks AS mr
INNER JOIN students AS sd USING(student_id)
INNER JOIN subjects AS sj USING(subject_id)
WHERE sd.register_number = '$register_no'
ORDER BY sj.subject_serial_number ASC");
}
}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Results</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/slidemenu.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon.png">
<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jqueryslidemenu.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-27771112-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body class="bodyBG">

<?php include('shared-resorces/header.php'); ?>

<div class="innerPage_teaser">
<div class="teaserContent">&nbsp;
<h2 class="pageName">Results</h2>
<h6 class="breadCrumb">You are Here : <a class="breadCrumbLink" href="home">Home</a> >> Results</h6>
&nbsp;</div>
</div>

<div class="contentIndex" id="contentindexHeightAS">
<div class="contentIndexleft">
<?php

$query1 = mysql_query("SELECT * FROM configuration WHERE id_configuration = '1'");
$enabled_disabled = mysql_fetch_assoc($query1);
if($enabled_disabled['value'] == '1') {

$query = mysql_fetch_array(mysql_query("SELECT * FROM configuration WHERE id_configuration = 2"));
$message = $query['additional_info'];
?>
<h2><?php echo $message; ?></h2>

<div class="resultMessage">
<?php
echo $error_1;
echo $error_2; 
?>
</div>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

<table class="widget_result">

<tr>
<td><label class="formLabel">Register Number:</label></td>
<td><input class="textbox" id="textAreaSidebar" type="text" name="register_no" /></td>
</tr>

<tr>
<td colspan="2"><input id="resultButton" type="submit" name="result_fetch" value="Submit" /></td>
</tr>

</table>

</form>

<?php
if(isset($_POST['result_fetch'])) {
if(!empty($register_no)) {
if(mysql_num_rows($student_query) == 1) {
?>
<table class="widget_result">

<tr>
<td class="resultLabel">Student Name:</td>
<td><?php echo $student_name; ?></td>
</tr>

<tr>
<td class="resultLabel">Register Number:</td>
<td><?php echo $student_number; ?></td>
</tr>

<tr>
<td class="resultLabel">Class:</td>
<td><?php echo $student_class; ?></td>
</tr>

</table>

<table class="tableAddStudents" style="margin-top:15px;">

<tr>
<th class="tdadminTableDashboard thadminTableDashboardFont thAddMarksSubject">Subject Name</th>
<th class="tdadminTableDashboard thadminTableDashboardFont thAddMarksMaxMarks">Max Marks</th>
<th class="tdadminTableDashboard thadminTableDashboardFont thAddMarksMaxMarks">Marks Obtained</th>
</tr>

<?php
$total = 0;
$ranking = "";
while($result = mysql_fetch_array($result_query)) {
echo "<tr>";
echo "<td class=\"tdClStyle\">".$result['subject_name']."</td>";
echo "<td class=\"tdClStyle\">".$result['max_marks']."</td>";
echo "<td class=\"tdClStyle\">".$result['marks_obtained']."</td>";
echo "</tr>";
$total = $total + $result['marks_obtained'];
}
$max_marks = mysql_query("SELECT max_marks FROM subjects");
$maxMarks_total = 0;
while($maxMarks_row_total = mysql_fetch_array($max_marks)) {
$maxMarks_total = $maxMarks_total + $maxMarks_row_total['max_marks'];
}
echo "<tr>";
echo "<td class=\"tdadminTableDashboard thadminTableDashboardFont thAddMarksSubject\" colspan=\"3\">Max marks: ".$maxMarks_total;
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td class=\"tdadminTableDashboard thadminTableDashboardFont thAddMarksSubject\" colspan=\"3\">Total marks obtained: ".$total;
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td class=\"tdadminTableDashboard thadminTableDashboardFont thAddMarksSubject\" colspan=\"3\">";
if($total>630) { echo $ranking = "Grade: A+"; }
  else if($total>=525 && $total<629) { echo $ranking = "Grade: A"; }
  else if($total>=420 && $total<524) { echo $ranking = "Grade: B+"; }
  else if($total>=350 && $total<419) { echo $ranking = "Grade: B"; }
  else if($total<=349) { echo $ranking = "Grade: C"; }
echo "</td>";

?>

</table>

<?php 
} } } }

else if($enabled_disabled['value'] == '0') {
	echo "<h2>No results to display</h2>";
}

?>

</div>
<div class="contentindexRight">
<?php include('shared-resorces/sidebar.php'); ?>
</div>
</div>

<?php include('shared-resorces/footer.php'); ?>

</body>
</html>
<?php database_disconnect($con) ?>