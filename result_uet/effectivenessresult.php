<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Result -> Effectiveness Result</legend>
<script>
    function doCheck(){
        if(document.form1.pid.value==""){
        alert("Please select a project name!");
        return false;
        }
    }
</script>
<form name="form1" action="effectivenessresult.php" method="POST" onsubmit="return doCheck()">
<p></p>
<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");

$sql = "SELECT DISTINCT project FROM user ORDER BY project ASC";
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
<?php
if($_POST[pid] !=""){

require("../library/connection.php");

$sql16 = "SELECT type FROM project WHERE name='$_POST[pid]'";
$result16 = mysql_query($sql16,$con);
if ($myrow16 = mysql_fetch_array($result16)){
$pjtype=$myrow16["type"];

}

if($pjtype=="manual"){

$number=1;
?>
<table>
<tr><td style="font-size:15pt"><?php printf("<b><u>%s</u></b>",$_POST[pid]); ?></td></tr>
<?php
$sql13 = "SELECT DISTINCT name FROM answereffectiveness WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {
?>
<tr>
<td>
<?php
$percentage=0;
$sql15 = "SELECT COUNT(answer) AS c_points FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND answer='Yes'"; 
$result15 = mysql_query($sql15) or die(mysql_error()); 
$iu = mysql_fetch_array($result15);

$sql16 = "SELECT COUNT(answer) AS c1_points FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND answer='Partial'"; 
$result16 = mysql_query($sql16) or die(mysql_error()); 
$iu1 = mysql_fetch_array($result16);

$sql17 = "SELECT COUNT(answer) AS c2_points FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]'"; 
$result17 = mysql_query($sql17) or die(mysql_error()); 
$iu2 = mysql_fetch_array($result17);
$percentage=($iu[c_points]+($iu1[c1_points]*0.5))/$iu2[c2_points];


printf("<b>User %d(%s%%) : %s</b>",$number,number_format($percentage*100, 0, '.', ''),strtoupper($myrow13["name"]));
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
<table border="1" width="100%" bordercolor="black" cellspacing="0" cellpadding="0">
<?php

$sql = "SELECT * FROM task WHERE PName='$_POST[pid]' ORDER BY CAST(no AS UNSIGNED) ASC";
$result = mysql_query($sql,$con);
	
if ($myrow = mysql_fetch_array($result)){
do {
$number=1;
$string = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["question"]);
$string = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string));


	?><tr style="background-color:#C0C0C0"><td align="center"><b>Task<?php printf("%s",$myrow["no"]); ?></b></td>
	<td><b><?php printf("%s",$string); ?></b></td>
<?php
$sql13 = "SELECT DISTINCT name FROM answereffectiveness WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

?>
	<td align="center" style="width:22mm"><b>User <?php printf("%s",$number);$number++; ?></b></td>
<?php	
} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}
?>
</tr>
<?php
$sql1 = "SELECT * FROM assigneffectiveness WHERE project='$_POST[pid]' ORDER BY CAST(no AS UNSIGNED) ASC";
$result1 = mysql_query($sql1,$con);
if ($myrow1 = mysql_fetch_array($result1)){
do {

$sql13 = "SELECT * FROM effectiveness WHERE no='$myrow1[no]'";
$result13 = mysql_query($sql13,$con);
$myrow13 = mysql_fetch_array($result13);

$string1 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow13["question"]);
$string1 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string1));

	?>
	<tr><td></td><td><?php printf("%s",$string1); ?></td>
	
<?php

$sql13 = "SELECT DISTINCT name FROM answereffectiveness WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql2 = "SELECT * FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND task='$myrow[no]' AND no='$myrow1[no]'";
$result2 = mysql_query($sql2,$con);
if ($myrow2 = mysql_fetch_array($result2)){
do {

if($myrow2["answer"]=="No"){
?>

	<td align="center"><font color="red"><?php printf("%s",$myrow2["answer"]); ?></font></td>
<?php
}else if($myrow2["answer"]=="Partial"){
?>

	<td align="center"><font color="blue"><?php printf("%s",$myrow2["answer"]); ?></font></td>
<?php
}else if($myrow2["answer"]=="-"){
?>

	<td align="center"><font color="red">N/A</font></td>
<?php
}else{
?>

	<td align="center"><?php printf("%s",$myrow2["answer"]); ?></td>
<?php
}
} while ($myrow2 = mysql_fetch_array($result2));

} else {}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}

?>
</tr>
<?php

} while ($myrow1 = mysql_fetch_array($result1));

} else {}

} while ($myrow = mysql_fetch_array($result));
	
} else {}

?>
</table>
<?php
mysql_close($con);
?>
<p><b><u>Effectiveness</b></u></p>
<table border="1" width="60%" bordercolor="black" cellspacing="0" cellpadding="0">
<tr>
<td> </td>
<?php
$number=1;
$ytotal=0;
$ptotal=0;
$ntotal=0;
$mtotal=0;
require("../library/connection.php");

$sql13 = "SELECT DISTINCT name FROM answereffectiveness WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {
?>
<td align="center" style="background-color:#C0C0C0">
<?php
printf("<b>User %d</b>",$number);
$number++;
?>
</td>
<?php	
} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}
?>
<td align="center" style="background-color:#C0C0C0"><b>Subtotal</b></td>
</tr>
<tr>
<td align="center" style="background-color:#C0C0C0"><b>Yes</b></td>
<?php
$sql13 = "SELECT DISTINCT name FROM answereffectiveness WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql10 = "SELECT COUNT(answer) AS y_points FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND answer='Yes'"; 
$result10 = mysql_query($sql10) or die(mysql_error()); 
$iu = mysql_fetch_array($result10);
if($iu[y_points]!='0'){
$ytotal=$ytotal+$iu[y_points];
?>
<td align="center"><?php printf("%s",$iu[y_points]);?></td>
<?php
}else{
?>
<td align="center">0</td>
<?php
}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}
?>
<td align="center"><b><?php printf("%s",$ytotal);?></b></td>
</tr>

<tr>
<td align="center" style="background-color:#C0C0C0"><b>Partial</b></td>
<?php
$sql13 = "SELECT DISTINCT name FROM answereffectiveness WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql10 = "SELECT COUNT(answer) AS p_points FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND answer='Partial'"; 
$result10 = mysql_query($sql10) or die(mysql_error()); 
$iu = mysql_fetch_array($result10);
if($iu[p_points]!='0'){
$ptotal=$ptotal+$iu[p_points];
?>
<td align="center"><?php printf("%s",$iu[p_points]);?></td>
<?php
}else{
?>
<td align="center">0</td>
<?php
}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}
?>
<td align="center"><b><?php printf("%s",$ptotal);?></b></td>
</tr>

<tr>
<td align="center" style="background-color:#C0C0C0"><b>No</b></td>
<?php
$sql13 = "SELECT DISTINCT name FROM answereffectiveness WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql10 = "SELECT COUNT(answer) AS n_points FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND answer='No'"; 
$result10 = mysql_query($sql10) or die(mysql_error()); 
$iu = mysql_fetch_array($result10);
if($iu[n_points]!='0'){
$ntotal=$ntotal+$iu[n_points];
?>
<td align="center"><?php printf("%s",$iu[n_points]);?></td>
<?php
}else{
?>
<td align="center">0</td>
<?php
}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}
?>
<td align="center"><b><?php printf("%s",$ntotal);?></b></td>
</tr>

<tr>
<td align="center" style="background-color:#C0C0C0"><b>N/A</b></td>
<?php
$sql13 = "SELECT DISTINCT name FROM answereffectiveness WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql10 = "SELECT COUNT(answer) AS m_points FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND answer='-'"; 
$result10 = mysql_query($sql10) or die(mysql_error()); 
$iu = mysql_fetch_array($result10);
if($iu[m_points]!='0'){
$mtotal=$mtotal+$iu[m_points];
?>
<td align="center"><?php printf("%s",$iu[m_points]);?></td>
<?php
}else{
?>
<td align="center">0</td>
<?php
}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}
?>
<td align="center"><b><?php printf("%s",$mtotal);?></b></td>
</tr>

<tr>
<?php
$sql13 = "SELECT DISTINCT name FROM answereffectiveness WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql10 = "SELECT COUNT(answer) AS t_points FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]'"; 
$result10 = mysql_query($sql10) or die(mysql_error()); 
$iu = mysql_fetch_array($result10);
$sumarry=$ytotal+$ptotal+$ntotal+$mtotal;
if($iu[t_points]!='0'){
?>
<td align="center"></td>
<?php
}else{
?>
<td align="center"></td>
<?php
}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}
?>
<td align="center"><b>TOTAL</b></td>
<td align="center"><b><?php printf("%s",$sumarry);?></b></td>
</tr>
</table>
<?php
$number--;
$unsuccess=$ntotal+$mtotal;
$gpass=$iu[t_points];
echo "<p align=\"justify\">Table above shows $iu[t_points] task criteria with $number attempts (users) per task, totaling $sumarry attempts. <b>$ytotal</b> attempts were successful and <b>$ptotal</b> were partially successful. There are total of $unsuccess unsuccessful tasks which will be given a value of zero. Therefore, to arrive at the overall effectiveness rating for this set of tasks we use the following equation:</p>";

echo "<p><b>Effectiveness (%) = (Yes + (Partial x 0.5)) / Total x 100%</b></p>";
echo "<p><b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= ($ytotal + ($ptotal x 0.5)) / $sumarry x 100%</b></p>";
if($sumarry==0){
$finalm=0;
}else{
$finalm=number_format(($ytotal+($ptotal*0.5))/$sumarry*100, 2, '.', '');
}
echo "<p><b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= $finalm%</p>";
$finalm=number_format($finalm);
echo "<p><b>Overall effectiveness score for all task is $finalm%</b></p>";
mysql_close($con);

require("../library/connection.php");

$number=1;

?>
<table width="530" class="graph" cellspacing="6" cellpadding="0">
<thead>
<tr><th colspan="3">Effectiveness</th></tr>
</thead>
<tbody>
<?php
$sql13 = "SELECT DISTINCT name FROM answereffectiveness WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {
?>
<tr>
<td style="font-size:15px">
<?php
$percentage=0;
$sql15 = "SELECT COUNT(answer) AS c_points FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND answer='Yes'"; 
$result15 = mysql_query($sql15) or die(mysql_error()); 
$iu = mysql_fetch_array($result15);

$sql16 = "SELECT COUNT(answer) AS c1_points FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND answer='Partial'"; 
$result16 = mysql_query($sql16) or die(mysql_error()); 
$iu1 = mysql_fetch_array($result16);

$sql17 = "SELECT COUNT(answer) AS c2_points FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]'"; 
$result17 = mysql_query($sql17) or die(mysql_error()); 
$iu2 = mysql_fetch_array($result17);
$percentage=($iu[c_points]+($iu1[c1_points]*0.5))/$iu2[c2_points];

printf("<b>User %d</b>",$number);
$number++;
?>
</td><td width="400" class="bar"><div style="width: <?php printf("%s%%",number_format($percentage*100, 0, '.', ''));?>">
</div></td><td><?php printf("%s%%",number_format($percentage*100, 0, '.', ''));?></td></tr>
<?php	
} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}
?>
</tbody>
</table> 
<p></p>
<table width="530" class="graph" cellspacing="1" cellpadding="0">
<thead>
<tr><th colspan="2"><img src="../images/graph.bmp"/></th></tr>
</thead>
<tbody>
<?php
mysql_close($con);
require("../library/connection.php");

$number=1;
$sql13 = "SELECT DISTINCT name FROM answereffectiveness WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql10 = "SELECT COUNT(answer) AS y_points FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND answer='Yes'"; 
$result10 = mysql_query($sql10) or die(mysql_error()); 
$iu = mysql_fetch_array($result10);

$sql11 = "SELECT COUNT(answer) AS p_points FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND answer='Partial'"; 
$result11 = mysql_query($sql11) or die(mysql_error()); 
$iu1 = mysql_fetch_array($result11);

$sql12 = "SELECT COUNT(answer) AS n_points FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND answer='No'"; 
$result12 = mysql_query($sql12) or die(mysql_error()); 
$iu2 = mysql_fetch_array($result12);

$sql14 = "SELECT COUNT(answer) AS m_points FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND answer='-'"; 
$result14 = mysql_query($sql14) or die(mysql_error()); 
$iu4 = mysql_fetch_array($result14);

$add=0;
$add=$iu2[n_points]+$iu4[m_points];

?>
<tr>
<td width="13%"></td>
<td width="400" class="bar"><div style="background-color:green;border-top: solid 2px #32CD32;width: <?php printf("%s%%",(($iu[y_points]/$gpass)*100));?>">
<?php printf("%s",$iu[y_points]);?></div></td></tr>

<tr>
<td width="13%" style="font-size:15px"><?php printf("<b>User %d</b>",$number); $number++;?></td>
<td width="400" class="bar"><div style="background-color:blue;border-top: solid 2px #1874CD;width: <?php printf("%s%%",(($iu1[p_points]/$gpass)*100));?>">
<?php printf("%s",$iu1[p_points]);?></div></td></tr>

<tr>
<td width="13%"></td>
<td width="400" class="bar"><div style="background-color:red;border-top: solid 2px #FF4040;width: <?php printf("%s%%",(($add/$gpass)*100));?>">
<?php printf("%s",$add);?></div></td></tr>

<?php	
} while ($myrow13 = mysql_fetch_array($result13));	
} else {}

?>
</tbody>
</table>    
<?php

}else if($pjtype=="remote"){



$ytotal=0;
$ntotal=0;
$counter=0;
$ttask=0;
$number=1;
?>
<table>
<tr><td style="font-size:15pt"><?php printf("<b><u>%s</u></b>",$_POST[pid]); ?></td></tr>
<?php
$sql13 = "SELECT DISTINCT name FROM a_question WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {
$counter++;
?>
<tr>
<td>
<?php
$percentage=0;
$count=0;
$ty=0;
$sql15 = "SELECT * FROM a_question WHERE project='$_POST[pid]' AND name='$myrow13[name]'"; 
$result15 = mysql_query($sql15,$con);
if ($myrow15 = mysql_fetch_array($result15)){
do {
$count++;
$ntotal++;
$sql16 = "SELECT * FROM p_question WHERE id='$myrow15[id]'"; 
$result16 = mysql_query($sql16,$con);
if ($myrow16 = mysql_fetch_array($result16)){

$pos = strpos(strtolower($myrow15[answer]),strtolower($myrow16[answer]));

if($pos === false) {
}
else {
 $ty++;
$ytotal++;
}

}

} while ($myrow15 = mysql_fetch_array($result15));
	
} else {}

$percentage=$ty/$count;


printf("<b>User %d(%s%%) : %s</b>",$number,number_format($percentage*100, 0, '.', ''),strtoupper($myrow13["name"]));
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
<table border="1" width="100%" bordercolor="black" cellspacing="0" cellpadding="0">
<?php
$sql = "SELECT * FROM task WHERE PName='$_POST[pid]' ORDER BY CAST(no AS UNSIGNED) ASC";
$result = mysql_query($sql,$con);
	
if ($myrow = mysql_fetch_array($result)){
do {
$number=1;
$string = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["question"]);
$string = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string));


	?><tr style="background-color:#C0C0C0"><td align="center"><b>Task<?php printf("%s",$myrow["no"]); ?></b></td>
	<td><b><?php printf("%s",$string); ?></b></td>
<?php
$sql13 = "SELECT DISTINCT name FROM a_question WHERE project='$_POST[pid]' AND task='$myrow[no]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

?>
	<td align="center" style="width:22mm"><b>User <?php printf("%s",$number);$number++; ?></b></td>
<?php	
} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}
?>
</tr>
<?php

$sql1 = "SELECT * FROM p_question WHERE title='$_POST[pid]' AND task='$myrow[no]' ORDER BY CAST(id AS UNSIGNED) ASC";
$result1 = mysql_query($sql1,$con);
if ($myrow1 = mysql_fetch_array($result1)){
do {
$ttask++;
$string1 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow1["question"]);
$string1 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string1));

	?>
	<tr><td></td><td><?php printf("%s<br/>Answer: %s",$string1,$myrow1[answer]); ?></td>
	
<?php

$sql13 = "SELECT DISTINCT name FROM a_question WHERE project='$_POST[pid]' AND task='$myrow[no]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql2 = "SELECT * FROM a_question WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND task='$myrow[no]' AND id='$myrow1[id]'";
$result2 = mysql_query($sql2,$con);
if ($myrow2 = mysql_fetch_array($result2)){
do {

$pos = strpos(strtolower($myrow2[answer]),strtolower($myrow1[answer]));

if($pos === false) {
?>
<td align="center"><font color="red"><?php printf("%s",$myrow2["answer"]); ?></font></td>
<?php
}
else {
?>
<td align="center"><font color="green"><?php printf("%s",$myrow2["answer"]); ?></font></td>
<?php
}

} while ($myrow2 = mysql_fetch_array($result2));

} else {}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}

?>
</tr>
<?php

} while ($myrow1 = mysql_fetch_array($result1));

} else {}

} while ($myrow = mysql_fetch_array($result));
	
} else {}

?>
</table>
<?php
mysql_close($con);
?>
<p><b><u>Effectiveness</b></u></p>
<table border="1" width="60%" bordercolor="black" cellspacing="0" cellpadding="0">
<tr>
<td> </td>
<?php
$number=1;
require("../library/connection.php");

$sql13 = "SELECT DISTINCT name FROM a_question WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {
?>
<td align="center" style="background-color:#C0C0C0">
<?php
printf("<b>User %d</b>",$number);
$number++;
?>
</td>
<?php	
} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}
?>
<td align="center" style="background-color:#C0C0C0"><b>Subtotal</b></td>
</tr>
<tr>
<td align="center" style="background-color:#C0C0C0"><b>Correct</b></td>
<?php
$sql13 = "SELECT DISTINCT name FROM a_question WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {
$ttt=0;

$sql15 = "SELECT * FROM a_question WHERE project='$_POST[pid]' AND name='$myrow13[name]'"; 
$result15 = mysql_query($sql15,$con);
if ($myrow15 = mysql_fetch_array($result15)){
do {

$sql16 = "SELECT * FROM p_question WHERE id='$myrow15[id]'"; 
$result16 = mysql_query($sql16,$con);
if ($myrow16 = mysql_fetch_array($result16)){

$pos = strpos(strtolower($myrow15[answer]),strtolower($myrow16[answer]));

if($pos === false) {
}
else {
 $ttt++;
}

}

} while ($myrow15 = mysql_fetch_array($result15));
	
} else {}

if($ttt!='0'){
?>
<td align="center"><?php printf("%s",$ttt);?></td>
<?php
}else{
?>
<td align="center">0</td>
<?php
}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}
?>
<td align="center"><b><?php printf("%s",$ytotal);?></b></td>
</tr>


<tr>
<td align="center" style="background-color:#C0C0C0"><b>Wrong</b></td>
<?php
$sql13 = "SELECT DISTINCT name FROM a_question WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {
$ttt=0;

$sql15 = "SELECT * FROM a_question WHERE project='$_POST[pid]' AND name='$myrow13[name]'"; 
$result15 = mysql_query($sql15,$con);
if ($myrow15 = mysql_fetch_array($result15)){
do {

$sql16 = "SELECT * FROM p_question WHERE id='$myrow15[id]'"; 
$result16 = mysql_query($sql16,$con);
if ($myrow16 = mysql_fetch_array($result16)){

$pos = strpos(strtolower($myrow15[answer]),strtolower($myrow16[answer]));

if($pos === false) {
$ttt++;
}
else {
 
}

}

} while ($myrow15 = mysql_fetch_array($result15));
	
} else {}

if($ttt!='0'){
?>
<td align="center"><?php printf("%s",$ttt);?></td>
<?php
}else{
?>
<td align="center">0</td>
<?php
}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}
?>
<td align="center"><b><?php printf("%s",$ntotal-$ytotal);?></b></td>
</tr>


<tr>
<?php
for($i=0;$i<$counter;$i++){
?>
<td align="center"></td>
<?php
}
?>
<td align="center"><b>TOTAL</b></td>
<td align="center"><b><?php printf("%s",($ntotal-$ytotal)+$ytotal);?></b></td>
</tr>
</table>
<?php
$number--;
$unsuccess=$ntotal-$ytotal;
$gpass=$iu[t_points];
$sumarry=$ttask*$number;
echo "<p align=\"justify\">Table above shows $ttask task criteria with $number attempts (users) per task, totaling $sumarry attempts. <b>$ytotal</b> attempts were successful and there are total of $unsuccess unsuccessful tasks which will be given a value of zero. Therefore, to arrive at the overall effectiveness rating for this set of tasks we use the following equation:</p>";

echo "<p><b>Effectiveness (%) = Yes / Total x 100%</b></p>";
echo "<p><b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= $ytotal / $sumarry x 100%</b></p>";
if($sumarry==0){
$finalm=0;
}else{
$finalm=number_format(($ytotal+($ptotal*0.5))/$sumarry*100, 2, '.', '');
}
echo "<p><b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= $finalm%</p>";
$finalm=number_format($finalm);
echo "<p><b>Overall effectiveness score for all task is $finalm%</b></p>";
mysql_close($con);

require("../library/connection.php");

$number=1;

?>
<table width="530" class="graph" cellspacing="6" cellpadding="0">
<thead>
<tr><th colspan="3">Effectiveness</th></tr>
</thead>
<tbody>
<?php
$sql13 = "SELECT DISTINCT name FROM a_question WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {
?>
<tr>
<td style="font-size:15px">
<?php
$ty=0;
$percentage=0;
$count=0;
$sql15 = "SELECT * FROM a_question WHERE project='$_POST[pid]' AND name='$myrow13[name]'"; 
$result15 = mysql_query($sql15,$con);
if ($myrow15 = mysql_fetch_array($result15)){
do {
$count++;
$ntotal++;
$sql16 = "SELECT * FROM p_question WHERE id='$myrow15[id]'"; 
$result16 = mysql_query($sql16,$con);
if ($myrow16 = mysql_fetch_array($result16)){

$pos = strpos(strtolower($myrow15[answer]),strtolower($myrow16[answer]));

if($pos === false) {
}
else {
 $ty++;
}

}

} while ($myrow15 = mysql_fetch_array($result15));
	
} else {}

$percentage=$ty/$count;

printf("<b>User %d</b>",$number);
$number++;
?>
</td><td width="400" class="bar"><div style="width: <?php printf("%s%%",number_format($percentage*100, 0, '.', ''));?>">
</div></td><td><?php printf("%s%%",number_format($percentage*100, 0, '.', ''));?></td></tr>
<?php	
} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}
?>
</tbody>
</table> 
<p></p>
<table width="530" class="graph" cellspacing="1" cellpadding="0">
<thead>
<tr><th colspan="2"><img src="../images/graph1.bmp"/></th></tr>
</thead>
<tbody>
<?php
mysql_close($con);
require("../library/connection.php");

$number=1;
$sql13 = "SELECT DISTINCT name FROM a_question WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$ttt=0;
$nnn=0;

$sql15 = "SELECT * FROM a_question WHERE project='$_POST[pid]' AND name='$myrow13[name]'"; 
$result15 = mysql_query($sql15,$con);
if ($myrow15 = mysql_fetch_array($result15)){
do {

$sql16 = "SELECT * FROM p_question WHERE id='$myrow15[id]'"; 
$result16 = mysql_query($sql16,$con);
if ($myrow16 = mysql_fetch_array($result16)){

$pos = strpos(strtolower($myrow15[answer]),strtolower($myrow16[answer]));

if($pos === false) {
$nnn++;
}
else {
 $ttt++;
}

}

} while ($myrow15 = mysql_fetch_array($result15));
	
} else {}

?>
<tr>
<td width="13%" style="font-size:15px"><?php printf("<b>User %d</b>",$number); $number++;?></td>
<td width="400" class="bar"><div style="background-color:green;border-top: solid 2px #32CD32;width: <?php printf("%s%%",(($ttt/$ttask)*100));?>">
<?php printf("%s",$ttt);?></div></td></tr>

<tr>
<td width="13%"></td>
<td width="400" class="bar"><div style="background-color:red;border-top: solid 2px #FF4040;width: <?php printf("%s%%",(($nnn/$ttask)*100));?>">
<?php printf("%s",$nnn);?></div></td></tr>

<?php	
} while ($myrow13 = mysql_fetch_array($result13));	
} else {}


}
mysql_close($con);
}else{


}
?>
</fieldset>
</body>
</html>
