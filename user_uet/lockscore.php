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
<legend>User Experience Test -> User -> Lock/Unlock User</legend>
<form name="form1" action="lockscore.php" method="POST" onsubmit="return doCheck()">
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
<input type="submit" name="submit" value="GO">
</td> 
</tr>
</table>
</form>

<?php
if($_POST[pid] !=""){
?>
<p><b><u><?php printf("%s",$_POST[pid]); ?></b></u></p>
<div id="demo">
<table cellpadding="0" cellspacing="0" border="1" bordercolor="black" class="display" id="example">
	<thead>
		<tr align="left">
			<th>Username</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
require("../library/connection.php");

$sql = "SELECT * FROM user WHERE project='$_POST[pid]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

?>
	<tr>
	<td><?php printf("%s",$myrow["user"]); ?></td>
	<td><?php printf("%s",$myrow["security"]); ?></td>
<td style="width:40mm"><a href="locktable.php?prop_id=<?php printf("%s",$_POST[pid]); ?>&prop_un=<?php printf("%s",$myrow[user]); ?>" target="home">Lock</a> |
<a href="unlocktable.php?prop_id=<?php printf("%s",$_POST[pid]); ?>&prop_un=<?php printf("%s",$myrow[user]); ?>" target="home">Unlock</a>
</td>
	</tr>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {

}}
?>		
</table>
</div>
</fieldset>
</body>
</html>