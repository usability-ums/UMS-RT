<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Effectiveness -> Modify User Score</legend>
<script>
    function doCheck(){
        if(document.form1.pid.value==""){
        alert("Please select a project name!");
        return false;
        }
	}
    function doCheck2(){
        if(document.form2.pin.value==""){
        alert("Please select a username!");
        return false;
        }
    }
</script>
<form name="form1" action="modifyeffectivenessanswer.php" method="POST" onsubmit="return doCheck()">
<p></p>
<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");

$sql1 = "SELECT DISTINCT name FROM project WHERE type='manual' ORDER BY name ASC";
$result1 = mysql_query($sql1,$con);

if ($myrow1 = mysql_fetch_array($result1)){
do {

$sql = "SELECT DISTINCT project FROM user WHERE effectiveness='Yes' AND security='unlock' AND project='$myrow1[name]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

if($_POST[pid] ==$myrow[project]){
?>
	<option value="<?php printf("%s",$myrow["project"]); ?>" selected><?php printf("%s",$myrow["project"]); ?></option>
<?php
}else{
?>
	<option value="<?php printf("%s",$myrow["project"]); ?>"><?php printf("%s",$myrow["project"]); ?></option>
<?php
}
} while ($myrow = mysql_fetch_array($result));

} else {

}

} while ($myrow1 = mysql_fetch_array($result1));

} else {

}

mysql_close($con);
?>

</select>
</td>
<td>
<input type="submit" name="submit" value="GO">
</td> 
</tr>
</form>
<?php
if($_POST[pid] !=""){
?>
<form name="form2" action="modifyeffectivenessanswer.php" method="POST" onsubmit="return doCheck2()">
<tr>
<td>Username</td>
<td>: <select name="pin" style="width:60mm">
<option value=""> - SELECT USERNAME -</option>
<?php
require("../library/connection.php");

$sql = "SELECT DISTINCT user FROM user WHERE effectiveness='Yes' AND security='unlock' AND project='$_POST[pid]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

?>
	<option value="<?php printf("%s",$myrow["user"]); ?>"><?php printf("%s",$myrow["user"]); ?></option>
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
<td><input type="hidden" name="pj" value="<?php printf("%s",$_POST["pid"]); ?>"</td>
</tr>

</form>
<?php
}
?>
</table>
<p></p>
<?php
if($_POST[pj] !=""){
require("../library/connection.php");

?>
<form name="form" action="modifyeffectivenessanswer.php" method="POST">
<table border="1" width="80%" bordercolor="black" cellspacing="0" cellpadding="0">
<?php

$sql = "SELECT * FROM task WHERE PName='$_POST[pj]' ORDER BY CAST(no AS UNSIGNED) ASC";
$result = mysql_query($sql,$con);
	?><p><b><u><?php printf("%s",$_POST[pj]);?></b></u><br/>
	<b>Username : <?php printf("%s",strtoupper($_POST[pin]));?></b></p>
<?php
if ($myrow = mysql_fetch_array($result)){
do {

$string = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["question"]);
$string = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string));


	?><tr style="background-color:#C0C0C0"><td align="center" style="width:22mm"><b>Task<?php printf("%s",$myrow["no"]); ?></b></td>
	<td><b><?php printf("%s",$string); ?></b></td>
	<td align="center" style="width:22mm"><b>User 1</b></td></tr><?php

$sql7 = "SELECT * FROM assigneffectiveness WHERE project='$_POST[pj]'";
$result7 = mysql_query($sql7,$con);

if ($myrow7 = mysql_fetch_array($result7)){
do {

$sql1 = "SELECT * FROM effectiveness WHERE no='$myrow7[no]' ORDER BY CAST(no AS UNSIGNED) ASC";
$result1 = mysql_query($sql1,$con);
if ($myrow1 = mysql_fetch_array($result1)){

$string1 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow1["question"]);
$string1 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string1));

	?>
	<tr><td></td><td><?php printf("%s",$string1); ?></td>
	<td><select name="<?php printf("%s",$myrow["no"]); ?><?php printf("%s",$myrow1["no"]); ?>" style="width:22mm">


<?php

$sql2 = "SELECT * FROM answereffectiveness WHERE project='$_POST[pj]' AND name='$_POST[pin]' AND task='$myrow[no]' AND no='$myrow1[no]'";
$result2 = mysql_query($sql2,$con);
if ($myrow2 = mysql_fetch_array($result2)){
do {

if($myrow2[answer] =="-"){
?>

	<option selected="true" value="-">&nbsp; &nbsp; &nbsp; &nbsp; -</option>
	<option value="Yes"> &nbsp; &nbsp; &nbsp; YES</option>
	<option value="Partial">PARTIAL</option>
	<option value="No"> &nbsp; &nbsp; &nbsp; NO</option></select></td></tr>

<?php
}else if($myrow2[answer] =="Yes"){
?>
	<option value="-">&nbsp; &nbsp; &nbsp; &nbsp; -</option>
	<option selected="true" value="Yes"> &nbsp; &nbsp; &nbsp; YES</option>
	<option value="Partial">PARTIAL</option>
	<option value="No"> &nbsp; &nbsp; &nbsp; NO</option></select></td></tr>

<?php
}else if($myrow2[answer] =="No"){
?>
	<option selected="true" value="-">&nbsp; &nbsp; &nbsp; &nbsp; -</option>
	<option value="Yes"> &nbsp; &nbsp; &nbsp; YES</option>
	<option value="Partial">PARTIAL</option>
	<option selected="true" value="No"> &nbsp; &nbsp; &nbsp; NO</option></select></td></tr>

<?php
}else if($myrow2[answer] =="Partial"){
?>
	<option value="-">&nbsp; &nbsp; &nbsp; &nbsp; -</option>
	<option value="Yes"> &nbsp; &nbsp; &nbsp; YES</option>
	<option selected="true" value="Partial">PARTIAL</option>
	<option value="No"> &nbsp; &nbsp; &nbsp; NO</option></select></td></tr>

<?php
}

} while ($myrow2 = mysql_fetch_array($result2));

} else {}

}else{}
} while ($myrow7 = mysql_fetch_array($result7));

} else {
}

} while ($myrow = mysql_fetch_array($result));
	
} else {}

?>
</table>
<p></p>
<table width="60%">
<tr><td><input type="hidden" name="project" value="<?php printf("%s",$_POST[pj]);?>"</td>
<td><input type="hidden" name="username" value="<?php printf("%s",$_POST[pin]);?>"</td></tr>
<tr>
<td align="center"><input type="submit" name="submitend" value="UPDATE"><td> 
</tr>
</table>
</form>
<?php
mysql_close($con);
}else{}
?>
</fieldset>

<?php
if ($_POST["submitend"]){

require("../library/connection.php");

$sql = "SELECT * FROM task WHERE PName='$_POST[project]' ORDER BY CAST(no AS UNSIGNED) ASC";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

$sql1 = "SELECT * FROM assigneffectiveness WHERE project='$_POST[project]' ORDER BY CAST(no AS UNSIGNED) ASC";
$result1 = mysql_query($sql1,$con);

if ($myrow1 = mysql_fetch_array($result1)){
do {
$MyName = $myrow["no"] . $myrow1["no"];
$sql2="UPDATE answereffectiveness SET answer='$_POST[$MyName]' WHERE project='$_POST[project]' AND name='$_POST[username]' AND task='$myrow[no]' AND no='$myrow1[no]'";

if (!mysql_query($sql2,$con))
  {
?>
<script type="text/javascript">
alert("Error: <?php echo mysql_error() ?>");
</script>
<?php
die();
  }

} while ($myrow1 = mysql_fetch_array($result1));

} else {}

} while ($myrow = mysql_fetch_array($result));
	
} else {}

?>
<script type="text/javascript">
alert("For project '<?php echo $_POST[project] ?>', '<?php echo $_POST[username] ?>' effectiveness score has been modified successfully!");
document.location.href='modifyeffectivenessanswer.php'
</script>
<?php

mysql_close($con);

}
?>
</body>
</html>
