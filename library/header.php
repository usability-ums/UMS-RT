<?php
require("../library/duration.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
  	<table align="left">
	  <tr><td><img src="../images/ums.png"/></td></tr>
	</table>
  	<table style="margin-top: 30px;margin-right: 20px;" align="right">
	<tr>
		<td>
		    Hi, <a href="../user/profile.php" target="home"><?php printf("%s",$_COOKIE[un]); ?></a> |	
		    <a href="../logout.php">Logout</a>
		</td>
	</tr>
	</table>
</body>
</html>