<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Result -> Think Aloud Result</legend>
<script>
    function doCheck(){
        if(document.form.pid.value==""){
        alert("Please select a project name!");
        return false;
        }
    }
</script>
<form name="form" action="thinkaloudresult.php" method="POST" onsubmit="return doCheck()">
<p></p>
<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");

$sql = "SELECT DISTINCT PName FROM task ORDER BY PName ASC";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

?>
	<option value="<?php printf("%s",$myrow["PName"]); ?>"><?php printf("%s",$myrow["PName"]); ?></option>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {
	echo "<p>No information.</p>";  
}

mysql_close($con);
?>

</select>
</td>
<td>
<input type="submit" name="submit" value="SEARCH">
</td> 
</tr>
</table>

	<table border="1" bordercolor="black" width="100%">

	<tr>


<?php
if($_POST[pid] !=""){
?>
<p style="font-size:16pt"><b><u><?php printf("%s",$_POST[pid]); ?></b></u></p>
<?php
require("../library/connection.php");

$sql = "SELECT * FROM task WHERE PName='$_POST[pid]' ORDER BY CAST(no AS UNSIGNED) ASC";
$result = mysql_query($sql,$con);
$num =1;	?>
<td align="center"><b>No.</b></td>
<td><b>Task</b></td>
<td><b>Comments</b></td></tr>

<?php
if ($myrow = mysql_fetch_array($result)){
do {

$string = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["question"]);
$string = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string));

	?><tr><td align="center"><b><?php printf("%s",$myrow["no"]); ?></b></td>
	<td><b><?php printf("%s",$string); ?></b></td>
	<td>
	<?php
$sql1 = "SELECT answer FROM thinkaloud WHERE PName='$_POST[pid]' AND task='$num'";
$result1 = mysql_query($sql1,$con);

if ($myrow1 = mysql_fetch_array($result1)){
do {
 	?>
	&nbsp;"
	<?php

$string1 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow1["answer"]);
$string1 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string1));

	 printf("%s",$string1);
 	?>
	"<br/>
	<?php	
	
} while ($myrow1 = mysql_fetch_array($result1));
	
}
?>
	</td>
	<?php 
$num++;

} while ($myrow = mysql_fetch_array($result));
	
} else {
	 
}

mysql_close($con);
}else{}
?>
</tr>
</table>
</form>
</fieldset>
</body>
</html>
