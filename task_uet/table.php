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
<body id="dt_example">
<fieldset>
<legend>User Experience Test -> Task -> Modify/Delete Task</legend>
<?php
if($_POST[pid] ==""){
?>
<p></p>
<form name="form1" action="table.php" method="POST" onsubmit="return docheck1()">
<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");

$sql = "SELECT DISTINCT PName FROM task";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

?>
	<option value="<?php printf("%s",$myrow["PName"]); ?>"><?php printf("%s",$myrow["PName"]); ?></option>
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
}
if($_POST[pid] !=""){
?>		
<p><b>Project : <?php printf("%s",$_POST[pid]); ?></b></p>
			<div id="demo">
<table cellpadding="0" cellspacing="0" border="1" class="display" id="example">
	<thead>
		<tr align="left">
			<th>Task No</th>
			<th>Scenario</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
require("../library/connection.php");

$sql = "SELECT * FROM task WHERE PName='$_POST[pid]' ORDER BY no ASC";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {
$string1 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["question"]);
$string1 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string1));
?>
	<tr>
	<td><?php printf("%s",$myrow["no"]); ?></td>
	<td><?php printf("%s",$string1); ?></td>
	<td><a href="mtable.php?prop_id=<?php printf("%s",$myrow["no"]); ?>&pj_id=<?php printf("%s",$_POST["pid"]); ?>" target="home">Edit</a> |
<a href="dtable.php?prop_id=<?php printf("%s",$myrow["no"]); ?>&pj_id=<?php printf("%s",$_POST["pid"]); ?>" target="home">Delete</a></td>
	</tr>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {

}
?>		
</table>
						
		</div>
<?php
}
?>
</fieldset>
</body>
</html>