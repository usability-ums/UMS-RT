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
<legend>User Experience Test -> Efficiency -> Modify/Delete Question</legend>

<p></p>		
<div id="demo">
<table cellpadding="0" cellspacing="0" border="1" class="display" id="example">
	<thead>
		<tr align="left">
			<th>No</th>
			<th>Question</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
require("../library/connection.php");

$sql = "SELECT * FROM efficiency ORDER BY no ASC";
$result = mysql_query($sql,$con);

$no=1;

if ($myrow = mysql_fetch_array($result)){
do {
$string1 = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["question"]);
$string1 = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string1));
?>
	<tr>
	<td><?php printf("%s",$no); $no++;?></td>
	<td><?php printf("%s",$string1); ?></td>
	<td style="width:40mm"><a href="mtable.php?prop_id=<?php printf("%s",$myrow["no"]); ?>" target="home">Edit</a> |
<a href="dtable.php?prop_id=<?php printf("%s",$myrow["no"]); ?>" target="home">Delete</a>
</td>
	</tr>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {

}
?>		
</table>
						
</div>
<?php

?>
</fieldset>
</body>
</html>