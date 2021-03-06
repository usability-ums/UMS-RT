﻿<?php
require("../library/navigation.php");
?>
<?php

	/* Libchart - PHP chart library
	 * Copyright (C) 2005-2010 Jean-Marc Trémeaux (jm.tremeaux at gmail.com)
	 * 
	 * This program is free software: you can redistribute it and/or modify
	 * it under the terms of the GNU General Public License as published by
	 * the Free Software Foundation, either version 3 of the License, or
	 * (at your option) any later version.
	 * 
	 * This program is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 * GNU General Public License for more details.
	 *
	 * You should have received a copy of the GNU General Public License
	 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
	 * 
	 */
?>

<html> 
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Result -> Change Request Result</legend>   
<script>
    function docheck(){
        if(document.form1.pid.value==""){
        alert("Please select a project name!");
        return false;
        }
    }
</script>
<form name="form1" action="defectcr.php" method="POST" onsubmit="return docheck()">
<p></p>
<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");

$sql = "SELECT DISTINCT project FROM defect WHERE testingtype='UET' ORDER BY project ASC";
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
?>
<h2><?php printf("%s",$_POST["pid"]); ?></h2>
<?php
require("../library/connection.php");
include "libchart/classes/libchart.php";

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Compatibility' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);

$ovcpttotal=$c1[t_points];

$sqlc2 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Consistency' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc2 = mysql_query($sqlc2) or die(mysql_error()); 
$c2 = mysql_fetch_array($resultc2);

$ovcontotal=$c2[t_points];

$sqlc3 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Error Prevention & Correction' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc3 = mysql_query($sqlc3) or die(mysql_error()); 
$c3 = mysql_fetch_array($resultc3);

$overrtotal=$c3[t_points];

$sqlc4 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Explicitness' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc4 = mysql_query($sqlc4) or die(mysql_error()); 
$c4 = mysql_fetch_array($resultc4);

$ovexptotal=$c4[t_points];

$sqlc5 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Flexibility' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc5 = mysql_query($sqlc5) or die(mysql_error()); 
$c5 = mysql_fetch_array($resultc5);

$ovflextotal=$c5[t_points];

$sqlc6 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Functionality' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc6 = mysql_query($sqlc6) or die(mysql_error()); 
$c6 = mysql_fetch_array($resultc6);

$ovfuntotal=$c6[t_points];

$sqlc7 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Informative Feedback' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc7 = mysql_query($sqlc7) or die(mysql_error()); 
$c7 = mysql_fetch_array($resultc7);

$ovinformtotal=$c7[t_points];

$sqlc8 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Language & Content' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc8 = mysql_query($sqlc8) or die(mysql_error()); 
$c8 = mysql_fetch_array($resultc8);

$ovlantotal=$c8[t_points];

$sqlc9 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Navigation' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc9 = mysql_query($sqlc9) or die(mysql_error()); 
$c9 = mysql_fetch_array($resultc9);

$ovnavtotal=$c9[t_points];

$sqlc10 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='User Guidance & Support' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc10 = mysql_query($sqlc10) or die(mysql_error()); 
$c10 = mysql_fetch_array($resultc10);

$ovguitotal=$c10[t_points];

$sqlc11 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Visual Clarity' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc11 = mysql_query($sqlc11) or die(mysql_error()); 
$c11 = mysql_fetch_array($resultc11);

$ovvistotal=$c11[t_points];

$sqlc12 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Privacy' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc12 = mysql_query($sqlc12) or die(mysql_error()); 
$c12 = mysql_fetch_array($resultc12);

$ovprytotal=$c12[t_points];

$sqlc13 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Others' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc13 = mysql_query($sqlc13) or die(mysql_error()); 
$c13 = mysql_fetch_array($resultc13);

$ovottotal=$c13[t_points];

$count=1;


$pdefect=0;
$rdefect=0;
$cdefect=0;
$kpdefect=0;
$ddefect=0;
$odefect=0;
$sdefect=0;
$rsdefect=0;



$defect[$count]=0;
$nameserie[$count]=$_POST["pid"];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Compatibility' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$serie1[$count]=$c1[t_points];
	$defect[$count]=$defect[$count]+$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Consistency' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$serie2[$count]=$c1[t_points];
	$defect[$count]=$defect[$count]+$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Error Prevention & Correction' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$serie3[$count]=$c1[t_points];
	$defect[$count]=$defect[$count]+$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Explicitness' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$serie4[$count]=$c1[t_points];
	$defect[$count]=$defect[$count]+$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Flexibility' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$serie5[$count]=$c1[t_points];
	$defect[$count]=$defect[$count]+$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Functionality' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$serie6[$count]=$c1[t_points];
	$defect[$count]=$defect[$count]+$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Informative Feedback' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);

	$serie7[$count]=$c1[t_points];
	$defect[$count]=$defect[$count]+$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Language & Content' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$serie8[$count]=$c1[t_points];
	$defect[$count]=$defect[$count]+$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Navigation' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$serie9[$count]=$c1[t_points];
	$defect[$count]=$defect[$count]+$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='User Guidance & Support' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$serie10[$count]=$c1[t_points];
	$defect[$count]=$defect[$count]+$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Visual Clarity' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$serie11[$count]=$c1[t_points];
	$defect[$count]=$defect[$count]+$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Privacy' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$serie12[$count]=$c1[t_points];
	$defect[$count]=$defect[$count]+$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND category='Others' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$serie13[$count]=$c1[t_points];
	$defect[$count]=$defect[$count]+$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND severity='Critical' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$critical[$count]=$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND severity='Major' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$major[$count]=$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND severity='Minor' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$minor[$count]=$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND status='Postponed' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$postponed[$count]=$c1[t_points];
	$pdefect=$pdefect+$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND status='Rejected' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$rejected[$count]=$c1[t_points];
	$rdefect=$rdefect+$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND status='Closed' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$closed[$count]=$c1[t_points];
	$cdefect=$cdefect+$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND status='KIV' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$kiv[$count]=$c1[t_points];
	$kdefect=$kdefect+$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND status='Submitted' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$submitted[$count]=$c1[t_points];
	$sdefect=$sdefect+$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND status='Duplicate' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$duplicate[$count]=$c1[t_points];
	$ddefect=$ddefect+$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND status='Opened' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$opened[$count]=$c1[t_points];
	$odefect=$odefect+$c1[t_points];

$sqlc1 = "SELECT COUNT(id) AS t_points FROM defect WHERE project='$_POST[pid]' AND status='Resolved' AND defecttype='Change Request' AND testingtype='UET'"; 
$resultc1 = mysql_query($sqlc1) or die(mysql_error()); 
$c1 = mysql_fetch_array($resultc1);
	
	$resolved[$count]=$c1[t_points];
	$rsdefect=$rsdefect+$c1[t_points];

	$count++;


mysql_close($con);	

	$chart = new VerticalBarChart(500,300);

	$dataSet = new XYDataSet();
	$dataSet->addPoint(new Point("Compatibility", $ovcpttotal));
	$dataSet->addPoint(new Point("Consistency and Standards", $ovcontotal));
	$dataSet->addPoint(new Point("Error Prevention & Correction", $overrtotal));
	$dataSet->addPoint(new Point("Explicitness", $ovexptotal));
	$dataSet->addPoint(new Point("Flexibility & Control", $ovflextotal));
	$dataSet->addPoint(new Point("Functionality", $ovfuntotal));
	$dataSet->addPoint(new Point("Informative Feedback", $ovinformtotal));
	$dataSet->addPoint(new Point("Language & Content", $ovlantotal));
	$dataSet->addPoint(new Point("Navigation", $ovnavtotal));
	$dataSet->addPoint(new Point("User Guidance & Support",$ovguitotal ));
	$dataSet->addPoint(new Point("Visual Clarity", $ovvistotal));
	$dataSet->addPoint(new Point("Privacy",$ovprytotal ));
	$dataSet->addPoint(new Point("Others",$ovottotal ));
	$chart->setDataSet($dataSet);

	$chart->setTitle("Overall defects categorization");
	$chart->render("dashoverall.png");

	$chart = new VerticalBarChart(750,300);

	for($i=1;$i<$count;$i++){
	$serie[$i] = new XYDataSet();
	$serie[$i]->addPoint(new Point("Critical", $critical[$i]));
	$serie[$i]->addPoint(new Point("Major", $major[$i]));
	$serie[$i]->addPoint(new Point("Minor", $minor[$i]));
	}
	
	$dataSet = new XYSeriesDataSet();

	for($i=1;$i<$count;$i++){
	$dataSet->addSerie("$nameserie[$i]", $serie[$i]);
	}

	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphCaptionRatio(0.62);

	$chart->setTitle("Defects severity");
	$chart->render("severity.png");

	$chart = new PieChart(500,300);

	$dataSet = new XYDataSet();
	
	$dataSet->addPoint(new Point("Postponed($pdefect)", $pdefect));
	$dataSet->addPoint(new Point("Rejected($rdefect)", $rdefect));
	$dataSet->addPoint(new Point("Closed($cdefect)", $cdefect));
	$dataSet->addPoint(new Point("KIV($kdefect)", $kdefect));
	$dataSet->addPoint(new Point("Submitted($sdefect)", $sdefect));
	$dataSet->addPoint(new Point("Duplicate($ddefect)", $ddefect));
	$dataSet->addPoint(new Point("Opened($odefect)", $odefect));
	$dataSet->addPoint(new Point("Resolved($rsdefect)", $rsdefect));
		
	$chart->setDataSet($dataSet);

	$chart->setTitle("Defects status");
	$chart->render("status.png");

	$chart = new VerticalBarChart(750,300);

	for($i=1;$i<$count;$i++){
	$serie[$i] = new XYDataSet();
	$serie[$i]->addPoint(new Point("Postponed", $postponed[$i]));
	$serie[$i]->addPoint(new Point("Rejected", $rejected[$i]));
	$serie[$i]->addPoint(new Point("Closed", $closed[$i]));
	$serie[$i]->addPoint(new Point("KIV", $kiv[$i]));
	$serie[$i]->addPoint(new Point("Submitted", $submitted[$i]));
	$serie[$i]->addPoint(new Point("Duplicate", $duplicate[$i]));
	$serie[$i]->addPoint(new Point("Opened", $opened[$i]));
	$serie[$i]->addPoint(new Point("Resolved", $resolved[$i]));
	}
	
	$dataSet = new XYSeriesDataSet();

	for($i=1;$i<$count;$i++){
	$dataSet->addSerie("$nameserie[$i]", $serie[$i]);
	}

	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphCaptionRatio(0.62);

	$chart->setTitle("Defects status");
	$chart->render("substatus.png");

?>
<table align="left">
<tr>
<td><img src="dashoverall.png" style="border: 1px solid gray;"/></td>
<td><img src="severity.png" style="border: 1px solid gray;"/></td>
</tr>
<tr>
<td><img src="status.png" style="border: 1px solid gray;"/></td>
<td><img src="substatus.png" style="border: 1px solid gray;"/></td>
</tr>
</table>

<?php
}
?>   
</fieldset>
</body>
</html>
