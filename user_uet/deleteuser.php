<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<head>
		<style type="text/css" title="currentStyle">
			@import "../style/demo_table.css";
		</style>
		<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			jQuery.fn.dataTableExt.aTypes.push(
				function ( sData ) {
					return 'html';
				}
			);
			
			$(document).ready(function() {
				$('#example').dataTable();
			} );
		</script>
</head>
<body>
<script>
    function doCheck(){
        if(document.form1.pid.value==""){
        alert("Please select a project name!");
        return false;
        }
    }
</script>
<fieldset>
<legend>User Experience Test -> User -> Delete User</legend>
<form name="form1" action="deleteuser.php" method="POST" onsubmit="return doCheck()">
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
<input type="submit" name="submit" value="GO">
</td> 
</tr>
</table>
<?php
if($_POST["pid"] !=""){
?>
<p><b><u><?php printf("%s",$_POST[pid]); ?></b></u></p>
<div id="demo">
<table cellpadding="0" cellspacing="0" border="1" bordercolor="black" class="display" id="example">
	<thead>
		<tr align="left">
			<th>No</th>
			<th>Username</th>
		</tr>
	</thead>
	<tbody>
<?php
require("../library/connection.php");

$sql = "SELECT * FROM user WHERE project='$_POST[pid]'";
$result = mysql_query($sql,$con);
$count=1;
if ($myrow = mysql_fetch_array($result)){
do {

?>
	<tr>
	<td><?php printf("%s",$count);$count++; ?></td>
	<td><?php printf("%s",$myrow["user"]); ?></td>
	</tr>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {
	echo "No information."; 
}
?>		
</table>
</div>
</form>
</fieldset>

<script>
    function doCheck1(){
        if(document.form.taskid.value==""){
        alert("Please select a user name!");
        return false;
        }
        if(document.form.id.value==""){
        alert("Please enter the security code!");
        return false;
        }
	if(document.form.id.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at security code input field.");
        return false;	
	}
        if(document.form.id.value!="Administrator"){
        alert("Incorrect security code!");
        return false;
        }
    }
</script>
<fieldset>
<form name="form" action="deleteuser.php" method="POST" onsubmit="return doCheck1()">
<table>
<tr>
<td>Username</td>
<td>: <select name="taskid" style="width:80mm">
<option value=""> - SELECT USERNAME -</option>
<?php

$sql = "SELECT DISTINCT user FROM user WHERE project='$_POST[pid]' ORDER BY user ASC";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

?>
	<option value="<?php printf("%s",$myrow["user"]); ?>"><?php printf("%s",$myrow["user"]); ?></option>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {

}

?>
</td>
</tr>
<tr>
<td>Security Code</td>
<td>: <input type="password" style="width:80mm" name="id" value=""></td>
</tr>
<tr>
<td><br/></td>
<td><input type="hidden" name="pj" value="<?php printf("%s",$_POST["pid"]); ?>"</td>
</tr>
<tr>
<td align="center" colspan="2"><input type="submit" name="submitend" onClick="return confirm('Are you sure you want to delete this user?\nAll data related to this user will be deleted!')" value="DELETE"><td> 
</tr>
</table>
</form>

</fieldset>
<?php	
	echo "<p style=\"font-size:15pt;color:red\"><b>WARNING!<br/>All data for this user will be deleted!</b><br/></p>";	
}else{}
?>
</body>
</html>

<?php

if ($_POST["submitend"]){

require("../library/connection.php");

$sql1 = "SELECT * FROM user WHERE user='$_POST[taskid]' AND project='$_POST[pj]'";
$result1 = mysql_query($sql1,$con);

if ($myrow1 = mysql_fetch_array($result1)){
do {

$sql="DELETE FROM user WHERE user='$_POST[taskid]' AND project='$_POST[pj]'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

$sql="DELETE FROM thinkaloud WHERE user='$_POST[taskid]' AND PName='$_POST[pj]'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

$sql="DELETE FROM score WHERE user='$_POST[taskid]' AND project='$_POST[pj]'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

$sql="DELETE FROM demoscore WHERE user='$_POST[taskid]' AND project='$_POST[pj]'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

$sql="DELETE FROM debriefingscore WHERE user='$_POST[taskid]' AND project='$_POST[pj]'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

$sql="DELETE FROM time WHERE user='$_POST[taskid]' AND project='$_POST[pj]'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

$sql="DELETE FROM answereffectiveness WHERE name='$_POST[taskid]' AND project='$_POST[pj]'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

$sql="DELETE FROM answerefficiency WHERE name='$_POST[taskid]' AND project='$_POST[pj]'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

$sql="DELETE FROM debriefingc WHERE user='$_POST[taskid]' AND project='$_POST[pj]'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

$sql="DELETE FROM answermouseclick WHERE name='$_POST[taskid]' AND project='$_POST[pj]'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

$sql="DELETE FROM a_question WHERE name='$_POST[taskid]' AND project='$_POST[pj]'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

?>
<script type="text/javascript">
alert("All data for username '<?php echo $_POST[taskid] ?>' from '<?php echo $_POST[pj] ?>'project has been deleted successfully!");
</script>
<?php

} while ($myrow1 = mysql_fetch_array($result1));

} else {

?>
<script type="text/javascript">
alert("Username '<?php echo $_POST[taskid] ?>' for '<?php echo $_POST[pj] ?>' project does not exist!");
</script>
<?php

}

mysql_close($con);
}

?>