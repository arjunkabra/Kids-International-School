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
<title>Sent mail viewer</title>
</head>

<body class="bgMain">

<?php include('includes/header.php'); ?>

<div class="mainIndex">

<?php include('includes/navigation.php'); ?>

<div class="pageName">
<img src="images/smallMailer.png" />Sent mail viewer
</div>

<?php

if(isset($_GET['delete_mail_button_cu']))  {
	
$delete_mail_id=$_GET['delete_mail_id_cu'];
mysql_query("DELETE FROM cu_sentmail WHERE cu_sm_id='$delete_mail_id'");
echo '<meta http-equiv=Refresh content="0;url=contactedList?tab=2#TabbedPanels1">';

}

if(isset($_REQUEST['sentMail_ce_button'])) {
	
    $sentMail_id_ce=$_REQUEST['sentMail_id_ce'];
    $db_data=mysql_query("SELECT * FROM cu_sentmail WHERE cu_sm_id='$sentMail_id_ce'");
    $disp_data=mysql_fetch_array($db_data);
    $mail_date=$disp_data['cu_sm_date'];
    $mailto_name=$disp_data['cu_sm_name'];
    $mailto_email=$disp_data['cu_sm_email'];
	$mailto_subject=$disp_data['cu_sm_subject'];
	$mailto_message=$disp_data['cu_sm_message'];

?>

<table class="tableMailViewer">

<tr>
<td class="thMailViewer">Sent to:</td>
<td class="thMailViewer"><?php echo $mailto_email; ?></td>
</tr>

<tr>
<td class="thMailViewer">Name:</td>
<td class="thMailViewer"><?php echo $mailto_name; ?></td>
</tr>

<tr>
<td class="thMailViewer">Date:</td>
<td class="thMailViewer"><?php echo $mail_date; ?></td>
</tr>

<tr>
<td class="thMailViewer">Subject:</td>
<td class="thMailViewer tdMailViewerWidth"><?php echo $mailto_subject; ?></td>
</tr>

<tr>
<td>
<input class="clButtons clButtons1" type="button" onClick="location.href='contactedList?tab=2#TabbedPanels1'" value="Back" /></td>
<td><form method="GET" onSubmit="return confirm('Are you sure to Delete this mail?')">
<input name="delete_mail_id_cu" type="hidden" value="<?php echo $sentMail_id_ce; ?>" />
<input class="clButtons clButtons1" type="submit" name="delete_mail_button_cu" value="Delete" />
</form></td>
</tr>

<tr>
<td class="mailViewerBody" colspan="2"><?php echo $mailto_message; ?></td>
</tr>

</table>


<?php 
} 

if(isset($_GET['delete_mail_button_sm']))  {
	
$delete_mail_id=$_GET['delete_mail_id_cu'];
mysql_query("DELETE FROM cu_sentmail WHERE cu_sm_id='$delete_mail_id'");
echo '<meta http-equiv=Refresh content="0;url=sentMails">';

}

if(isset($_REQUEST['sentMail_sm_button'])) {
				        $sentMail_id_ce=$_REQUEST['sentMail_id_ce'];
                        $db_data=mysql_query("SELECT * FROM cu_sentmail WHERE cu_sm_id='$sentMail_id_ce'");
                        $disp_data=mysql_fetch_array($db_data);
                        $mail_date=$disp_data['cu_sm_date'];
                        $mailto_name=$disp_data['cu_sm_name'];
                        $mailto_email=$disp_data['cu_sm_email'];
						$mailto_subject=$disp_data['cu_sm_subject'];
						$mailto_message=$disp_data['cu_sm_message'];


?>
<table class="tableMailViewer">

<tr>
<td class="thMailViewer">Sent to:</td>
<td class="thMailViewer"><?php echo $mailto_email; ?></td>
</tr>

<tr>
<td class="thMailViewer">Name:</td>
<td class="thMailViewer"><?php echo $mailto_name; ?></td>
</tr>

<tr>
<td class="thMailViewer">Date:</td>
<td class="thMailViewer"><?php echo $mail_date; ?></td>
</tr>

<tr>
<td class="thMailViewer">Subject:</td>
<td class="thMailViewer tdMailViewerWidth"><?php echo $mailto_subject; ?></td>
</tr>

<tr>
<td><input class="clButtons clButtons1" type="button" onClick="location.href='sentMails'" value="Back" /></td>
<td><form method="GET" onSubmit="return confirm('Are you sure to Delete this mail?')">
<input name="delete_mail_id_cu" type="hidden" value="<?php echo $sentMail_id_ce; ?>" />
<input class="clButtons clButtons1" type="submit" name="delete_mail_button_sm" value="Delete" />
</form></td>
</tr>

<tr>
<td class="mailViewerBody" colspan="2"><?php echo $mailto_message; ?></td>
</tr>

</table>

<?php } ?>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
<?php database_disconnect($con); ?>