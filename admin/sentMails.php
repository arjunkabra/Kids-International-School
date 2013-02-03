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
<link rel="shortcut icon" href="images/favicon.png" />
<title>Sent Mails</title>
</head>

<body class="bgMain">

<?php include('includes/header.php'); ?>

<div class="mainIndex">

<?php include('includes/navigation.php'); ?>

<div class="pageName">
<img src="images/smallSentMails.png" />Sent Mails
</div>

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
echo '<meta http-equiv=Refresh content="0;url=sentMails">';

}

if(isset($_GET['offset'])) { $offset= $_GET['offset']; }

$limit = 10;
$numresults=mysql_query("select * from cu_sentmail");
$numrows=mysql_num_rows($numresults);

if (empty($offset)) { $offset=0; }

$db_data=mysql_query("SELECT * FROM cu_sentmail ORDER BY cu_sm_id DESC LIMIT $offset, $limit");
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
					       <input class=\"clButtons clButtons1\" type=\"submit\" name=\"sentMail_sm_button\" value=\"Read\" />";
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
include('includes/overflow-function.php'); 
smPagination($offset,$limit,$numrows);
?>
</div>

</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
<?php database_disconnect($con); ?>