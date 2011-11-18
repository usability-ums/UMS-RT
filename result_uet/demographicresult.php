<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Result -> Demographic Result</legend>
<script>
    function docheck(){
        if(document.form.pid.value==""){
        alert("Please select a project name!");
        return false;
        }
    }
</script>
<form name="form" action="demographicresult.php" method="POST" onsubmit="return docheck()">
<p></p>
<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");

$sql = "SELECT DISTINCT project FROM demoscore ORDER BY project ASC";
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
<p style="font-size:16pt"><b><u><?php printf("%s",$_POST[pid]); ?></b></u></p>
<?php
require("../library/connection.php");

$sql2 = "SELECT DISTINCT id FROM assigndemo WHERE project='$_POST[pid]'";
$result2 = mysql_query($sql2,$con);

if ($myrow2 = mysql_fetch_array($result2)){
do {

$sql21 = "SELECT * FROM demographic WHERE id='$myrow2[id]'";
$result21 = mysql_query($sql21,$con);

if ($myrow21 = mysql_fetch_array($result21)){
$question=$myrow21["question"];
$rawend = explode("\n", $myrow21["answer"]);
$loop= count($rawend);
}else{}
?>
<table border="1" bordercolor="black" width="55%">
<tr style="background-color:#C0C0C0">
<td><b><?php printf("%s",$question); ?></b></td>
<td width="70" align="center"><b>Frequency</b></td>
<td width="60" align="center"><b>Percent</b></td>
</tr>

<?php

for($i=0;$i<$loop;$i++){
$rawend[$i]=trim($rawend[$i]);
$sql8 = "SELECT COUNT(score) AS t_points FROM demoscore WHERE project='$_POST[pid]' AND question='$myrow2[id]' AND score='$rawend[$i]'"; 
$result8 = mysql_query($sql8) or die(mysql_error()); 
$it = mysql_fetch_array($result8);

$sql9 = "SELECT COUNT(DISTINCT user) AS ut_points FROM demoscore WHERE project='$_POST[pid]' AND question='$myrow2[id]'"; 
$result9 = mysql_query($sql9) or die(mysql_error()); 
$itu = mysql_fetch_array($result9);

?>
<tr>
<td><?php printf("%s",$rawend[$i]); ?></td>
<td align="center"><?php printf("%s",$it[t_points]); ?></td>
<?php
if($itu[ut_points]!='0'){

?>
<td align="center"><?php printf("%s%%",number_format(($it[t_points]/$itu[ut_points])*100, 0, '.', '')); ?></td>
<?php
}else{
?>
<td align="center">0%</td>
<?php
}
?>
</tr>
<?php
}
?>
</table>
<p></p>
<?php

} while ($myrow2 = mysql_fetch_array($result2));
	
} else {}

mysql_close($con);
?>
</form>
</fieldset>
</body>
</html>
