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
<legend>User Experience Test -> Efficiency -> Assign Question</legend>
<script>
    function doCheck1(){
        if(document.form.pid.value==""){
        alert("Please select a project name!");
        return false;
        }
    }
</script>
<form name="form" action="assignefficiency.php" method="POST"" onsubmit="return doCheck1()">
<p></p>
<table border="1" width="70%" bordercolor="black" cellspacing="0" cellpadding="0">
<?php
require("../library/connection.php");

$sql = "SELECT * FROM efficiency ORDER BY no ASC";
$result = mysql_query($sql,$con);
	?>
	<tr><td align="center"><b>Selection</b></td><td><b>Question</b></td></tr>
<?php
if ($myrow = mysql_fetch_array($result)){
do {

$string = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["question"]);
$string = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string));

	?><tr><td align="center" width="90"><input type="checkbox" name="<?php printf("%s",$myrow["no"]); ?>" value="<?php printf("%s",$myrow["no"]); ?>"></td><?php
	?><td><?php printf("%s",$string); ?></td><?php
} while ($myrow = mysql_fetch_array($result));
	
} else {
	 
}

?>
</tr>
	</table>
<p></p>
<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php

$sql = "SELECT DISTINCT name FROM project WHERE security='unlock' AND method_type='UET' AND type='manual' ORDER BY name ASC";
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
<tr>
<td><br/></td>
<td> </td>
</tr>
<tr>
<td align="center" colspan="2"><input type="submit" name="submit" value="ASSIGN"><td> 
</tr>
</table>
</form>

</fieldset>

<?php

if ($_POST["submit"]){

require("../library/connection.php");

$sql = "SELECT * FROM efficiency ORDER BY no ASC";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

$language = $myrow["no"];
if(isset($_POST[$language]))
{

$sql1="INSERT INTO assignefficiency (no,project)
VALUES
('$language','$_POST[pid]')";

if (!mysql_query($sql1,$con))
  {
?>
<script type="text/javascript">
alert("Error: <?php echo mysql_error() ?>");
</script>
<?php
die();
  }
}


} while ($myrow = mysql_fetch_array($result));
	
} else {
	 
}

mysql_close($con);

?>
<script type="text/javascript">
alert("Question has been assigned successfully to '<?php echo $_POST[pid] ?>' project!");
</script>
<?php

}
?>
</body>
</html>
