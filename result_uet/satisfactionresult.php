<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Result -> Satisfaction Result</legend>
<script>
    function doCheck(){
        if(document.form.pid.value==""){
        alert("Please select a project name!");
        return false;
        }
    }
</script>
<form name="form" action="satisfactionresult.php" method="POST" onsubmit="return doCheck()">
<p></p>
<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");

$sql = "SELECT DISTINCT project FROM score ORDER BY project ASC";
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
$number=1;
$usermark1=0;
$usermark2=0;
?>
<table>
<tr><td style="font-size:15pt"><?php printf("<b><u>%s</u></b>",$_POST[pid]); ?></td></tr>
<?php
$sql13 = "SELECT DISTINCT user FROM score WHERE project='$_POST[pid]'";
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
</table>
<?php

$sql8 = "SELECT COUNT(DISTINCT task) AS t_points FROM score WHERE project='$_POST[pid]'"; 
$result8 = mysql_query($sql8) or die(mysql_error()); 
$it = mysql_fetch_array($result8);
$finalmark=0;
for($looping=1;$looping<=$it[t_points];$looping++){


$sql = "SELECT DISTINCT user FROM score WHERE project='$_POST[pid]' AND task='$looping'";
$result = mysql_query($sql,$con);
$count1=1;
$num=0;
$count=1;
?>
<p><b><u>TASK <?php printf("%s",$looping); ?></b></u></p>
<table border="1" bordercolor="black" width="80%">
<tr>
<td align="center" width="25"><b>No</b></td>
<td><b>Post Test Questionnaire</b></td>
<?php
if ($myrow = mysql_fetch_array($result)){
do {
?><td align="center" width="50"><b>User <?php printf("%s",$count1);$count1++; ?></b></td>
<?php
} while ($myrow = mysql_fetch_array($result));
	
} else {}
?>
<td align="center"><b>Subtotal</b></td>
</tr>
<tr>
<?php

$sql2 = "SELECT DISTINCT question FROM score WHERE project='$_POST[pid]' AND task='$looping'";
$result2 = mysql_query($sql2,$con);

if ($myrow2 = mysql_fetch_array($result2)){
do {

$sql1 = "SELECT * FROM assignsatis WHERE project='$_POST[pid]' AND task='$looping' AND no='$myrow2[question]'";
$result1 = mysql_query($sql1,$con);

if ($myrow1 = mysql_fetch_array($result1)){
do {

$sql19 = "SELECT * FROM satisfaction WHERE no='$myrow2[question]'";
$result19 = mysql_query($sql19,$con);
$myrow19 = mysql_fetch_array($result19);
	?>
	  <td align="center"><?php printf("%s",$count); ?></td>
	  <td><?php printf("%s",$myrow19["question"]); ?></td>

<?php
$sql3 = "SELECT score FROM score WHERE project='$_POST[pid]' AND task='$looping' AND question='$myrow2[question]'";
$result3 = mysql_query($sql3,$con);
$total=0;
if ($myrow3 = mysql_fetch_array($result3)){
do {
	?>
	  <td align="center"><?php printf("%s",$myrow3["score"]);?></td>
	

<?php
$total=$total+(int)$myrow3["score"];
$num=$num+$total;
} while ($myrow3 = mysql_fetch_array($result3));
	
} else {}

?>
<td align="center"><b><?php printf("%s",$total); $count++;?></b></td>

</tr>
<?php

} while ($myrow1 = mysql_fetch_array($result1));
	
} else {}

} while ($myrow2 = mysql_fetch_array($result2));
	
} else {}
?>
<tr>
<td></td>
<td align="right"><b>TOTAL</b></td>
<?php
$usermark=0;
$sql6 = "SELECT DISTINCT user FROM score WHERE project='$_POST[pid]' AND task='$looping'";
$result6 = mysql_query($sql6,$con);
if ($myrow6 = mysql_fetch_array($result6)){
do {

$sql4 = "SELECT SUM(score) AS sum_points FROM score WHERE project='$_POST[pid]' AND task='$looping' AND user='$myrow6[user]'"; 
$result4 = mysql_query($sql4) or die(mysql_error()); 
$i = mysql_fetch_array($result4); 

?>
	  <td align="center"><b><?php printf("%s",$i['sum_points']);?></b></td>

<?php
$usermark=$usermark+$i['sum_points'];
} while ($myrow6 = mysql_fetch_array($result6));
	
} else {}

?>

<td align="center"><b><?php printf("%s",$usermark); $usermark1=$usermark1+$usermark;?></b></td>

</tr>


<tr>
<td></td>
<td align="right"><b><?php printf("%s",($count-1)*4); $usermark2=$usermark2+(($count-1)*4);?></b></td>
<?php
$totalpers=0;
$usermark=0;
$sql6 = "SELECT DISTINCT user FROM score WHERE project='$_POST[pid]' AND task='$looping'";
$result6 = mysql_query($sql6,$con);
if ($myrow6 = mysql_fetch_array($result6)){
do {

$sql4 = "SELECT SUM(score) AS sum_points FROM score WHERE project='$_POST[pid]' AND task='$looping' AND user='$myrow6[user]'"; 
$result4 = mysql_query($sql4) or die(mysql_error()); 
$i = mysql_fetch_array($result4); 

?>
	  <td align="center"><b><?php printf("%s%%",number_format(($i['sum_points']/(($count-1)*4))*100)); ?></b></td>
	
<?php
$totalpers=$totalpers+number_format(($i['sum_points']/(($count-1)*4))*100);
} while ($myrow6 = mysql_fetch_array($result6));	
} else {}
$sql10 = "SELECT COUNT(DISTINCT user) AS u_points FROM score WHERE project='$_POST[pid]' AND task='$looping'"; 
$result10 = mysql_query($sql10) or die(mysql_error()); 
$iu = mysql_fetch_array($result10);
if($iu[u_points]!='0'){
?>

<td align="center"><b><?php printf("%s%%",number_format($totalpers/$iu[u_points])); $finalmark=$finalmark+number_format($totalpers/$iu[u_points]); ?></b></td>
<?php
}else{
?>
<td align="center"><b>0%</b></td>
<?php
}
$number1=1;
?>
</tr>
</table>

<p></p>
<table width="530" class="graph" cellspacing="6" cellpadding="0">
<thead>
<tr><th colspan="3">Task <?php printf("%d ",$looping); ?>Satisfaction</th></tr>
</thead>
<tbody>
<?php

$sql16 = "SELECT DISTINCT user FROM score WHERE project='$_POST[pid]' AND task='$looping'";
$result16 = mysql_query($sql16,$con);
if ($myrow16 = mysql_fetch_array($result16)){
do {

$sql14 = "SELECT SUM(score) AS sum_points FROM score WHERE project='$_POST[pid]' AND task='$looping' AND user='$myrow16[user]'"; 
$result14 = mysql_query($sql14) or die(mysql_error()); 
$i = mysql_fetch_array($result14); 

?>
	  <tr><td style="font-size:15px"><?php printf("<b>User %d</b>",$number1); $number1++; ?></td>
	  <td width="400" class="bar"><div style="width: <?php printf("%s%%",number_format(($i['sum_points']/(($count-1)*4))*100)); ?>">
	  </div></td><td><?php printf("%s%%",number_format(($i['sum_points']/(($count-1)*4))*100)); ?></td></tr>	
<?php
} while ($myrow16 = mysql_fetch_array($result16));	
} else {}
?>
</tbody>
</table> 

<?php
}
if ($it[t_points] != 0){
$usermark2=$usermark2*$iu[u_points];
$usermark3=number_format($usermark1/$usermark2*100, 2, '.', '');
echo "<p><b>Satisfaction (%) = Answer Point / Total Point x 100%</b></p>";
echo "<p><b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= $usermark1/$usermark2 x 100%</b></p>";
echo "<p><b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= $usermark3%</b></p>";
$usermark3=number_format($usermark3);
echo "<p><b>Overall satisfaction score for all task is $usermark3%</b></p>";
}else{}
?>

<?php
mysql_close($con);
?>
</form>
</fieldset>
</body>
</html>
