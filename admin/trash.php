<?php 

require_once('config.php');
authenticate();
database_connect($DB_HOST, $DB_NAME, $DB_USER, $DB_PASSWORD);
admin_pass();


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/universal.css" type="text/css" />
<link rel="stylesheet" href="css/tableStyler.css" type="text/css" />
<link rel="stylesheet" href="css/formStyler.css" type="text/css" />
<link rel="shortcut icon" href="images/favicon.png" />
<title>Trash</title>
</head>

<body class="bgMain">

<?php include('includes/header.php'); ?>

<div class="mainIndex">

<?php include('includes/navigation.php'); ?>

<div class="pageName">
<img src="images/smallTrash.png" />Trash
</div>

<table class="adminTableDashboard">
<tr>
<th class="thClStyle thClDate">Date</th>
<th class="thClStyle thClName">Name<hr />Email</th>
<th class="thClStyle thClMessage">Message</th>
<th class="thClStyle thClStatus">Status</th>
<th class="thClStyle thClOperation">Operation</th>
</tr>
<?php

if(isset($_GET['restore_button']))  {

$restore_id=$_GET['restore_id'];
$restore_priority=$_GET['restore_priority'];
mysql_query("UPDATE contact_us SET contact_priority='$restore_priority' WHERE contact_id='$restore_id'");
echo '<meta http-equiv=Refresh content="0;url=trash">';
}

if(isset($_GET['delete_button']))  {

$delete_id=$_GET['delete_id'];
mysql_query("DELETE FROM contact_us WHERE contact_id='$delete_id'");
echo '<meta http-equiv=Refresh content="0;url=trash">';
}

if(isset($_GET['offset'])) { $offset= $_GET['offset']; }

$limit = 10;
$numresults=mysql_query("select * from contact_us WHERE contact_priority = 2");
$numrows=mysql_num_rows($numresults);

if (empty($offset)) { $offset=0; }

$db_data=mysql_query("SELECT * FROM contact_us WHERE contact_priority = 2 ORDER BY contact_id DESC LIMIT $offset, $limit");
while($row=mysql_fetch_array($db_data)){
	echo "<tr>";
	echo "<td class=\"tdClStyle\">".$row['contact_date']."</td>";
	echo "<td class=\"tdClStyle\">".$row['contact_name']."<hr/>".$row['contact_email']."</td>";
	echo "<td class=\"tdClStyle\">".$row['contact_message']."</td>";
	echo "<td class=\"tdClStyle\">".$row['contact_status']."</td>";
	echo "<form method=\"GET\">";
	echo "<input name=\"restore_id\" type=\"hidden\" value=".$row['contact_id']." />";
	echo "<input name=\"restore_priority\" type=\"hidden\" value=1 />";
	echo "<td class=\"tdClStyle\"><input class=\"clButtons clButtons1\" type=\"submit\" name=\"restore_button\" value=\"Restore\" />";
    echo "</form>";
	echo "<form method=\"GET\" onSubmit=\"return confirm('Are you sure to Delete this entre?')\">";
	echo "<input name=\"delete_id\" type=\"hidden\" value=".$row['contact_id']." />";
	echo "<input class=\"clButtons clButtons1\" type=\"submit\" name=\"delete_button\" value=\"Delete\" /></td>";
	echo "</form>";
	echo "</tr>";
}

?>
</table>
<div class="overflowBar">
<?php
if($numrows==0) {
	echo "Your trash is empty";
}
include('includes/overflow-function.php'); 
trashPagination($offset,$limit,$numrows);
?>
</div>

</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
<?php database_disconnect($con); ?>