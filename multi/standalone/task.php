<?php
if($_COOKIE["pj"]==NULL){
?>
<script type="text/javascript">document.location.href='login.php'</script>
<?php
}
?>
<html>
<link href="../../style/multistyle.css" rel="stylesheet" type="text/css"/>
<?php
require("header.php");
?>
<body>
<div id="main">
<div id="logo">
<div id="head">
</div>
<div id="content">
<p>
<?php
$number=$_COOKIE[tn];
require("../../library/connection.php");

$result = mysql_query("SELECT * FROM task WHERE PName='$_COOKIE[pj]'",$con);
$totalt = mysql_num_rows($result);

$sql = "SELECT * FROM task WHERE PName='$_COOKIE[pj]' AND no='$number'";
$result = mysql_query($sql,$con);

if ($myrow1 = mysql_fetch_array($result)){
do {

$string = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow1["question"]);
$string = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string));

?>
<p align="center" style="font-size:35px"><br/><br/><u><b>TASK <?php printf("%d",$number);?></b></u></p> 
<table align="center">
<tr>
<td VALIGN="top" style="font-size:25px">
<?php
echo "<p>$string</p>";
?>
</td>
</tr>
</table>
<?php
} while ($myrow1 = mysql_fetch_array($result));
	
} else {

//find if user complete debriefing
$sql3 = "SELECT question FROM debriefingc WHERE project='$_COOKIE[pj]' AND user='$_COOKIE[us]'";
$result3 = mysql_query($sql3,$con);
if ($myrow3 = mysql_fetch_array($result3)){
?>

<script type="text/javascript">
document.location.href='finish.php'
</script>
<?php

}else{
?>
<script type="text/javascript">
document.location.href='debriefing.php'
</script>
<?php
}
}
mysql_close($con);
?>
<p align="center"><br/><INPUT TYPE="BUTTON" VALUE="START TASK <?php printf("%d",$number);?>" ONCLICK="window.location.href='web.php'"></p>
</p>
<p align="center">~ Your current progress is <b><?php printf("%s%%</b>, you have completed %s task out of %s ~",number_format(5+((90/$totalt)*($_COOKIE[tn]-1)), 0, '.', ''),$_COOKIE[tn]-1,$totalt);?></p>
</div>
<?php
require("footer.php");
?>
</body>
</html>