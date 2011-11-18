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
<legend>User Experience Test -> Demographic -> Remove Assign Question</legend>
<?php
if($_POST[pid] ==""){
?>
<p></p>
<form name="form1" action="unassigndemographic.php" method="POST" onsubmit="return docheck1()">
<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");

$sql = "SELECT DISTINCT project FROM assigndemo";
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
}
if($_POST[pid] !=""){
?>		
<p><b>Project : <?php printf("%s",$_POST[pid]); ?></b></p>
			<div id="demo">
<table cellpadding="0" cellspacing="0" border="1" class="display" id="example">
	<thead>
		<tr align="left">
			<th>No</th>
			<th>Question</th>
			<th>Answer</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
require("../library/connection.php");

$no=1;

$sql = "SELECT * FROM assigndemo WHERE project='$_POST[pid]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

$sql1 = "SELECT * FROM demographic WHERE id='$myrow[id]'";
$result1 = mysql_query($sql1,$con);
if ($myrow1 = mysql_fetch_array($result1)){

$string1 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow1["question"]);
$string1 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string1));
$string2 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow1["answer"]);
$string2 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string2));
}
?>
	<tr>
	<td><?php printf("%s",$no); $no++;?></td>
	<td><?php printf("%s",$string1); ?></td>
	<td><?php printf("%s",$string2); ?></td>
	<td><a href="unassigntable.php?prop_id=<?php printf("%s",$myrow["id"]); ?>&pj_id=<?php printf("%s",$_POST["pid"]); ?>" target="home">Unassign</a></td>
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