<?php
	session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<link href="../background/background2.css" rel="stylesheet" type="text/css">
<link href="font.css" rel="stylesheet" type="text/css">
</head>
<body>
<form id="loginForm" name="loginForm" method="post" action="register-exec.php">
<table width="500" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="282828">
	<tr>
	  <td id="Name" height="108" align="center" colspan="2">Register Form</td>
	</tr>
	<tr>
	<td id="Errors" height="38" align="center" colspan="2">
<?php
	if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) > 0 ) {
		echo "<div class='err'>";
		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo $msg,"<br>"; 
		}
		echo "</div>";
		unset($_SESSION['ERRMSG_ARR']);
	}
?>
	</td>
	</tr>
    <tr>
      <td height="38" width="160" align="center">Account:</td>
      <td height="38" width="180" align="center"><input name="login" type="text" class="textfield" id="login" maxlength="14"></td>
	</tr>
	<tr>
      <td height="38" width="160" align="center">Password:</td>
      <td height="38" width="180" align="center"><input name="password" type="password" class="textfield" id="password" maxlength="30"></td>
    </tr>
    <tr>
      <td height="38" width="160" align="center">Confirm Password:</td>
      <td height="38" width="180" align="center"><input name="cpassword" type="password" class="textfield" id="cpassword" maxlength="30"></td>
    </tr>
	<tr>
      <td height="38" width="160" align="center">E-mail:</td>
      <td height="38" width="180" align="center"><input name="email" type="text" class="textfield" id="email"></td>
    </tr>
	<tr>
	  <td height="83" align="center" colspan="2"><input id="RB" type="submit" name="Submit" value="Register"></td>
	</tr>
</table>
</form>
</body>
</html>