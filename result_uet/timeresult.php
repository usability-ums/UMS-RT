<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Result -> Timing Result</legend>
<script>
    function docheck(){
        if(document.form.pid.value==""){
        alert("Please select a project name!");
        return false;
        }
    }
</script>
<form name="form" action="timeresult.php" method="POST" onsubmit="return docheck()">
<p></p>
<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");

$sql = "SELECT DISTINCT project FROM time ORDER BY project ASC";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

?>
	<option value="<?php printf("%s",$myrow["project"]); ?>"><?php printf("%s",$myrow["project"]); ?></option>
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

<?php

require("../library/connection.php");
if($_POST[pid]!=""){

$number=1;
?>
<table>
<tr><td style="font-size:15pt"><?php printf("<b><u>%s</u></b>",$_POST[pid]); ?></td></tr>
<?php
$sql13 = "SELECT DISTINCT user FROM time WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {
?>
<tr>
<td>
<?php
printf("<b>User %d : %s </b>",$number,strtoupper($myrow13["user"]));
$number++;
?>
</td>
</tr>
<?php	
} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}
?>
<tr><td><br/></td></tr>
</table>
<?php
$sql2 = "SELECT DISTINCT task FROM time WHERE project='$_POST[pid]' ORDER BY CAST(task AS UNSIGNED) ASC";
$result2 = mysql_query($sql2,$con);
?>
<table border="1" bordercolor="black" width="70%">
<tr style="font-weight:bold">
<td align="center">User\Task</td>
<?php
if ($myrow2 = mysql_fetch_array($result2)){
do {
?>
<td align="center"><?php printf("#%s",$myrow2["task"]); ?></td>
<?php
} while ($myrow2 = mysql_fetch_array($result2));
	
} else {}
?>
<td align="center">TOTAL</td>
</tr>
<?php
$sql3 = "SELECT DISTINCT user FROM time WHERE project='$_POST[pid]'";
$result3 = mysql_query($sql3,$con);
$total=0;
$counter=0;
if ($myrow3 = mysql_fetch_array($result3)){
do {
$counter++;
$resth=0;
$restm=0;
$rests=0;
?>
<tr>
<td align="center"><b>User <?php printf("%s",$counter); ?></b></td>
<?php

$sql4 = "SELECT DISTINCT task FROM time WHERE project='$_POST[pid]' ORDER BY CAST(task AS UNSIGNED) ASC";
$result4 = mysql_query($sql4,$con);

if ($myrow4 = mysql_fetch_array($result4)){
do {

$sql5 = "SELECT time FROM time WHERE project='$_POST[pid]' AND user='$myrow3[user]' AND task='$myrow4[task]' ORDER BY CAST(task AS UNSIGNED) ASC";
$result5 = mysql_query($sql5,$con);
if ($myrow5 = mysql_fetch_array($result5)){
do {

$sql16 = "SELECT type FROM project WHERE name='$_POST[pid]'";
$result16 = mysql_query($sql16,$con);
if ($myrow16 = mysql_fetch_array($result16)){
$pjtype=$myrow16["type"];

}

?>
	<td align="center"><?php printf("%s",$myrow5["time"]); ?></td>
<?php

$hh = ((int)substr("$myrow5[time]", -7,1));
$resth=$resth+$hh;
$total=$total+($hh*3600);
$mm = ((int)substr("$myrow5[time]", -5,2));
$restm=$restm+$mm;
$total=$total+($mm*60);
if($restm>60){
	$restm=$restm-60;
	$resth=$resth+1;
}
$ss = ((int)substr("$myrow5[time]", -2,2));
$rests=$rests+$ss;
$total=$total+$ss;
if($rests>60){
	$rests=$rests-60;
	$restm=$restm+1;
}
} while ($myrow5 = mysql_fetch_array($result5));
	
} else {}

} while ($myrow4 = mysql_fetch_array($result4));
	
} else {}
if($rests==0){$rests="00";}
if($restm==0){$restm="00";}
if($rests==1){$rests="01";}
if($restm==1){$restm="01";}
if($rests==2){$rests="02";}
if($restm==2){$restm="02";}
if($rests==3){$rests="03";}
if($restm==3){$restm="03";}
if($rests==4){$rests="04";}
if($restm==4){$restm="04";}
if($rests==5){$rests="05";}
if($restm==5){$restm="05";}
if($rests==6){$rests="06";}
if($restm==6){$restm="06";}
if($rests==7){$rests="07";}
if($restm==7){$restm="07";}
if($rests==8){$rests="08";}
if($restm==8){$restm="08";}
if($rests==9){$rests="09";}
if($restm==9){$restm="09";}
?>
<td align="center"><?php printf("%s:%s:%s",$resth,$restm,$rests); ?></td>
</tr>
<?php	
} while ($myrow3 = mysql_fetch_array($result3));
	
} else {}
?>
</table>
<?php

$display=0;
$total=$total/$counter;
while($total>60){
	$total=$total-60;
	$display++;
}
$word="seconds";
if($total==0){
	$word="second";
}
$word1="minutes";
if($display==0){
	$word1="minute";
}
$total=number_format($total);
$display=number_format($display);
if($total<10&&$display<10){
	echo "<p style=\"font-size:15pt\">Average time by users: <b>0$display:0$total</b> ($word1:$word)<br/></p>";
}else if($total<10){
	echo "<p style=\"font-size:15pt\">Average time by users: <b>$display:0$total</b> ($word1:$word)<br/></p>";
}else if($display<10){
	echo "<p style=\"font-size:15pt\">Average time by users: <b>0$display:$total</b> ($word1:$word)<br/></p>";
}else{
	echo "<p style=\"font-size:15pt\">Average time by users: <b>$display:$total</b> ($word1:$word)<br/></p>";
}
}
mysql_close($con);
?>
</form>
</fieldset>
</body>
</html>