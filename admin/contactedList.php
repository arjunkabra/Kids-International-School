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
<link rel="stylesheet" href="css/jsStyler.css" type="text/css" />
<script src="scripts/SpryTabbedPanels.js" type="text/javascript"></script>
<script src="scripts/SpryURLUtils.js" type="text/javascript"></script>
<script type="text/javascript">
var params = Spry.Utils.getLocationParamsAsObject();
</script>
<link rel="shortcut icon" href="images/favicon.png" />
<title>Contacted List</title>
</head>

<body class="bgMain">

<?php include('includes/header.php'); ?>

<div class="mainIndex">

<?php include('includes/navigation.php'); ?>

<div class="pageName">
<img src="images/smallContactedEnquiries.png" />Contacted List
</div>

<div class="tabbedPanelBar">&nbsp;</div>
<div id="TabbedPanels1" class="TabbedPanels">
      <ul class="TabbedPanelsTabGroup">
        <li class="TabbedPanelsTab" tabindex="0">Main</li>
        <li class="TabbedPanelsTab" tabindex="0">Trash</li>
        <li class="TabbedPanelsTab" tabindex="0">Sent Mails</li>
      </ul>
<div class="TabbedPanelsContentGroup">
<div class="TabbedPanelsContent">
<table class="adminTableDashboard">
<tr>
<th class="thClStyle thClDate">Date</th>
<th class="thClStyle thClName">Name<hr />Email</th>
<th class="thClStyle thClMessage">Message</th>
<th class="thClStyle thClStatus">Status</th>
<th class="thClStyle thClOperation">Operation</th>
</tr>
<?php

if (isset($_GET['update'])) {
	
	$status_id=$_GET['status_id'];
	$status=$_GET['update_status'];
	mysql_query("UPDATE contact_us SET contact_status='$status' WHERE contact_id='$status_id'");
	
}

if(isset($_GET['trash_button']))  {
    
	$trash_id=$_GET['trash_id'];
    $trash_priority=$_GET['trash_priority'];
    mysql_query("UPDATE contact_us SET contact_priority='$trash_priority' WHERE contact_id='$trash_id'");
	
}

if(isset($_GET['offset'])) { $offset= $_GET['offset']; }

$limit = 10;
$numresults=mysql_query("select * from contact_us WHERE contact_priority = 1");
$numrows=mysql_num_rows($numresults);

if (empty($offset)) { $offset=0; }

$db_data=mysql_query("SELECT * FROM contact_us WHERE contact_priority = 1 ORDER BY contact_id DESC LIMIT $offset, $limit");
while($row=mysql_fetch_array($db_data)){
	echo "<tr>";
	echo "<td class=\"tdClStyle\">".$row['contact_date']."</td>";
	echo "<td class=\"tdClStyle\">".$row['contact_name']."<hr/>".$row['contact_email']."</td>";
	echo "<td class=\"tdClStyle\">".$row['contact_message']."</td>";
	echo "<td class=\"tdClStyle\">".$row['contact_status'].
		 "<hr/><form method=\"GET\">
		  <input name=\"status_id\" type=\"hidden\" value=".$row['contact_id']." />
		  <input type=\"text\" name=\"update_status\" placeholder=\"Update Status\">
		  <input class=\"clButtons clButtons1\" type=\"submit\" name=\"update\" value=\"Update\"></form></td>";
	echo "<form method=\"GET\" onSubmit=\"return confirm('Are you sure to trash this entre?')\">";
	echo "<input name=\"trash_id\" type=\"hidden\" value=".$row['contact_id']." />";
	echo "<input name=\"trash_priority\" type=\"hidden\" value=2 />";
	echo "<td class=\"tdClStyle\"><input class=\"clButtons clButtons1\" type=\"submit\" name=\"trash_button\" value=\"Trash\" />";
    echo "</form>";
	echo "<form action=\"mailer\" method=\"GET\">";
	echo "<input name=\"mailto_id\" type=\"hidden\" value=".$row['contact_id']." />";
	echo "<input class=\"clButtons clButtons1\" type=\"submit\" name=\"mailto_button\" value=\"Mail\" /></td>";
	echo "</form>";
	echo "</tr>";
}

?>
</table>
<div class="overflowBar">
<?php
if($numrows==0) {
	echo "You have no messages";
}
include('includes/overflow-function.php'); 
clPagination($offset,$limit,$numrows); 
?>
</div>
</div>

<div class="TabbedPanelsContent TabbedPanelsContentGroupOverflow">
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
echo '<meta http-equiv=Refresh content="0;url=contactedList?tab=1#TabbedPanels1">';
}

if(isset($_GET['delete_button']))  {

$delete_id=$_GET['delete_id'];
mysql_query("DELETE FROM contact_us WHERE contact_id='$delete_id'");
echo '<meta http-equiv=Refresh content="0;url=contactedList?tab=1#TabbedPanels1">';
}

$numresults=mysql_query("select * from contact_us WHERE contact_priority = 2");
$numrows=mysql_num_rows($numresults);

$db_data=mysql_query("SELECT * FROM contact_us WHERE contact_priority = 2 ORDER BY contact_id DESC");
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
?>
</div>
</div>
    
<div class="TabbedPanelsContent TabbedPanelsContentGroupOverflow">

<table class="adminTableDashboard">
<tr>
<td class="thClStyle thClDate">Date</td>
<td class="thClStyle thSmName">Name</td>
<td class="thClStyle thSmName">Email</td>
<td class="thClStyle thSmSubject">Subject</td>
<td class="thClStyle"></td>
</tr>

<?php

if(isset($_GET['delete_mail_button']))  {

$delete_mail_id=$_GET['delete_mail_id'];
mysql_query("DELETE FROM cu_sentmail WHERE cu_sm_id='$delete_mail_id'");
echo '<meta http-equiv=Refresh content="0;url=contactedList?tab=2#TabbedPanels1">';

}

$numresults=mysql_query("select * from cu_sentmail");
$numrows=mysql_num_rows($numresults);

$db_data=mysql_query("SELECT * FROM cu_sentmail ORDER BY cu_sm_id DESC");
				     while($row=mysql_fetch_array($db_data))
				        {
                     echo "<tr>";
					 echo "<td class=\"tdClStyle\">".$row['cu_sm_date']."</td>";
                     echo "<td class=\"tdClStyle\">".$row['cu_sm_name']."</td>";
                     echo "<td class=\"tdClStyle\">".$row['cu_sm_email']."</td>";
                     echo "<td class=\"tdClStyle\">".$row['cu_sm_subject']."</td>";
				     echo "<form action=\"mailViewer\" method=\"GET\">";
					 echo "<input name=\"sentMail_id_ce\" type=\"hidden\" value=".$row['cu_sm_id']." />";
					 echo "<td class=\"\">
					       <input class=\"clButtons clButtons1\" type=\"submit\" name=\"sentMail_ce_button\" value=\"Read\" />";
					 echo "</form>";
				     echo "<form method=\"GET\" onSubmit=\"return confirm('Are you sure to Delete this mail?')\">";
			   	     echo "<input name=\"delete_mail_id\" type=\"hidden\" value=".$row['cu_sm_id']." />";
					 echo "<input class=\"clButtons clButtons1\" type=\"submit\" name=\"delete_mail_button\" value=\"Delete\" /></td>";
					 echo "</form>";
					 echo "</tr>";
                        }

?>

</table>

<div class="overflowBar">
<?php
if($numrows==0) {
	echo "You have no sent mails ";
}
?>
</div>

</div>
</div>
</div>
</div>

<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1",{defaultTab: params.tab ? params.tab : 0});
//-->
</script>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
<?php database_disconnect($con); ?>