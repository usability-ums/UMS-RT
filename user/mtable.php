<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User -> Modify UMS Account</legend>
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

$sql = "SELECT * FROM users WHERE id='$_GET[prop_id]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){

?>
<input type="hidden" name="id" value="<?php printf("%s",$_GET[prop_id]); ?>">

<tr>
<td>Role</td>
<td>: <input type="text" name="no" style="width:60mm" value="<?php printf("%s",$myrow["role"]); ?>" disabled="disabled"/></td>
</tr>
<tr>
<td>Email</td>
<td>: <input type="text" name="rl" style="width:60mm" value="<?php printf("%s",$myrow["email"]); ?>"></td>
</tr>
<tr>
<td>Display Name</td>
<td>: <input type="text" name="dp" style="width:60mm" value="<?php printf("%s",$myrow["name"]); ?>"></td>
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
<?php
}
?>
</fieldset>
</body>
</html>

<?php

if ($_POST['submit']){

require("../library/connection.php");


$sql="UPDATE users SET email='$_POST[rl]', name='$_POST[dp]' WHERE id='$_POST[id]'";
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
document.location.href='modifyuser.php'
</script>

<?php
mysql_close($con);
}
?>