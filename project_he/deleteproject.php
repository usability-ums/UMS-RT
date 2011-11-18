<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>Heuristic Evaluation -> Project -> Delete HE Project</legend>
<p></p>
<script>
    function docheck(){
        if(document.form.id.value==""){
        alert("Please select a project name!");
        return false;
        }
	if(document.form.soid.value==""){
        alert("Please enter the security code!");
        return false;
        }
	if(document.form.soid.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at security code input field.");
        return false;	
	}
        if(document.form.soid.value!="Administrator"){
        alert("Incorrect security code!");
        return false;
        }
    }
</script>
<form name="form" action="deleteproject.php" method="POST" onsubmit="return docheck()">
<table>
<tr>
<td>Project Name</td><td> :
<select name="id" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");
$sql = "SELECT name FROM project WHERE method_type='HE' ORDER BY name ASC";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){
do {
?>
	<option value="<?php printf("%s",$myrow["name"]); ?>"><?php printf("%s",$myrow["name"]); ?></option>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {
	echo "No information."; 
}
mysql_close($con);
?>
</select>
</td>
</tr>
<tr>
<td>Security Code</td>
<td>: <input type="password" style="width:60mm" name="soid" value=""></td>
</tr>
<tr>
<tr><td><br/></td><td></td></tr>
<tr>
<td></td>
<td style="padding-left:20px"><input type="submit" name="submit" onClick="return confirm('Are you sure you want to delete this project?')" value="DELETE"><td> 
</tr>
</table>
</form>

</fieldset>
<?php	
	echo "<p style=\"font-size:15pt;color:red\"><b>WARNING!<br/> All data for this project will be deleted!</b><br/></p>";
	
?>
</body>
</html>

<?php

if ($_POST['submit']){

require("../library/connection.php");

$sql="DELETE FROM project WHERE name='$_POST[id]' AND method_type='HE'";

if (!mysql_query($sql,$con))
  {
  ?>
  <script type="text/javascript">
  alert("Error: <?php echo mysql_error() ?>");
  </script>
  <?php
  die();
  }

$sql="DELETE FROM defect WHERE project='$_POST[id]' AND testingtype='HE'";

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
alert("All data of the HE project name '<?php echo $_POST[id] ?>' has been deleted successfully!");
document.location.href='deleteproject.php'
</script>
<?php

mysql_close($con);

}
?>
