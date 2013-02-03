<?php

// ** MySQL settings - You can get this info from your web hosting service provider ** //

/** The name of the database  */ 
$DB_NAME = 'thetecha_kislive';

/** MySQL database username */
$DB_USER = 'thetecha_kislive';

/** MySQL database password */
$DB_PASSWORD = 'password123@';

/** MySQL hostname */
$DB_HOST = 'localhost'; 

/** Reply emails for sent emails */
$reply_email='info@thexsp.com';

/** Organization Name */
$org_name='Kids International School';   

function database_connect($DB_HOST, $DB_NAME, $DB_USER, $DB_PASSWORD) {
	
	global $con;
	$con= @mysql_connect($DB_HOST, $DB_USER, $DB_PASSWORD);
	if(!$con) {
		die("Error: ".mysql_error());
	}
	
	$connect=mysql_select_db($DB_NAME, $con);
	if($connect) {
		return $con;
	}
	
}

function database_disconnect($con) {
	
	$discon= @mysql_close($con);
	if(!$discon) {
		die(mysql_error()); 
	}
	
}

function authenticate() {
	
	session_start();
	
	if (!isset($_SESSION['admin_id'])) {
		
	        if (isset($_COOKIE['admin_id'])) {
                      $_SESSION['admin_id'] = $_COOKIE['admin_id'];
                      $_SESSION['admin_name'] = $_COOKIE['admin_name'];
	                  $_SESSION['admin_auth_keys'] = $_COOKIE['admin_auth_keys'];
            }
			$login_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login';
            header('Location: '.$login_url);
			
    }
}

function admin_pass() {
	
    $check_admin = mysql_num_rows(mysql_query("
	               SELECT admin_id, admin_auth_keys FROM admins WHERE admin_id='{$_SESSION['admin_id']}' AND                                                   admin_auth_keys='{$_SESSION['admin_auth_keys']}'"));
	if($check_admin==0) { 
	$logout_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/logout';
    header('Location: '.$logout_url);
    }
}

?>