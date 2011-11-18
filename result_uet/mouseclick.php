<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Result -> Mouse Click Result</legend>
<script>
    function docheck(){
        if(document.form.pid.value==""){
        alert("Please select a project name!");
        return false;
        }
    }
</script>
<form name="form" action="mouseclick.php" method="POST" onsubmit="return docheck()">
<p></p>
<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");

$sql = "SELECT DISTINCT project FROM answermouseclick ORDER BY project ASC";
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
<p></p>
<?php

require("../library/connection.php");
if($_POST[pid]!=""){

$sql16 = "SELECT type FROM project WHERE name='$_POST[pid]'";
$result16 = mysql_query($sql16,$con);
if ($myrow16 = mysql_fetch_array($result16)){
$pjtype=$myrow16["type"];
}

$number=1;
$h=1;
$gmax=0;
 // Standard inclusions   
 include("pChart/pData.class");
 include("pChart/pChart.class");

 // Dataset definition 
 $DataSet = new pData;

?>
<table>
<tr><td style="font-size:15pt"><?php printf("<b><u>%s</u></b>",$_POST[pid]); ?></td></tr>
<?php
$sql13 = "SELECT DISTINCT name FROM answermouseclick WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {
?>
<tr>
<td>
<?php
printf("<b>User %d : %s </b>",$number,strtoupper($myrow13["name"]));
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
$sql2 = "SELECT DISTINCT task FROM answermouseclick WHERE project='$_POST[pid]' ORDER BY CAST(task AS UNSIGNED) ASC";
$result2 = mysql_query($sql2,$con);

?>
<table border="1" bordercolor="black" width="80%">
<tr style="font-weight:bold">
<td align="center">Task\User</td>
<?php

for($i=1;$i<$number;$i++){
?>
<td align="center"><?php printf("User %s",$i); ?></td>
<?php
}
?>
<td align="center">Sum</td>
<td align="center">Average</td>
<td align="center">Max</td>
<td align="center">Min</td></tr>

<?php
if ($myrow2 = mysql_fetch_array($result2)){
do {
$atotal=0;
$amax=0;
$amin=1000;
?>
<tr><td align="center"><b><?php printf("Task %s",$myrow2["task"]); ?></b></td>
<?php

if($pjtype=="remote"){

$sql13 = "SELECT DISTINCT name FROM answermouseclick WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql18 = "SELECT answer FROM answermouseclick WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND task='$myrow2[task]'";
$result18 = mysql_query($sql18,$con);
if ($myrow18 = mysql_fetch_array($result18)){
do {
$checking=$myrow18[answer];
$atotal=$atotal+$checking;
if($amax<$checking){
$amax=$checking;
}
if($amin>$checking){
$amin=$checking;
}

$tques=0;
$cques=0;
$wques=0;

if($tques==$cques){
?>
	<td align="center"><?php printf("%s",$checking); ?></td>
<?php
}else if($tques==$wques){
?>
	<td align="center"><font color="red"><?php printf("%s",$checking); ?></font></td>
<?php
}else{
?>
	<td align="center"><font color="blue"><?php printf("%s",$checking); ?></font></td>
<?php
}

} while ($myrow18 = mysql_fetch_array($result18));
	
} else {}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}

}else if($pjtype=="manual"){

$sql13 = "SELECT DISTINCT name FROM answermouseclick WHERE project='$_POST[pid]'";
$result13 = mysql_query($sql13,$con);
if ($myrow13 = mysql_fetch_array($result13)){
do {

$sql18 = "SELECT answer FROM answermouseclick WHERE project='$_POST[pid]' AND name='$myrow13[name]' AND task='$myrow2[task]'";
$result18 = mysql_query($sql18,$con);
if ($myrow18 = mysql_fetch_array($result18)){
do {
$checking=$myrow18[answer];
$atotal=$atotal+$checking;
if($amax<$checking){
$amax=$checking;
}
if($amin>$checking){
$amin=$checking;
}

?>
	<td align="center"><?php printf("%s",$checking); ?></td>
<?php


} while ($myrow18 = mysql_fetch_array($result18));
	
} else {}

} while ($myrow13 = mysql_fetch_array($result13));
	
} else {}

}

$DataSet->AddPoint($amax,"Serie4");
$DataSet->AddPoint($amin,"Serie5");
$DataSet->AddPoint($h,"Serie3");
$h++;
if($gmax<$amax){
$gmax=$amax;
}
?>
<td align="center"><?php printf("%s",$atotal); ?></td>
<td align="center"><?php printf("%s",number_format($atotal/($number-1))); ?></td>
<td align="center"><?php printf("%s",$amax); ?></td>
<td align="center"><?php printf("%s",$amin); ?></td>
</tr>
<?php

} while ($myrow2 = mysql_fetch_array($result2));
	
} else {}


 $DataSet->AddAllSeries();
 $DataSet->RemoveSerie("Serie3");
 $DataSet->SetAbsciseLabelSerie("Serie3");
 $DataSet->SetSerieName("MAX","Serie4");
 $DataSet->SetSerieName("MIN","Serie5");
 $DataSet->SetYAxisName("Total Mouse Click");
 $DataSet->SetXAxisName("Task No");
 $DataSet->SetYAxisUnit("");
 $DataSet->SetXAxisUnit("");

 // Initialise the graph
 $Test = new pChart(750,245);
 $Test->drawGraphAreaGradient(90,90,90,90,TARGET_BACKGROUND);
 $Test->setFixedScale(0,$gmax,4);

 // Graph area setup
 $Test->setFontProperties("Fonts/pf_arma_five.ttf",10);
 $Test->setGraphArea(80,40,680,200);
 $Test->drawGraphArea(200,200,200,FALSE);
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,200,200,200,TRUE,0,2);
 $Test->drawGraphAreaGradient(40,40,40,-50);
 $Test->drawGrid(4,TRUE,230,230,230,10);

 // Draw the line chart
 $Test->setShadowProperties(3,3,0,0,0,30,4);
 $Test->drawCubicCurve($DataSet->GetData(),$DataSet->GetDataDescription());
 $Test->clearShadow();
 $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,0,-1,-1,-1,TRUE);

 // Write the title
 $Test->setFontProperties("Fonts/MankSans.ttf",18);
 $Test->setShadowProperties(1,1,0,0,0);
 $Test->drawTitle(0,0,"Mouse Click Summary",255,255,255,700,30,TRUE);
 $Test->clearShadow();

 // Draw the legend
 $Test->setFontProperties("Fonts/tahoma.ttf",8);
 $Test->drawLegend(610,5,$DataSet->GetDataDescription(),0,0,0,0,0,0,255,255,255,FALSE);

 // Render the picture
 $Test->Render("mc.png");

?>
</table>
</form>
<table align="left">
<tr><td><img src="mc.png"/></td></tr>
</table>
<?php
}
mysql_close($con);
?>
</fieldset>
</body>
</html>