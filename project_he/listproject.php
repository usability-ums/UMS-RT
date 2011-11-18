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
<legend>Heuristic Evaluation -> Project -> List of Project</legend>
<p></p>
<div id="demo">
<table cellpadding="0" cellspacing="0" border="1" bordercolor="black" class="display" id="example">
	<thead>
		<tr align="left">
			<th>Project Name</th>
			<th>Lead</th>
			<th>Resources</th>
			<th>Date Start</th>
		</tr>
	</thead>
	<tbody>
<?php
require("../library/connection.php");

$sql = "SELECT * FROM project WHERE method_type='HE' ORDER BY date DESC";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

$string = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["resources"]);
$string = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string));

?>
	<tr>
	<td><?php printf("%s",$myrow["name"]); ?></td>
	<td><?php printf("%s",$myrow["lead"]); ?></td>
	<td><?php printf("%s",$string); ?></td>
	<td><?php printf("%s",$myrow["date"]); ?></td>
	</tr>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {

}
?>		
</table>
</div>
</fieldset>
</form>

</body>
</html>