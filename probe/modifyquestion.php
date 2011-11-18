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
<legend>User Experience Test -> Probe Question -> Modify/Delete Question</legend>
<?php
if($_POST[pid] ==""){
?>
<p></p>
<form name="form1" action="modifyquestion.php" method="POST">
<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");

$sql = "SELECT DISTINCT title FROM p_question";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

?>
	<option value="<?php printf("%s",$myrow["title"]); ?>"><?php printf("%s",$myrow["title"]); ?></option>
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
<p><b>Survey : <?php printf("%s",$_POST[pid]); ?></b></p>
			<div id="demo">
<table cellpadding="0" cellspacing="0" border="1" class="display" id="example">
	<thead>
		<tr align="left">
			<th>No</th>
			<th>Task</th>
			<th>Question</th>
			<th>Type</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
require("../library/connection.php");

$sql = "SELECT * FROM p_question WHERE title='$_POST[pid]'";
$result = mysql_query($sql,$con);

$no=1;

if ($myrow = mysql_fetch_array($result)){
do {
$string1 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["question"]);
$string1 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string1));
?>
	<tr>
	<td><?php printf("%s",$no); $no++;?></td>
	<td><?php printf("%s",$myrow["task"]); ?></td>
	<td><?php printf("%s",$string1); ?></td>
	<td><?php printf("%s",$myrow["type"]); ?></td>
	<td><a href="mtable.php?prop_id=<?php printf("%s",$myrow["id"]); ?>" target="home">Edit</a> |
<a href="dtable.php?prop_id=<?php printf("%s",$myrow["id"]); ?>" target="home">Delete</a>
</td>
	</tr>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {
	echo "No information."; 
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