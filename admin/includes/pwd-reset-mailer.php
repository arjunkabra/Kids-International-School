<?php
                $subject = "Kids International school password reset";
				$body_message = "Your password has been reset\n";
				$body_message .= "Full Name: ".$full_name."\n";
				$body_message .= "Login Name: ".$username."\n";
                $body_message .= "New Password: ".$random_password."\n";
				$body_message .= 'Login to administrative panel: ';
	            $body_message .= 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
                $headers = "From: \"\"<".$reply_email.">\n";
                $headers .= "Reply-To: \"\"<".$reply_email.">\n";
	            $mail_status = mail($mail_to, $subject, $body_message, $headers);
?>