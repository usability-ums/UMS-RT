<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Mouse Click -> Modify Mouse Click</legend>
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
<form name="form1" action="modifymouseclickanswer.php" method="POST" onsubmit="return doCheck()">
<p></p>
<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");

$sql1 = "SELECT DISTINCT name FROM project WHERE type='manual'";
$result1 = mysql_query($sql1,$con);

if ($myrow1 = mysql_fetch_array($result1)){
do {

$sql = "SELECT DISTINCT project FROM user WHERE mouseclick='Yes' AND security='unlock' AND project='$myrow1[name]'";
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
<form name="form2" action="modifymouseclickanswer.php" method="POST" onsubmit="return doCheck2()">
<tr>
<td>Username</td>
<td>: <select name="pin" style="width:60mm">
<option value=""> - SELECT USERNAME -</option>
<?php
require("../library/connection.php");
$sql = "SELECT DISTINCT user FROM user WHERE mouseclick='Yes' AND security='unlock' AND project='$_POST[pid]'";
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
require("../library/numberonly.php");
?>
<form name="form" action="modifymouseclickanswer.php" method="POST">
<table border="1" width="25%" bordercolor="black" cellspacing="0" cellpadding="0">
<?php

$sql = "SELECT * FROM task WHERE PName='$_POST[pj]' ORDER BY CAST(no AS UNSIGNED) ASC";
$result = mysql_query($sql,$con);
	?><p><b><u><?php printf("%s",$_POST[pj]);?></b></u><br/>
	<b>Username : <?php printf("%s",strtoupper($_POST[pin]));?></b></p>
<?php
if ($myrow = mysql_fetch_array($result)){
do {

$sql2 = "SELECT * FROM answermouseclick WHERE project='$_POST[pj]' AND name='$_POST[pin]' AND task='$myrow[no]'";
$result2 = mysql_query($sql2,$con);
if ($myrow2 = mysql_fetch_array($result2)){
do {

	?><tr style="background-color:#C0C0C0"><td align="center"><b>Task<?php printf("%s",$myrow["no"]); ?></b></td>
	<td>Mouse Click = <input type="text" onKeyPress="return numbersonly(this, event)" name="<?php printf("%s",$myrow["no"]); ?>" style="width:20mm" value="<?php printf("%s",$myrow2[answer]);?>"></td></tr>

<?php
} while ($myrow2 = mysql_fetch_array($result2));

} else {}

} while ($myrow = mysql_fetch_array($result));
	
} else {}

?>
</table>
<p></p>
<table width="60%">
<tr><td><input type="hidden" name="project" value="<?php printf("%s",$_POST[pj]);?>"</td>
<td><input type="hidden" name="username" value="<?php printf("%s",$_POST[pin]);?>"</td></tr>
<tr>
<td> &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp; <input type="submit" name="submitend" value="UPDATE"><td> 
</tr>
</table>
</form>
<?php
mysql_close($con);
}else{}
?>
</fieldset>
</body>
</html>

<?php

if ($_POST["submitend"]){

require("../library/connection.php");

$sql = "SELECT * FROM task WHERE PName='$_POST[project]' ORDER BY CAST(no AS UNSIGNED) ASC";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

$MyName = $myrow["no"];
$sql2="UPDATE answermouseclick SET answer='$_POST[$MyName]' WHERE project='$_POST[project]' AND name='$_POST[username]' AND task='$myrow[no]'";

if (!mysql_query($sql2,$con))
  {
?>
<script type="text/javascript">
alert("Error: <?php echo mysql_error() ?>");
</script>
<?php
die();
  }

} while ($myrow = mysql_fetch_array($result));
	
} else {}

?>
<script type="text/javascript">
alert("For project '<?php echo $_POST[project] ?>', username '<?php echo $_POST[username] ?>' answer has been modified successfully!");
</script>
<?php

mysql_close($con);


}
?>
