<?php
if($_COOKIE["pj"]==NULL){
?>
<script type="text/javascript">document.location.href='login.php'</script>
<?php
}
?>
<html>
<link href="../../style/multistyle.css" rel="stylesheet" type="text/css"/>
<?php
require("header.php");
?>
<body>
<div id="main">
<div id="logo">
<div id="head">
</div>
<div id="content">
<p align="center" style="font-size:25pt"><b><br/><br/>Introduction</b><br/></p>
<p>
<table align="center">
<?php
require("../../library/connection.php");
$sql = "SELECT * FROM project WHERE name='$_COOKIE[pj]'";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){
do {
$string = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["content"]);
$string = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string));
?>
	<tr>
	<td><?php printf("%s",$string); ?></td>
	</tr>
<?php
} while ($myrow = mysql_fetch_array($result));
} else { 
}
mysql_close($con);
?>
<tr>
<td align="center"><br/><input type="button" name="submit" value="NEXT" ONCLICK="window.location.href='demographic.php'"></td> 
</tr>
</table>
</p>
</div>
<?php
require("footer.php");
?>
</body>
</html>
