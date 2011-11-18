<?php
if($_COOKIE["pj"]==NULL){
?>
<script type="text/javascript">document.location.href='login.php'</script>
<?php
}
?>
<html>
<link href="../../style/design.css" rel="stylesheet" type="text/css"/>
<body style="background-color: #ffaa50">
<?php
require("../../library/connection.php");
$number=$_COOKIE[tn];
$sql = "SELECT * FROM task WHERE PName='$_COOKIE[pj]' AND no='$number'";
$result = mysql_query($sql,$con);

if ($myrow1 = mysql_fetch_array($result)){
do {

$string = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow1["question"]);
$string = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string));

?>
<table align="center">
<tr>
</td>
<td VALIGN="top">
<?php
echo "<p>Task $number:</p>";
?>
</td>
<td VALIGN="top">
<?php
echo "<p>$string</p>";
?>
</td>
</tr>
</table
<?php
} while ($myrow1 = mysql_fetch_array($result));
	
} else {
	 
}

mysql_close($con);
?>

</body>
</html>