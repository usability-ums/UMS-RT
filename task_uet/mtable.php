<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Task -> Modify Task</legend>
<p></p>
<?php
if($_GET[prop_id] !=""){
?>
<script type="text/javascript" src="../js/formfieldlimiter.js">

/***********************************************
* Form field Limiter v2.0- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com for full source code
***********************************************/

</script>
<script>
    function doCheck(){
        if(document.form.is.value==""){
        alert("Please enter the scenario!");
        return false;
        }
	if(document.form.is.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at scenario input field.");
        return false;
	}    
    }
</script>
<form name="form" action="mtable.php" method="POST" onsubmit="return doCheck()">
<table>
<tr>
<td>Task No</td>
<td>: <input type="text" style="width:60mm" name="no12" value="<?php printf("%s",$_GET[prop_id]); ?>" disabled="disabled"></td>
</tr>
<input type="hidden" name="no" value="<?php printf("%s",$_GET[prop_id]); ?>">
<tr>
<td>Project Name</td>
<td>: <input type="text" style="width:60mm" name="pno" value="<?php printf("%s",$_GET[pj_id]); ?>" disabled="disabled"></td>
</tr>
<input type="hidden" name="pno" value="<?php printf("%s",$_GET[pj_id]); ?>">
<?php
require("../library/connection.php");

$sql = "SELECT * FROM task WHERE no='$_GET[prop_id]' AND PName='$_GET[pj_id]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
?>

<tr>
<td>Scenario</td>
<td> :&nbsp;<textarea name="is" rows="4" cols="60"><?php printf("%s",$myrow["question"]); ?></textarea><div id="des-status"></div></td>
</tr>
<tr>
<td align="center" colspan="2"><br/><input type="button" value="BACK" onclick="history.go(-1)"><input type="submit" name="submit" value="UPDATE"><td> 
</tr>
<?php
} else {}

mysql_close($con);
?>
</table>
</form>

<script type="text/javascript">
fieldlimiter.setup({
	thefield: document.form.is, //reference to form field
	maxlength: 1000,
	statusids: ["des-status"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
	onkeypress:function(maxlength, curlength){ //onkeypress event handler
		if (curlength<maxlength) //if limit hasn't been reached
			this.style.border="2px solid gray" //"this" keyword returns form field
		else
			this.style.border="2px solid red"
	}
})
</script>
<?php
}
?>
</fieldset>
<?php
if ($_POST["submit"]){

require("../library/connection.php");

$sql="UPDATE task SET question='$_POST[is]' WHERE PName='$_POST[pno]' AND no='$_POST[no]'";

if (!mysql_query($sql,$con))
  {
  ?>
  <script type="text/javascript">
  alert("Error: <?php echo mysql_error() ?>");
  </script>
  <?php
  die();
  }
?>
<script type="text/javascript">
alert("Task No '<?php echo $_POST[no] ?>' for '<?php echo $_POST[pno] ?>' project has been modified successfully!");
</script>
<?php

mysql_close($con);
?>
<script type="text/javascript">
document.location.href='table.php'
</script>
<?php
}
?>
</body>
</html>