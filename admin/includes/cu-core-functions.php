<?php

if(isset($_POST['submit'])) {

$date=date("y/m/d");
$name=$_POST['name'];
$email=$_POST['email'];
$contact_no=$_POST['contact_no'];
$message=$_POST['message'];
$priority=$_POST['priority'];
$ip=$_SERVER['REMOTE_ADDR'];
$msg_1 = "";
$msg_2 = "";
$msg_3 = "";

if(empty($name) || empty($email) || empty($contact_no) || empty($message)) {
     $msg_1 = "All are mandatory, please fill in all the fields<br />";
   }
}

if(!empty($name) && !empty($email) && !empty($contact_no) && !empty($message)) {
			
			if(!preg_match("/^[0-9]+$/", $contact_no)) {
				$msg_2 = "The contact number you entered is not valid<br />";
			}
			
			if(!preg_match("/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is", $email)) {
				$msg_3 = "The email you entered is not valid<br />";
			}
			
			if(preg_match("/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is", $email) 
			   && preg_match("/^[0-9]+$/", $contact_no)) {
			database_connect($DB_HOST, $DB_NAME, $DB_USER, $DB_PASSWORD);
			$query = mysql_query(
			"INSERT INTO contact_us
			(contact_date, contact_name, contact_email, contact_no, contact_message, contact_priority, contact_ip)
		     VALUES('$date', '$name', '$email', '$contact_no', '$message', '$priority', '$ip')"
								);
				if(!$query) {
				$msg_1 = "Error: ".mysql_error();
				}
				else {
					$msg_1 =  "We have received your message, Thank you";
					$email_alert=mysql_query("SELECT * FROM admins WHERE admin_priority=1");
			        while($row=mysql_fetch_array($email_alert)) {
					$mail_to=$row['admin_email'];
					$subject='You have a new message from the site visitor '.$name;
					$body_message='From: '.$name."\n";
					$body_message .= 'E-mail: '.$email."\n";
                    $body_message .= 'Contact Number: '.$contact_no."\n";
	                $body_message .= 'Message: '.$message."\n";
	                $body_message .= 'IP: '.$ip."\n";
	                $body_message .= 'Login to your admin panal to take further actions: ';
	                $body_message .= 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'admin';
                    $headers = 'From: '.$email."\r\n";
                    $headers .= 'Reply-To: '.$email."\r\n";
	                $mail_status = mail($mail_to, $subject, $body_message, $headers);
					}
					$name="";
                    $email="";
                    $contact_no="";
                    $message="";
				}
			database_disconnect($con);
			}
}

?>