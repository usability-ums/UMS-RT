<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Result -> Progress Result</legend>
<script>
    function doCheck(){
        if(document.form.pid.value==""){
        alert("Please select a project name!");
        return false;
        }
    }
</script>
<form name="form" action="progress.php" method="POST" onsubmit="return doCheck()">
<p></p>
<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");

$sql = "SELECT DISTINCT name FROM project WHERE method_type='UET'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

?>
	<option value="<?php printf("%s",$myrow["name"]); ?>"><?php printf("%s",$myrow["name"]); ?></option>
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

<?php
if($_POST[pid] !=""){
require("../library/connection.php");
$number=1;
?>
<p></p>
<table>
<tr><td style="font-size:15pt"><?php printf("<b><u>%s</u></b>",$_POST[pid]); ?></td></tr>
<?php
$sql13 = "SELECT DISTINCT user FROM user WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql14 = "SELECT DISTINCT no FROM task WHERE PName='$_POST[pid]'";
$result14 = mysql_query($sql14,$con);
if ($myrow14 = mysql_fetch_array($result14)){

$sql17 = "SELECT DISTINCT comment FROM debriefingc WHERE project='$_POST[pid]' AND user='$myrow13[user]'";
$result17 = mysql_query($sql17,$con);
if ($myrow17 = mysql_fetch_array($result17)){

?>
<tr>
<td>
<?php
printf("<b>User %d : %s </b>",$number,strtoupper($myrow13["user"]));
$number++;

$sql19 = "SELECT DISTINCT status FROM user WHERE project='$_POST[pid]' AND user='$myrow13[user]' AND complete='pass'";
$result19 = mysql_query($sql19,$con);
if ($myrow19 = mysql_fetch_array($result19)){

?>
</td>
<td style="color:green"> 100% - User have completed User Experience Test (UET).</td>
</tr>
<?php
}else{
?>
</td>
<td style="color:red"> 100% - User fail this UET.</td>
</tr>
<?php
}
}else{

$sql15 = "SELECT COUNT(DISTINCT no) AS u_points FROM task WHERE PName='$_POST[pid]'"; 
$result15 = mysql_query($sql15) or die(mysql_error()); 
$iu = mysql_fetch_array($result15);

$sql16 = "SELECT COUNT(DISTINCT task) AS p_points FROM thinkaloud WHERE PName='$_POST[pid]' AND user='$myrow13[user]'"; 
$result16 = mysql_query($sql16) or die(mysql_error()); 
$pu = mysql_fetch_array($result16);

$sql18 = "SELECT DISTINCT status FROM user WHERE project='$_POST[pid]' AND user='$myrow13[user]' AND complete='fail'";
$result18 = mysql_query($sql18,$con);
if ($myrow18 = mysql_fetch_array($result18)){

?>
<tr>
<td>
<?php
printf("<b>User %d : %s </b>",$number,strtoupper($myrow13["user"]));
$number++;
?>
</td>
<td style="color:red"><b><?php printf("%s%%",number_format((($pu['p_points']/$iu['u_points'])*100)-5)); ?> - User fail to complete UET.</b></td>
</tr>
<?php

}else{
?>
<tr>
<td>
<?php
printf("<b>User %d : %s </b>",$number,strtoupper($myrow13["user"]));
$number++;
?>
</td>
<td><b><?php printf("%s%%",number_format((($pu['p_points']/$iu['u_points'])*100)-5)); ?> - User have completed.</b></td>
</tr>
<?php


}
}

}else{

?>
<tr>
<td>
<?php
printf("<b>User %d : %s </b>",$number,strtoupper($myrow13["user"]));
$number++;
?>
</td>
<td style="color:red"> 0% - No task have been set by moderator.</td>
</tr>
<?php

}
	
} while ($myrow13 = mysql_fetch_array($result13));
	
} else {
?>
<tr>
<td>
User Experience Test (UET) for this project haven start.
</td>
</tr>
<?php

}
?>
</table>

<?php
mysql_close($con);
}
?>
</form>
</fieldset>
</body>
</html>
