<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Mouse Click -> Set Mouse Click</legend>
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
<form name="form1" action="addmouseclickanswer.php" method="POST" onsubmit="return doCheck()">
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

$sql = "SELECT DISTINCT project FROM user WHERE mouseclick='No' AND security='unlock' AND project='$myrow1[name]'";
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


<form name="form2" action="addmouseclickanswer.php" method="POST" onsubmit="return doCheck2()">

<tr>
<td>Username</td>
<td>: <select name="pin" style="width:60mm">
<option value=""> - SELECT USERNAME -</option>
<?php
require("../library/connection.php");
$sql = "SELECT DISTINCT user FROM user WHERE mouseclick='No' AND security='unlock' AND project='$_POST[pid]'";
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
<input type="submit" name="submit" value="CREATE">
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
<form name="form" action="addmouseclickanswer.php" method="POST">
<table border="1" width="37%" bordercolor="black" cellspacing="0" cellpadding="0">
<?php

$sql = "SELECT * FROM task WHERE PName='$_POST[pj]' ORDER BY CAST(no AS UNSIGNED) ASC";
$result = mysql_query($sql,$con);
	?><p><b><u><?php printf("%s",$_POST[pj]);?></b></u><br/>
	<b>Username : <?php printf("%s",strtoupper($_POST[pin]));?></b></p>
<?php
if ($myrow = mysql_fetch_array($result)){
do {

	?><tr style="background-color:#C0C0C0"><td align="center"><b>Task<?php printf("%s",$myrow["no"]); ?></b></td>
	<td>Start = <input type="text" maxlength="4" onKeyPress="return numbersonly(this, event)" name="<?php printf("%s",$myrow["no"]); ?>"style="width:25mm" value="0"></td>
	<td>End = <input type="text" maxlength="4" onKeyPress="return numbersonly(this, event)" name="<?php printf("a%s%s",$myrow["no"],$myrow["no"]); ?>"style="width:25mm" value=""></td>
	</tr>

<?php

} while ($myrow = mysql_fetch_array($result));
	
} else {}

?>
</table>
<p></p>
<table width="60%">
<tr><td><input type="hidden" name="project" value="<?php printf("%s",$_POST[pj]);?>"</td>
<td><input type="hidden" name="username" value="<?php printf("%s",$_POST[pin]);?>"</td></tr>
<tr>
<td> &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp; <input type="submit" name="submitend" value="SUBMIT"><td> 
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

$mgetend = "a".$myrow["no"].$myrow["no"];
$mend = $_POST["$mgetend"];
$mgetstart = $myrow["no"];
$mstart = $_POST["$mgetstart"];
$MyName = $mend-$mstart;
$sql2="INSERT INTO answermouseclick (project,name,task,answer)
VALUES
('$_POST[project]','$_POST[username]','$myrow[no]','$MyName')";

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

$sql="UPDATE user SET mouseclick='Yes' WHERE user='$_POST[username]'";

if (!mysql_query($sql,$con))
  {
?>
<script type="text/javascript">
alert("Error: <?php echo mysql_error() ?>");
</script>
<?php
die();
  }

?>
<script type="text/javascript">
alert("For project '<?php echo $_POST[project] ?>', username '<?php echo $_POST[username] ?>' answer has been added successfully!");
</script>
<?php 

mysql_close($con);


}
?>
