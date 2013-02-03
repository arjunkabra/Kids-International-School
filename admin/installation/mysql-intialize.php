<?php

$admins = mysql_query("CREATE TABLE admins
          (
		   admin_id int(13) NOT NULL AUTO_INCREMENT,
		   admin_username VARCHAR(65),
		   admin_password VARCHAR(65),
		   admin_date DATE,
		   admin_name VARCHAR(30),
		   admin_email VARCHAR(30),
		   admin_auth_keys VARCHAR(40),
		   admin_priority VARCHAR(10),
		   admin_type VARCHAR(13),
		   PRIMARY KEY(admin_id)
		   )
		   AUTO_INCREMENT = 1095");

$contactUs = mysql_query("CREATE TABLE contact_us
	          (
		       contact_id int(13) NOT NULL AUTO_INCREMENT,
		       contact_date DATE,
			   contact_name varchar(30),
		   	   contact_email varchar(30),
			   contact_no varchar(13),
			   contact_message longtext,
			   contact_status varchar(100) NOT NULL,
			   contact_priority varchar(10),
			   contact_ip varchar(100),
			   PRIMARY KEY(contact_id)
			  )
			  AUTO_INCREMENT = 6065");
			  
$sentmailContactUs = mysql_query("CREATE TABLE cu_sentmail
             (
              cu_sm_id int(13) NOT NULL AUTO_INCREMENT,
              cu_sm_date DATE,
              cu_sm_name varchar(30),
              cu_sm_email varchar(30),
              cu_sm_subject varchar(100),
              cu_sm_message longtext,
              PRIMARY KEY(cu_sm_id)
             )
			 AUTO_INCREMENT = 95965");

$subjects = mysql_query("CREATE TABLE subjects
	          (
		      subject_id int(13) NOT NULL AUTO_INCREMENT,
			  subject_serial_number varchar(3),
			  subject_name varchar(30),
		   	  max_marks varchar(3),
			  PRIMARY KEY(subject_id)
			  )
			  AUTO_INCREMENT = 65");
			  
$students = mysql_query("CREATE TABLE students
             (
             student_id int(13) NOT NULL AUTO_INCREMENT,
			 register_number varchar(20),
             student_name varchar(30),
             class varchar(10),
             PRIMARY KEY(student_id)
             )
			 AUTO_INCREMENT = 42569260");
			 
$marks = mysql_query("CREATE TABLE marks
          (
		  marks_id int(13) NOT NULL AUTO_INCREMENT,
		  subject_id varchar(13),
		  student_id varchar(13),
		  marks_obtained varchar(3),
		  PRIMARY KEY(marks_id)
		  )
		  AUTO_INCREMENT = 232525327");
		  
$description = mysql_query("CREATE TABLE result_description
               (
			   description_id int(13),
			   description longtext
			   )");
			   
$write = mysql_query("INSERT INTO result_description(description_id, description)VALUES('1','This is the description which appears on the main results page. Delete this and add your custom message')");
			 


?>