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
<link rel="stylesheet" href="css/jsStyler.css" type="text/css" />
<script src="scripts/SpryCollapsiblePanel.js" type="text/javascript"></script>
<link rel="shortcut icon" href="images/favicon.png" />
<title>Dashboard | <?php echo $org_name; ?></title>
</head>

<body class="bgMain">

<?php include('includes/header.php'); ?>

<div class="mainIndex">

<?php include('includes/navigation.php'); ?>

<div class="pageName">
<img src="images/smallDashboard.png" />Dashboard
</div>

<div id="CollapsiblePanel1" class="CollapsiblePanel CollapsiblePanel1Width">
<div class="CollapsiblePanelTab" tabindex="0"><img src="images/helpCP.png" />Dashboard Help</div>
<div class="CollapsiblePanelContent">
<ul class="ulList">
<li><span class="ulSpan">Contacted List</span> - Manage all the contacted enquiries and perform the operations like delete, update status and email.</li>
<li><span class="ulSpan">Results</span> - Announce the results of Annual exams and midterm exams of all the students. Easily manage the list of marks and students by using the advanced tools provided in the results section.</li>
<li><span class="ulSpan">My Account</span> – You can manage your profile from this section. You can perform operations like editing your details, change password and reset cookies to logout universally.</li>
<li><span class="ulSpan">Add Admin</span> – From this section you can add administrator accounts to perform the website management process. There are two levels in admin rights - Super Admin and Admin. You can choose a suitable type while registering a new admin.</li>
<li><span class="ulSpan">View Admin</span> – From this section you can view all registered administrator and perform the operation's like delete admin and changing admin rights.</li>
<li><span class="ulSpan">Sent Mails</span> - View all the sent mails from your dashboard to contacted enquiries.</li>
<li><span class="ulSpan">Trash</span> – Trash is nothing but recycle bin. You can recycle the deleted items from the contacted list.</li>
</ul>

</div>
</div>

<div id="CollapsiblePanel2" class="CollapsiblePanel CollapsiblePanel2Width">
<div class="CollapsiblePanelTab" tabindex="0"><img src="images/adminsCP.png" />Registered Administrators</div>
<div class="CollapsiblePanelContent">
<table class="adminTableDashboard">
<tr>
<th class="tdadminTableDashboard thadminTableDashboardFont thadminTableDashboardID">ID</th>
<th class="tdadminTableDashboard thadminTableDashboardFont thadminTableDashboardDate">Date</th>
<th class="tdadminTableDashboard thadminTableDashboardFont thadminTableDashboardName">Name</th>
<th class="tdadminTableDashboard thadminTableDashboardFont thadminTableDashboardUsername">Username</th>
<th class="tdadminTableDashboard thadminTableDashboardFont thadminTableDashboardeMail">Email</th>
<th class="tdadminTableDashboard thadminTableDashboardFont thadminTableDashboardType">Admin Type</th>
</tr>

<?php

if(isset($_GET['offset'])) { $offset= $_GET['offset']; }

$limit = 5;
$numresults=mysql_query("select * from admins");
$numrows=mysql_num_rows($numresults);

if (empty($offset)) { $offset=0; }

$data = mysql_query("SELECT * FROM admins ORDER BY admin_id ASC LIMIT $offset, $limit");
while($row = mysql_fetch_array($data)) {
echo "<tr>";
echo "<th class=\"tdadminTableDashboard thadminTableDashboardID\">".$row['admin_id']."</th>";
echo "<th class=\"tdadminTableDashboard thadminTableDashboardDate\">".$row['admin_date']."</th>";
echo "<th class=\"tdadminTableDashboard thadminTableDashboardName\">".$row['admin_name']."</th>";
echo "<th class=\"tdadminTableDashboard thadminTableDashboardUsername\">".$row['admin_username']."</th>";
echo "<th class=\"tdadminTableDashboard thadminTableDashboardeMail\">".$row['admin_email']."</th>";
echo "<th class=\"tdadminTableDashboard thadminTableDashboardType\">".$row['admin_type']."</th>";
echo "</tr>	";
}
?>

</table>

<div class="overflowBar">
<?php 
include('includes/overflow-function.php'); 
dashboardPagination($offset,$limit,$numrows); 
?>
</div>

</div>
</div>

<script type="text/javascript">
<!--
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1", { duration: 200, enableKeyboardNavigation:true, contentIsOpen: false });
var CollapsiblePanel2 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel2", { duration: 200, enableKeyboardNavigation:true });
//-->
</script>

</div>

<?php include('includes/footer.php'); ?>

</body>
</html>

<?php database_disconnect($con); ?>