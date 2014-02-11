<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$login = clean($_POST['login']);
	$password = clean($_POST['password']);
	$cpassword = clean($_POST['cpassword']);
	$tpoint = clean($_POST['tpoint']);
	$email = clean($_POST['email']);
	
	//Input Validations
	if($login == '') {
		$errmsg_arr[] = 'Username missing!';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing!';
		$errflag = true;
	}
	if($cpassword == '') {
		$errmsg_arr[] = 'Confirm password missing!';
		$errflag = true;
	}
	if($email == '') {
		$errmsg_arr[] = 'Email missing!';
		$errflag = true;
	}
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match!';
		$errflag = true;
	}
	if( strlen($login) < 3 ) {
		$errmsg_arr[] = 'Username must be between 3 and 14 chracters!';
		$errflag = true;
	}
	if( strlen($login) > 14 ) {
		$errmsg_arr[] = 'Username must be between 3 and 14 chracters!';
		$errflag = true;
	}
	if( strlen($cpassword) < 6 ) {
		$errmsg_arr[] = 'Password must be between 6 and 30 chracters!';
		$errflag = true;
	}
	if( strlen($cpassword) > 30 ) {
		$errmsg_arr[] = 'Password must be between 6 and 30 chracters!';
		$errflag = true;
	}
	
	
	//Check for duplicate login ID
	if($login != '') {
		$qry = "SELECT * FROM t_account WHERE name='$login'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'Login ID already in use';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			die("Query Failed");
		}
	}
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("Location: register.php");
		exit();
	}

	//Create INSERT query
	$qry = "INSERT INTO t_account (name, pwd, pw2, city, gd) VALUES('$login','".md5($_POST['password'])."','$password','$email', '500')";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		header("Location: register-success.html");
		exit();
	}else {
		die("Query Failed");
	}
?>