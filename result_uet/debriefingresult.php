<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Result -> Debriefing Result</legend>
<script>
    function doCheck(){
        if(document.form.pid.value==""){
        alert("Please select a project name!");
        return false;
        }
    }
</script>
<form name="form" action="debriefingresult.php" method="POST" onsubmit="return doCheck()">
<p></p>
<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");

$sql = "SELECT DISTINCT project FROM debriefingscore ORDER BY project ASC";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

?>
	<option value="<?php printf("%s",$myrow["project"]); ?>"><?php printf("%s",$myrow["project"]); ?></option>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {
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
</form>
<p style="font-size:16pt"><b><u><?php printf("%s",$_POST[pid]); ?></b></u></p>
<?php
require("../library/connection.php");

$sql2 = "SELECT DISTINCT no FROM assigndef WHERE project='$_POST[pid]'";
$result2 = mysql_query($sql2,$con);

if ($myrow2 = mysql_fetch_array($result2)){
do {

$sql21 = "SELECT * FROM debriefing WHERE no='$myrow2[no]'";
$result21 = mysql_query($sql21,$con);
$myrow21 = mysql_fetch_array($result21);
?>
<table border="1" bordercolor="black" width="90%">
<tr>
<td><b><?php printf("%s",$myrow21["question"]); ?></b></td>
<td width="70" align="center"><b>Frequency</b></td>
<td width="60" align="center"><b>Percent</b></td>
</tr>

<?php
$sql3 = "SELECT DISTINCT answer FROM data";
$result3 = mysql_query($sql3,$con);
if ($myrow3 = mysql_fetch_array($result3)){
do {

if($myrow3[answer]!=NULL){
$sql8 = "SELECT COUNT(score) AS t_points FROM debriefingscore WHERE project='$_POST[pid]' AND question='$myrow2[no]' AND score='$myrow3[answer]'"; 
$result8 = mysql_query($sql8) or die(mysql_error()); 
$it = mysql_fetch_array($result8);

$sql9 = "SELECT COUNT(DISTINCT user) AS ut_points FROM debriefingscore WHERE project='$_POST[pid]' AND question='$myrow2[no]'"; 
$result9 = mysql_query($sql9) or die(mysql_error()); 
$itu = mysql_fetch_array($result9);

?>
<tr>
<td><?php printf("%s",$myrow3[answer]); ?></td>
<td align="center"><?php printf("%s",$it[t_points]); ?></td>
<?php
if($itu[ut_points]!='0'){
?>
<td align="center"><?php printf("%s%%",number_format(($it[t_points]/$itu[ut_points])*100, 0, '.', '')); ?></td>
<?php
}else{
?>
<td>0%</td>
<?php
}
?>
</tr>
<?php
}
} while ($myrow3 = mysql_fetch_array($result3));
	
} else {}

?>
</table>
<p></p>

<?php

} while ($myrow2 = mysql_fetch_array($result2));
	
} else {}
if($_POST[pid] !=""){
?>
<table border="1" bordercolor="black" width="90%">
<tr>
<td><b>How many star you would give for <?php printf("%s",$_POST[pid]); ?> project?</b></td>
<td width="70" align="center"><b>Frequency</b></td>
<td width="60" align="center"><b>Percent</b></td>
</tr>
<tr>
<?php
for($p=1;$p<6;$p++){
?>
<td>
<?php
for($pt=0;$pt<$p;$pt++){
?>
<img src="../images/star.jpg"/>
<?php
}
?>
</td>

<?php
$sql8 = "SELECT COUNT(user) AS s_point FROM debriefingc WHERE project='$_POST[pid]' AND question='3' AND comment='$p'"; 
$result8 = mysql_query($sql8) or die(mysql_error()); 
$st = mysql_fetch_array($result8);

$sql9 = "SELECT COUNT(DISTINCT user) AS ut_points FROM debriefingc WHERE project='$_POST[pid]' AND question='3'"; 
$result9 = mysql_query($sql9) or die(mysql_error()); 
$itu = mysql_fetch_array($result9);
?>
<td align="center"><?php printf("%s",$st[s_point]); ?></td>

<?php
if($itu[ut_points]!='0'){
?>
<td align="center"><?php printf("%s%%",number_format(($st[s_point]/$itu[ut_points])*100, 0, '.', '')); ?></td></tr>
<?php
}else{
?>
<td align="center">0%</td></tr>
<?php
}
}
?>
</table>
<p></p>

<?php

mysql_close($con);

?>
<table border="1" bordercolor="black" width="90%">
<tr>
<td align="center"><b>No.</b></td>
<td><b>Question</b></td>
<td><b>Comments</b></td>
</tr>
<tr>
<td align="center"><b>1</b></td>
<td>How do you think the <?php printf("%s",$_POST[pid]); ?> could be improved?</td>
<td>
<?php

require("../library/connection.php");

$sql = "SELECT comment FROM debriefingc WHERE project='$_POST[pid]' AND question='1'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {
 	?>
	&nbsp;"
	<?php

$string1 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["comment"]);
$string1 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string1));

	printf("%s",$string1);
 	?>
	"<br/>
	<?php	

} while ($myrow = mysql_fetch_array($result));

} else {}

mysql_close($con);
?>
</td>
</tr>
<tr>
<td align="center"><b>2</b></td>
<td>How do you think the usability team could be improve on their future UET?</td>
<td>
<?php

require("../library/connection.php");

$sql = "SELECT comment FROM debriefingc WHERE project='$_POST[pid]' AND question='2'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {
 	?>
	&nbsp;"
	<?php

$string1 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["comment"]);
$string1 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string1));

	printf("%s",$string1);
 	?>
	"<br/>
	<?php	

} while ($myrow = mysql_fetch_array($result));

} else {}

mysql_close($con);
}
?>
</td>
</tr>
<table>
</form>
</fieldset>
</body>
</html>
