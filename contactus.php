<?php

/*if(isset($_POST['submit'])) {

$name=$_POST['name'];
$email=$_POST['email'];
$contact_no=$_POST['contact_no'];
$message=$_POST['message'];
$ip=$_SERVER['REMOTE_ADDR'];

if(empty($name) || empty($contact_no) || empty($email) || empty($message)) {
     $msg= "Please fill in all the fields";
   }
}

if(!empty($name) && !empty($contact_no) && !empty($email) && !empty($message)) {
	
            if(!preg_match("/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is", $email)) {
				$msg="The email you entered is not valid";
			}
			
			else if(!preg_match("/^[0-9]+$/", $contact_no)) {
				$msg="The number you entered is not valid";
			}
			
			else if(preg_match("/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is", $email) && preg_match("/^[0-9]+$/", $contact_no)) {
					$mail_to="dskcoaching@gmail.com";
					$subject='You have a new message from a site visitor '.$name;
					$body_message='From: '.$name."\n";
                    $body_message .= 'Contact Number: '.$contact_no."\n";
					$body_message .= 'E-mail: '.$email."\n";
	                $body_message .= 'Message: '.$message."\n";
	                $body_message .= 'IP: '.$ip."\n";
                    $headers .= "From: \"\"<".$email.">\n";
                    $headers .= "Reply-To: \"\"<".$email.">\n";
	                $mail_status = mail($mail_to, $subject, $body_message, $headers);
					
					if(!$mail_status) {
						$msg="email sending failed";
					}
					else if ($mail_status) {
						$msg="Message sent successfully";
						$name="";
                        $email="";
                        $contact_no="";
                        $message="";
					}
			}
}*/
require_once('admin/config.php');
include('admin/includes/cu-core-functions.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contact Us</title>
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
<h2 class="pageName">Contact Us</h2>
<h6 class="breadCrumb">You are Here : <a class="breadCrumbLink" href="home">Home</a> >> Contact Us</h6>
&nbsp;</div>
</div>

<div class="contentIndex" id="contentindexHeightCU">
<div class="contentIndexleft">
<h5>Kids International School,<br />Bellavi, Tumkur - 572153,<br />Karnataka<br />&nbsp;<br />Mob:- 9964008008</h5>
<div class="contactUsMain">
<h2>Please leave your name, contact details and message so we can get in touch with you at the earliest.</h2>
&nbsp;
<div class="error_msg"><?php if(isset($_POST['submit'])) { echo $msg_1; } ?></div>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

*<label class="formLabel">Your Name</label><br />
<input class="textbox" id="textboxmain" type="text" value="<?php if(isset($_POST['submit'])) { echo $name; } ?>" name="name" /><br />

*<label class="formLabel">Contact Number</label><br />
<input class="textbox" id="textboxmain" type="text" value="<?php if(isset($_POST['submit'])) { echo $contact_no; } ?>" name="contact_no" /><br />

*<label class="formLabel">Your Email</label><br />
<input class="textbox" id="textboxmain" type="text" value="<?php if(isset($_POST['submit'])) { echo $email; } ?>" name="email" /><br />

*<label class="formLabel">Message</label><br />
<textarea class="textarea" id="textAreamain" name="message"><?php if(isset($_POST['submit'])) { echo $message; } ?></textarea><br />

<input type="hidden" value="1" name="priority" />

<input id="contactUsSmalltBtn" name="submit" type="submit" value="Contact Us" />

</form>
</div>
<div class="maps">
<h2>Find us on Google Maps</h2>
<iframe width="600" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=kids+international+school+bellavi&amp;aq=&amp;sll=13.421994,77.014557&amp;sspn=0.006992,0.00736&amp;vpsrc=6&amp;ie=UTF8&amp;hq=kids+international+school+bellavi&amp;hnear=&amp;t=h&amp;ll=13.421555,77.014697&amp;spn=0.006241,0.012853&amp;z=16&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="http://maps.google.co.in/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=kids+international+school+bellavi&amp;aq=&amp;sll=13.421994,77.014557&amp;sspn=0.006992,0.00736&amp;vpsrc=6&amp;ie=UTF8&amp;hq=kids+international+school+bellavi&amp;hnear=&amp;t=h&amp;ll=13.421555,77.014697&amp;spn=0.006241,0.012853&amp;z=16&amp;iwloc=A" style="color:#0000FF;text-align:left">View Larger Map</a></small>
</div>
</div>
<div class="contentindexRight">
<div id="dottedLine" class="dottedLine1">&nbsp;</div>
<h2 id="slideDeckBelowLeftHeader" class="slideDeckBelowLeftHeaderColor">Working Hours</h2>
<div class="slideDeckBelowRightContent" id="slideDeckBelowRightContentImg1">
<h6 id="slideDeckBelowRightContentHeader">6 DAYS A WEEK</h6>
<h6 id="slideDeckBelowRightContentP">9:30 am - 3:45 pm</h6>
</div>
<div class="slideDeckBelowRightContent" id="slideDeckBelowRightContentImg2">
<h6 id="slideDeckBelowRightContentHeader">CONTACT PHONE</h6>
<h6 id="slideDeckBelowRightContentP">9964008008</h6>
</div>
</div>
</div>

<?php include('shared-resorces/footer.php'); ?>

</body>
</html>