<?php 

require_once('config.php');
authenticate();
database_connect($DB_HOST, $DB_NAME, $DB_USER, $DB_PASSWORD);
admin_pass();

$mailto_id=$_REQUEST['mailto_id'];
$db_data=mysql_query("SELECT contact_name, contact_email FROM contact_us WHERE contact_id='$mailto_id'");
$disp_data=mysql_fetch_array($db_data);
$email_date=date("y/m/d");
$mailto_name=$disp_data['contact_name'];
$mailto_email=$disp_data['contact_email'];

if (isset($_POST['send'])) { 
	$subject=$_POST['subject'];
	$body=$_POST['body'];
	
    if (empty($subject) && empty($body) ) { 
	       $error_msg = "Please Enter Subject and Message<br />";
        }
    else if (!empty($subject) && empty($body) ) { 
	       $error_msg = "Please Enter Message<br/>"; 
        }
    else if (empty($subject) && !empty($body) ) { 
	       $error_msg = "Please Enter Subject.<br/>"; 
        }
    else if (!empty($subject) && !empty($body) ) {    
              $headers = "MIME-Version: 1.0" . "\r\n";
              $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
              $headers .= "From: \"\"<".$reply_email.">\n";
              $headers .= "Reply-To: \"\"<".$reply_email.">\n";
	          $mail_status = mail($mailto_email, $subject, $body, $headers);
			  if($mail_status) {
	                $query=mysql_query("INSERT INTO cu_sentmail(cu_sm_date, cu_sm_name, cu_sm_email, cu_sm_subject, cu_sm_message) 
								 VALUE('$email_date', '$mailto_name', '$mailto_email', '$subject', '$body')");
                    $error_msg = "Email sent successfully<br/>";
					echo '<meta http-equiv=Refresh content="3;url=contactedList">';
					$mailto_id="";
					$mailto_name="";
                    $mailto_email="";
					$subject="";
	                $body="";
			  }
			  else { 
			     $error_msg = "E-mail sending failed<br/>";
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
<script src="scripts/tiny_mce.js" type="text/javascript"></script>
<script type="text/javascript">
tinyMCE.init({
        theme : "advanced",
        mode : "textareas",
        plugins : "fullpage",
        theme_advanced_buttons3_add : "fullpage",
		theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : false,
		skin : "o2k7",
		plugins :"autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
		theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,advhr,|,ltr,rtl,|,spellchecker,fullscreen",
});
</script>
<title>E - Mailer</title>
</head>

<body class="bgMain">

<?php include('includes/header.php'); ?>

<div class="mainIndex">

<?php include('includes/navigation.php'); ?>

<div class="pageName">
<img src="images/smallMailer.png" />E - Mailer
</div>

<?php
echo "<div class=\"discardMail\">
      <input type=\"button\" class=\"clButtons clButtons2\" 
	  onClick=\"location.href='contactedList?tab=0#TabbedPanels1'\" value=\"Discard Email\" />
	  </div>";
?>
<div class="mailerError"><?php if(isset($_POST['send'])) { echo $error_msg; } ?></div>


<form class="mailerForm" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<input type="hidden" name="mailto_id" value="<?php echo $mailto_id; ?>" />
<table>
<tr>
<td class="tdMailer"><label class="mailerLabel">Name:</label></td>
<td><input class="mailerTextbox" readonly="true" type="text" 
       value="<?php echo $mailto_name; ?>" name="mailto_name"/></td>
</tr>

<tr>
<td class="tdMailer"><label class="mailerLabel">Mail To:</label></td>
<td><input class="mailerTextbox" readonly="true" type="text" 
       value="<?php echo $mailto_email; ?>" name="mailto_email"/></td>
</tr>

<tr>
<td class="tdMailer"><label class="mailerLabel">Subject:</label></td>   
<td><input class="mailerSubject" type="text" 
       value="<?php if (isset($_POST['send'])) { echo $subject; }  ?>" name="subject"/></td>
</tr>
 
<tr>
<td class="tdMailer"><label class="mailerLabel">Message:</label></td>  
<td><textarea name="body" cols="80" rows="30"><?php if (isset($_POST['send'])) { echo $body; }  ?></textarea></td>
</tr>

</table>

<hr />

<input class="clButtons clButtons2 clButtons3"name="send" type="submit" value="Send" />

</form>

</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
<?php database_disconnect($con); ?>