<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Effectiveness -> Modify Question</legend>
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
<form name="form" action="mtable.php" method="POST">
<table>
<?php
require("../library/connection.php");

$sql = "SELECT * FROM effectiveness WHERE no='$_GET[prop_id]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){

?>
<input type="hidden" name="id" value="<?php printf("%s",$_GET[prop_id]); ?>">
<tr>
<td valign="top">Question :</td>
<td> &nbsp;&nbsp;<textarea name="start" rows="7" cols="70"><?php printf("%s",$myrow["question"]); ?></textarea><div id="des-status1"></div></td>
</tr>

<?php
}
?>

<tr>
<td align="center" colspan="2"><br/><input type="button" value="BACK" onclick="history.go(-1)"><input type="submit" name="submit" value="UPDATE"><td> 
</tr>
<?php
mysql_close($con);
?>
</table>
</form>

<script type="text/javascript">
fieldlimiter.setup({
	thefield: document.form.start, //reference to form field
	maxlength: 500,
	statusids: ["des-status1"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
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
</body>
</html>

<?php

if ($_POST['submit']){

require("../library/connection.php");


$sql="UPDATE effectiveness SET question='$_POST[start]' WHERE no='$_POST[id]'";
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
alert("Modified successfully!");
document.location.href='modifyeffectiveness.php'
</script>

<?php
mysql_close($con);
}
?>