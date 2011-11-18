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
<legend>User -> Modify/Delete UMS Account</legend>

<p></p>		
<div id="demo">
<table cellpadding="0" cellspacing="0" border="1" class="display" id="example">
	<thead>
		<tr align="left">
			<th>No</th>
			<th>Name</th>
			<th>Email</th>
			<th>Role</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
require("../library/connection.php");

$sql = "SELECT * FROM users ORDER BY role ASC";
$result = mysql_query($sql,$con);

$no=1;

if ($myrow = mysql_fetch_array($result)){
do {
?>
	<tr>
	<td><?php printf("%s",$no); $no++;?></td>
	<td><?php printf("%s",$myrow["name"]); ?></td>
	<td><?php printf("%s",$myrow["email"]); ?></td>
	<td><?php printf("%s",$myrow["role"]); ?></td>
	<td style="width:40mm"><a href="mtable.php?prop_id=<?php printf("%s",$myrow["id"]); ?>" target="home">Edit</a> |
<a href="dtable.php?prop_id=<?php printf("%s",$myrow["id"]); ?>" target="home">Delete</a>
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