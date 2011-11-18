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
        if(document.form.id.value==""){
        alert("Please select a project name!");
        return false;
        }
        if(document.form.id1.value==""){
        alert("Please select the status!");
        return false;
        }
    }
</script>
<fieldset>
<legend>User Experience Test -> Project -> Lock/Unlock Project</legend>
<p></p>
<div id="demo">
<table cellpadding="0" cellspacing="0" border="1" bordercolor="black" class="display" id="example">
	<thead>
		<tr align="left">
			<th>Project Name</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
require("../library/connection.php");

$sql = "SELECT name,security FROM project WHERE method_type='UET'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

?>
	<tr>
	<td><?php printf("%s",$myrow["name"]); ?></td>
	<td><?php printf("%s",$myrow["security"]); ?></td>
	<td style="width:40mm"><a href="locktable.php?prop_id=<?php printf("%s",$myrow["name"]); ?>" target="home">Lock</a> |
<a href="unlocktable.php?prop_id=<?php printf("%s",$myrow["name"]); ?>" target="home">Unlock</a>
</td>
	</tr>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {

}
?>		
</table>
</div>
</fieldset>
</body>
</html>
