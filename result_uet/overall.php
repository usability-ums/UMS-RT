<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Result -> Overall Result</legend>
<script>
    function docheck(){
        if(document.form1.pid.value==""){
        alert("Please select a project name!");
        return false;
        }
    }
</script>
<form name="form1" action="overall.php" method="POST" onsubmit="return docheck()">
<p></p>
<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");

$sql = "SELECT DISTINCT name FROM project WHERE method_type='UET' ORDER BY name ASC";
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
$ytotal=0;
$ptotal=0;
$ntotal=0;
$mtotal=0;
require("../library/connection.php");

$sql13 = "SELECT DISTINCT name FROM answerefficiency WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql10 = "SELECT COUNT(answer) AS y_points FROM answerefficiency WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND answer='Yes'"; 
$result10 = mysql_query($sql10) or die(mysql_error()); 
$iu = mysql_fetch_array($result10);
if($iu[y_points]!='0'){
$ytotal=$ytotal+$iu[y_points];

}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}

$sql13 = "SELECT DISTINCT name FROM answerefficiency WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql10 = "SELECT COUNT(answer) AS p_points FROM answerefficiency WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND answer='Partial'"; 
$result10 = mysql_query($sql10) or die(mysql_error()); 
$iu = mysql_fetch_array($result10);
if($iu[p_points]!='0'){
$ptotal=$ptotal+$iu[p_points];

}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}

$sql13 = "SELECT DISTINCT name FROM answerefficiency WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql10 = "SELECT COUNT(answer) AS n_points FROM answerefficiency WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND answer='No'"; 
$result10 = mysql_query($sql10) or die(mysql_error()); 
$iu = mysql_fetch_array($result10);
if($iu[n_points]!='0'){
$ntotal=$ntotal+$iu[n_points];

}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}

$sql13 = "SELECT DISTINCT name FROM answerefficiency WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql10 = "SELECT COUNT(answer) AS m_points FROM answerefficiency WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND answer='-'"; 
$result10 = mysql_query($sql10) or die(mysql_error()); 
$iu = mysql_fetch_array($result10);
if($iu[m_points]!='0'){
$mtotal=$mtotal+$iu[m_points];

}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}

$sql13 = "SELECT DISTINCT name FROM answerefficiency WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql10 = "SELECT COUNT(answer) AS t_points FROM answerefficiency WHERE project='$_POST[pid]' AND name='$myrow13[name]'"; 
$result10 = mysql_query($sql10) or die(mysql_error()); 
$iu = mysql_fetch_array($result10);
$sumarry=$ytotal+$ptotal+$ntotal+$mtotal;
if($iu[t_points]!='0'){

}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}

$number--;
$unsuccess=$ntotal+$mtotal;
$gpass=$iu[t_points];
if($sumarry==0){
$finalm=0;
}else{
$finalm=number_format(($ytotal+($ptotal*0.5))/$sumarry*100, 2, '.', '');
}
$refficiency=$finalm;
$finalm=number_format($finalm);
$fefficiency=$finalm;
mysql_close($con);

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

$sql10 = "SELECT COUNT(answer) AS y_points FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND answer='Yes'"; 
$result10 = mysql_query($sql10) or die(mysql_error()); 
$iu = mysql_fetch_array($result10);
if($iu[y_points]!='0'){
$ytotal=$ytotal+$iu[y_points];

}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}

$sql13 = "SELECT DISTINCT name FROM answereffectiveness WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql10 = "SELECT COUNT(answer) AS p_points FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND answer='Partial'"; 
$result10 = mysql_query($sql10) or die(mysql_error()); 
$iu = mysql_fetch_array($result10);
if($iu[p_points]!='0'){
$ptotal=$ptotal+$iu[p_points];

}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}

$sql13 = "SELECT DISTINCT name FROM answereffectiveness WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql10 = "SELECT COUNT(answer) AS n_points FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND answer='No'"; 
$result10 = mysql_query($sql10) or die(mysql_error()); 
$iu = mysql_fetch_array($result10);
if($iu[n_points]!='0'){
$ntotal=$ntotal+$iu[n_points];

}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}

$sql13 = "SELECT DISTINCT name FROM answereffectiveness WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql10 = "SELECT COUNT(answer) AS m_points FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND answer='-'"; 
$result10 = mysql_query($sql10) or die(mysql_error()); 
$iu = mysql_fetch_array($result10);
if($iu[m_points]!='0'){
$mtotal=$mtotal+$iu[m_points];

}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}

$sql13 = "SELECT DISTINCT name FROM answereffectiveness WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql10 = "SELECT COUNT(answer) AS t_points FROM answereffectiveness WHERE project='$_POST[pid]' AND name='$myrow13[name]'"; 
$result10 = mysql_query($sql10) or die(mysql_error()); 
$iu = mysql_fetch_array($result10);
$sumarry=$ytotal+$ptotal+$ntotal+$mtotal;
if($iu[t_points]!='0'){

}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}

$number--;
$unsuccess=$ntotal+$mtotal;
$gpass=$iu[t_points];

if($sumarry==0){
$finalm=0;
}else{
$finalm=number_format(($ytotal+($ptotal*0.5))/$sumarry*100, 2, '.', '');
}

$reffectiveness=$finalm;
$finalm=number_format($finalm);
$feffectiveness=$finalm;

mysql_close($con);

require("../library/connection.php");
$number=1;
$usermark1=0;
$usermark2=0;

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

if ($myrow = mysql_fetch_array($result)){
do {
$count1++;

} while ($myrow = mysql_fetch_array($result));
	
} else {}


$sql2 = "SELECT DISTINCT question FROM score WHERE project='$_POST[pid]' AND task='$looping'";
$result2 = mysql_query($sql2,$con);

if ($myrow2 = mysql_fetch_array($result2)){
do {

$sql1 = "SELECT * FROM assignsatis WHERE project='$_POST[pid]' AND task='$looping' AND no='$myrow2[question]'";
$result1 = mysql_query($sql1,$con);

if ($myrow1 = mysql_fetch_array($result1)){
do {

$sql3 = "SELECT score FROM score WHERE project='$_POST[pid]' AND task='$looping' AND question='$myrow2[question]'";
$result3 = mysql_query($sql3,$con);
$total=0;
if ($myrow3 = mysql_fetch_array($result3)){
do {
	
$total=$total+(int)$myrow3["score"];
$num=$num+$total;
} while ($myrow3 = mysql_fetch_array($result3));
	
} else {}

$count++;

} while ($myrow1 = mysql_fetch_array($result1));
	
} else {}

} while ($myrow2 = mysql_fetch_array($result2));
	
} else {}

$usermark=0;
$sql6 = "SELECT DISTINCT user FROM score WHERE project='$_POST[pid]' AND task='$looping'";
$result6 = mysql_query($sql6,$con);
if ($myrow6 = mysql_fetch_array($result6)){
do {

$sql4 = "SELECT SUM(score) AS sum_points FROM score WHERE project='$_POST[pid]' AND task='$looping' AND user='$myrow6[user]'"; 
$result4 = mysql_query($sql4) or die(mysql_error()); 
$i = mysql_fetch_array($result4); 

$usermark=$usermark+$i['sum_points'];
} while ($myrow6 = mysql_fetch_array($result6));
	
} else {}

$usermark1=$usermark1+$usermark;
$usermark2=$usermark2+(($count-1)*4);

$totalpers=0;
$usermark=0;
$sql6 = "SELECT DISTINCT user FROM score WHERE project='$_POST[pid]' AND task='$looping'";
$result6 = mysql_query($sql6,$con);
if ($myrow6 = mysql_fetch_array($result6)){
do {

$sql4 = "SELECT SUM(score) AS sum_points FROM score WHERE project='$_POST[pid]' AND task='$looping' AND user='$myrow6[user]'"; 
$result4 = mysql_query($sql4) or die(mysql_error()); 
$i = mysql_fetch_array($result4); 

$totalpers=$totalpers+number_format(($i['sum_points']/(($count-1)*4))*100);
} while ($myrow6 = mysql_fetch_array($result6));	
} else {}
$sql10 = "SELECT COUNT(DISTINCT user) AS u_points FROM score WHERE project='$_POST[pid]' AND task='$looping'"; 
$result10 = mysql_query($sql10) or die(mysql_error()); 
$iu = mysql_fetch_array($result10);
if($iu[u_points]!='0'){

$finalmark=$finalmark+number_format($totalpers/$iu[u_points]);

}else{

}
$number1=1;

$sql16 = "SELECT DISTINCT user FROM score WHERE project='$_POST[pid]' AND task='$looping'";
$result16 = mysql_query($sql16,$con);
if ($myrow16 = mysql_fetch_array($result16)){
do {

$sql14 = "SELECT SUM(score) AS sum_points FROM score WHERE project='$_POST[pid]' AND task='$looping' AND user='$myrow16[user]'"; 
$result14 = mysql_query($sql14) or die(mysql_error()); 
$i = mysql_fetch_array($result14); 

$number1++;	  
	  	
} while ($myrow16 = mysql_fetch_array($result16));	
} else {}

}
if ($it[t_points] != 0){
$usermark2=$usermark2*$iu[u_points];
$usermark3=number_format($usermark1/$usermark2*100, 2, '.', '');
$rsatisfaction=$usermark3;
$usermark3=number_format($usermark3);
$fsatisfaction=$usermark3;
}else{}
mysql_close($con);

?>
<p><b><u><?php printf("%s",$_POST[pid]);?></u></b></p>
<table border="1" bordercolor="black" width="20%">
<tr style="background-color:#C0C0C0">
<td><b>Usability Criteria</b></td>
<td><b>Score</b></td>
</tr>
<tr>
<td style="background-color:#C0C0C0"><b>Effectiveness</b></td>
<td><?php printf("%s%%",$feffectiveness);?></td>
</tr>
<tr>
<td style="background-color:#C0C0C0"><b>Efficiency</b></td>
<td><?php printf("%s%%",$fefficiency);?></td>
</tr>
<tr>
<td style="background-color:#C0C0C0"><b>Satisfaction</b></td>
<td><?php printf("%s%%",$fsatisfaction);?></td>
</tr>
<?php
$fusability=number_format(($feffectiveness+$fefficiency+$fsatisfaction)/3);
?>
<tr>
<td style="background-color:#C0C0C0"><b>Usability Score</b></td>
<td><?php printf("%s%%",$fusability);?></td>
</tr>
</table>
<p><b>
The MIMOS Usability pass criterion is 75%.<br/>
The results above shows that <?php printf("%s",$_POST[pid]);?> with a score of <?php printf("%s%%",$fusability);?>
<?php if($fusability<75){ ?>
 has not met MIMOS Usability pass criterion.
<?php }else{ ?>
 has met MIMOS Usability pass criterion.
<?php } 
require("../library/connection.php");
$mstar=0;
$pstar=0;
for($p=1;$p<6;$p++){
$sql8 = "SELECT COUNT(user) AS s_point FROM debriefingc WHERE project='$_POST[pid]' AND question='3' AND comment='$p'"; 
$result8 = mysql_query($sql8) or die(mysql_error()); 
$st = mysql_fetch_array($result8);
if($st[s_point]>$mstar){
$mstar=$st[s_point];
$pstar=$p;
}
}
if($mstar!=0){
?>
<br/>Overall Star Rating
<?php
for($sp=1;$sp<=$pstar;$sp++){
?>
<img src="../images/star.jpg"/>
<?php
}
for($sp=$pstar;$sp<5;$sp++){
?>
<img src="../images/greystar.jpg"/>
<?php
}}
mysql_close($con);
?>
</b></p>
<?php
}else if ($pjtype=="remote"){

require("../library/connection.php");

$count=0;
$ty=0;

$sql13 = "SELECT DISTINCT name FROM a_question WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql15 = "SELECT * FROM a_question WHERE project='$_POST[pid]' AND name='$myrow13[name]'"; 
$result15 = mysql_query($sql15,$con);
if ($myrow15 = mysql_fetch_array($result15)){
do {
$count++;
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

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}

$feffectiveness=number_format(($ty/$count)*100, 0, '.', '');


$number=1;
$usermark1=0;
$usermark2=0;

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

if ($myrow = mysql_fetch_array($result)){
do {
$count1++;

} while ($myrow = mysql_fetch_array($result));
	
} else {}


$sql2 = "SELECT DISTINCT question FROM score WHERE project='$_POST[pid]' AND task='$looping'";
$result2 = mysql_query($sql2,$con);

if ($myrow2 = mysql_fetch_array($result2)){
do {

$sql1 = "SELECT * FROM assignsatis WHERE project='$_POST[pid]' AND task='$looping' AND no='$myrow2[question]'";
$result1 = mysql_query($sql1,$con);

if ($myrow1 = mysql_fetch_array($result1)){
do {

$sql3 = "SELECT score FROM score WHERE project='$_POST[pid]' AND task='$looping' AND question='$myrow2[question]'";
$result3 = mysql_query($sql3,$con);
$total=0;
if ($myrow3 = mysql_fetch_array($result3)){
do {
	
$total=$total+(int)$myrow3["score"];
$num=$num+$total;
} while ($myrow3 = mysql_fetch_array($result3));
	
} else {}

$count++;

} while ($myrow1 = mysql_fetch_array($result1));
	
} else {}

} while ($myrow2 = mysql_fetch_array($result2));
	
} else {}

$usermark=0;
$sql6 = "SELECT DISTINCT user FROM score WHERE project='$_POST[pid]' AND task='$looping'";
$result6 = mysql_query($sql6,$con);
if ($myrow6 = mysql_fetch_array($result6)){
do {

$sql4 = "SELECT SUM(score) AS sum_points FROM score WHERE project='$_POST[pid]' AND task='$looping' AND user='$myrow6[user]'"; 
$result4 = mysql_query($sql4) or die(mysql_error()); 
$i = mysql_fetch_array($result4); 

$usermark=$usermark+$i['sum_points'];
} while ($myrow6 = mysql_fetch_array($result6));
	
} else {}

$usermark1=$usermark1+$usermark;
$usermark2=$usermark2+(($count-1)*4);

$totalpers=0;
$usermark=0;
$sql6 = "SELECT DISTINCT user FROM score WHERE project='$_POST[pid]' AND task='$looping'";
$result6 = mysql_query($sql6,$con);
if ($myrow6 = mysql_fetch_array($result6)){
do {

$sql4 = "SELECT SUM(score) AS sum_points FROM score WHERE project='$_POST[pid]' AND task='$looping' AND user='$myrow6[user]'"; 
$result4 = mysql_query($sql4) or die(mysql_error()); 
$i = mysql_fetch_array($result4); 

$totalpers=$totalpers+number_format(($i['sum_points']/(($count-1)*4))*100);
} while ($myrow6 = mysql_fetch_array($result6));	
} else {}
$sql10 = "SELECT COUNT(DISTINCT user) AS u_points FROM score WHERE project='$_POST[pid]' AND task='$looping'"; 
$result10 = mysql_query($sql10) or die(mysql_error()); 
$iu = mysql_fetch_array($result10);
if($iu[u_points]!='0'){

$finalmark=$finalmark+number_format($totalpers/$iu[u_points]);

}else{

}
$number1=1;

$sql16 = "SELECT DISTINCT user FROM score WHERE project='$_POST[pid]' AND task='$looping'";
$result16 = mysql_query($sql16,$con);
if ($myrow16 = mysql_fetch_array($result16)){
do {

$sql14 = "SELECT SUM(score) AS sum_points FROM score WHERE project='$_POST[pid]' AND task='$looping' AND user='$myrow16[user]'"; 
$result14 = mysql_query($sql14) or die(mysql_error()); 
$i = mysql_fetch_array($result14); 

$number1++;	  
	  	
} while ($myrow16 = mysql_fetch_array($result16));	
} else {}

}
if ($it[t_points] != 0){
$usermark2=$usermark2*$iu[u_points];
$usermark3=number_format($usermark1/$usermark2*100, 2, '.', '');
$rsatisfaction=$usermark3;
$usermark3=number_format($usermark3);
$fsatisfaction=$usermark3;
}else{}
mysql_close($con);

?>
<p><b><u><?php printf("%s",$_POST[pid]);?></u></b></p>
<table border="1" bordercolor="black" width="20%">
<tr style="background-color:#C0C0C0">
<td><b>Usability Criteria</b></td>
<td><b>Score</b></td>
</tr>
<tr>
<td style="background-color:#C0C0C0"><b>Effectiveness</b></td>
<td><?php printf("%s%%",$feffectiveness);?></td>
</tr>
<tr>
<td style="background-color:#C0C0C0"><b>Satisfaction</b></td>
<td><?php printf("%s%%",$fsatisfaction);?></td>
</tr>
<?php
$fusability=number_format(($feffectiveness+$fsatisfaction)/2);
?>
<tr>
<td style="background-color:#C0C0C0"><b>Usability Score</b></td>
<td><?php printf("%s%%",$fusability);?></td>
</tr>
</table>
<p><b>
The MIMOS Usability pass criterion is 75%.<br/>
The results above shows that <?php printf("%s",$_POST[pid]);?> with a score of <?php printf("%s%%",$fusability);?>
<?php if($fusability<75){ ?>
 has not met MIMOS Usability pass criterion.
<?php }else{ ?>
 has met MIMOS Usability pass criterion.
<?php } 
require("../library/connection.php");
$mstar=0;
$pstar=0;
for($p=1;$p<6;$p++){
$sql8 = "SELECT COUNT(user) AS s_point FROM debriefingc WHERE project='$_POST[pid]' AND question='3' AND comment='$p'"; 
$result8 = mysql_query($sql8) or die(mysql_error()); 
$st = mysql_fetch_array($result8);
if($st[s_point]>$mstar){
$mstar=$st[s_point];
$pstar=$p;
}
}
if($mstar!=0){
?>
<br/>Overall Star Rating
<?php
for($sp=1;$sp<=$pstar;$sp++){
?>
<img src="../images/star.jpg"/>
<?php
}
for($sp=$pstar;$sp<5;$sp++){
?>
<img src="../images/greystar.jpg"/>
<?php
}}
mysql_close($con);
?>
</b></p>
<?php

}
}else{}
?>
</fieldset>
</body>
</html>