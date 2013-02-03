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
<title>View Admins</title>
</head>

<body class="bgMain">

<?php include('includes/header.php'); ?>

<div class="mainIndex">

<?php include('includes/navigation.php'); ?>

<div class="pageName">
<img src="images/smallViewAdmins.png" />View Admins
</div>
<div class="adminMessage">
<?php
if (isset($_GET['delete_button'])) {
$id=$_GET['id'];

mysql_query("DELETE FROM admins WHERE admin_id='$id'");
echo "Administrator deleted successfully";
}

if (isset($_GET['update_type'])) {
   $id=$_GET['id'];
   $make_type=$_GET['make_type'];

   if($make_type=="Super-Admin" ) {
           $update=mysql_query("UPDATE admins SET admin_priority=1, admin_type='$make_type' WHERE admin_id='$id'");
		   if(!$update) { echo "Error: ".mysql_error(); }
		   else {
			   echo "Type Updated to Super Admin";
		   }
       }
   else if($make_type=="Admin") {
           $update=mysql_query("UPDATE admins SET admin_priority=2, admin_type='$make_type' WHERE admin_id='$id'");
		   if(!$update){ echo "Error: ".mysql_error(); }
		   else {
			   echo "Type Updated to Admin";
		   }
       }
   else if($make_type=="Select-Type") {
           echo "Please Select Type";
       }
}
$access=mysql_query("SELECT * FROM admins where admin_id='".$_SESSION['admin_id']."'");
$check=mysql_fetch_array($access);
if($check['admin_priority']==2) { 
echo "This area can be viewed only by super administrators, You dont have enough permission";
}
?>
</div>

<?php if($check['admin_priority']==1) { ?>

<table style="margin-bottom:15px;" class="adminTableDashboard">
<tr>
<th class="thClStyle">ID</th>
<th class="thClStyle">Name<hr />User Name</th>
<th class="thClStyle">Email</th>
<th class="thClStyle">Change Admin Type</th>
<th class="thClStyle">&nbsp;</th>
</tr>

<?php

if(isset($_GET['offset'])) { $offset= $_GET['offset']; }

$limit = 5;
$numresults=mysql_query("select * from admins");
$numrows=mysql_num_rows($numresults);

if (empty($offset)) { $offset=0; }

$db_data=mysql_query("SELECT * FROM admins ORDER BY admin_id ASC LIMIT $offset, $limit");
				     while($row=mysql_fetch_array($db_data)) {
                     echo "<tr>";
					 echo "<td class=\"tdClStyle\">".$row['admin_id']."</td>";
                     echo "<td class=\"tdClStyle\">".$row['admin_name']."<hr/>".$row['admin_username']."</td>";
					 echo "<td class=\"tdClStyle\">".$row['admin_email']."</td>";
                     echo "<td class=\"tdClStyle\">".$row['admin_type']."<hr/>";
					 echo "<form method=\"get\">";
					 echo "<input name=\"id\" type=\"hidden\" value=".$row['admin_id']." />";
					 echo "<select name=\"make_type\">
					       <option>Select-Type</option>
                           <option>Admin</option>
                           <option>Super-Admin</option>
                           </select>";
					 echo "<input class=\"clButtons clButtons2\" name=\"update_type\" type=\"submit\" value=\"Update Type\" />";
					 echo "</form></td>";
				     echo "<td class=\"tdClStyle\">
					       <form method=\"GET\" onSubmit=\"return confirm('Are you sure to delete this admin?')\">";
			   	     echo "<input name=\"id\" type=\"hidden\" value=".$row['admin_id']." />";
					 echo "<input class=\"clButtons clButtons1\" type=\"submit\" name=\"delete_button\" value=\"Delete\" />";
					 echo "</form></td>";
					 echo "</tr>";
                     }
					 echo "<tr><th class=\"TableOverflow\" colspan=\"5\">";
					 include('includes/overflow-function.php'); 
					 viewAdminsPagination($offset,$limit,$numrows);
					 echo "</th></tr>";

?>
</table>
<?php } ?>

</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
<?php database_disconnect($con); ?>