<div id="dottedLine" class="dottedLine1">&nbsp;</div>
<div id="dottedLine" class="dottedLine2">&nbsp;</div>
<h2 id="slideDeckBelowLeftHeader" class="slideDeckBelowLeftHeaderColor">Working Hours</h2>
<div class="slideDeckBelowRightContent" id="slideDeckBelowRightContentImg1">
<h6 id="slideDeckBelowRightContentHeader">6 DAYS A WEEK</h6>
<h6 id="slideDeckBelowRightContentP">9:30 am - 3:45 pm</h6>
</div>
<div class="slideDeckBelowRightContent" id="slideDeckBelowRightContentImg2">
<h6 id="slideDeckBelowRightContentHeader">CONTACT PHONE</h6>
<h6 id="slideDeckBelowRightContentP">9964008008</h6>
</div>
<div class="slideDeckBelowRightContent2" id="slideDeckBelowRightContentImg3">
<h6 id="slideDeckBelowRightContentHeader">Address</h6>
<h6 id="slideDeckBelowRightContentP">kids International School,<br />Bellavi, Tumkur - 572153,<br />Karnataka</h6>
</div>
<?php

require_once('admin/config.php');
include('admin/includes/cu-core-functions.php');

?>

<div class="widget_contactUs">
<h2 id="slideDeckBelowLeftHeader" class="slideDeckBelowLeftHeaderColor">Contact Us</h2>

<div class="error_msg"><?php if(isset($_POST['submit'])) { echo $msg_1; } ?></div>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

*<label class="formLabel">Your Name</label><br />
<input class="textbox" id="textAreaSidebar" type="text" 
value="<?php if(isset($_POST['submit'])) { echo $name; } ?>" name="name" /><br />

<div class="error_msg"><?php if(isset($_POST['submit'])) { echo $msg_2; } ?></div>
*<label class="formLabel">Contact Number</label><br />
<input class="textbox" id="textAreaSidebar" type="text" 
value="<?php if(isset($_POST['submit'])) { echo $contact_no; } ?>" name="contact_no" /><br />

<div class="error_msg"><?php if(isset($_POST['submit'])) { echo $msg_3; } ?></div>
*<label class="formLabel">Your Email</label><br />
<input class="textbox textareaMargin" id="textAreaSidebar" type="text" 
value="<?php if(isset($_POST['submit'])) { echo $email; } ?>" name="email" /><br />

*<label class="formLabel">Message</label><br />
<textarea class="textarea" id="textAreaSidebar" name="message">
<?php if(isset($_POST['submit'])) { echo $message; } ?>
</textarea><br />

<input type="hidden" value="1" name="priority" />

<input id="contactUsSmalltBtn" name="submit" type="submit" value="Contact Us" />

</form>

</div>