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
<fieldset>
<legend>User Experience Test -> Satisfaction -> Assign Question</legend>
<script>
    function doCheck1(){
        if(document.form.pid.value==""){
        alert("Please select a project name!");
        return false;
        }
        if(document.form.taskid.value==""){
        alert("Please select a task number!");
        return false;
        }
    }
</script>
<form name="form" action="assignquestion.php" method="POST" onsubmit="return doCheck1()">
<?php
require("../library/connection.php");

$counter=1;
$sql2 = "SELECT category FROM scategory";
$result2 = mysql_query($sql2,$con);

if ($myrow2 = mysql_fetch_array($result2)){
do {

$sql = "SELECT * FROM satisfaction WHERE category='$myrow2[category]'";
$result = mysql_query($sql,$con);


if ($myrow = mysql_fetch_array($result)){

	?>
	<p><b>Category <?php printf("%d",$counter); ?>: <?php printf("%s",$myrow2["category"]); ?></b>
	<table border="1" width="80%" bordercolor="black" cellspacing="0" cellpadding="0">
	<tr><td align="center"><b>Selection</b></td><td><b>Question</b></td></tr>
<?php
$counter++;
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
</table></p>
</p></p>
<?php

} while ($myrow2 = mysql_fetch_array($result2));
	
} else {
	 
}

mysql_close($con);
?>

<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");
$sql = "SELECT name FROM project WHERE security='unlock' AND method_type='UET' ORDER BY name ASC";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

?>
	<option value="<?php printf("%s",$myrow["name"]); ?>"><?php printf("%s",$myrow["name"]); ?></option>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {
	echo "<p>No information.</p>";  
}

mysql_close($con);
?>
<tr>
<td>Task No</td>
<td>:<input type="checkbox" name="t1" value="1">1
<input type="checkbox" name="t2" value="2">2
<input type="checkbox" name="t3" value="3">3
<input type="checkbox" name="t4" value="4">4
<input type="checkbox" name="t5" value="5">5
<input type="checkbox" name="t6" value="6">6
<input type="checkbox" name="t7" value="7">7
<input type="checkbox" name="t8" value="8">8
<input type="checkbox" name="t9" value="9">9
<input type="checkbox" name="t10" value="10">10
<input type="checkbox" name="t11" value="11">11
<input type="checkbox" name="t12" value="12">12
<input type="checkbox" name="t13" value="13">13
<input type="checkbox" name="t14" value="14">14
<input type="checkbox" name="t15" value="15">15
</td>
</tr>
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

$sql = "SELECT * FROM satisfaction";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

$language = $myrow["no"];
if(isset($_POST[$language]))
{

for($i=1;$i<=15;$i++){

$asn=t.$i;

if(isset($_POST[$asn])){

$sql1="INSERT INTO assignsatis (no,project,task)
VALUES
('$language','$_POST[pid]','$_POST[$asn]')";

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

}

}

} while ($myrow = mysql_fetch_array($result));
	
} else {
	 
}

?>
<script type="text/javascript">
alert("Question has been assigned successfully!");
</script>
<?php 

mysql_close($con);

}
?>

</body>
</html>
