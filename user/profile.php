<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<script>
    function docheck1(){
        if(document.form.ow.value==""){
        alert("Please enter the old password!");
        return false;
        }
        if(document.form.nw.value==""){
        alert("Please enter the new password!");
        return false;
        }
        if(document.form.pw.value==""){
        alert("Please enter the confirm new password!");
        return false;
        }
        if(document.form.nw.value!=document.form.pw.value){
        alert("New password and confirm new password is not the same!");
        return false;
        }
    }
</script>
<fieldset>
<legend>Change Password</legend>
<p></p>
<form name="form" action="profile.php" method="POST" onsubmit="return docheck1()">
<table>
<tr>
<td>Name</td>
<td>: <input type="text" name="nm" style="width:60mm" value="<?php printf("%s",$_COOKIE[un]); ?>" disabled="disabled"> </td>
</tr>
<tr>
<td>Old Password</td>
<td>: <input type="password" name="ow" style="width:60mm" value=""> </td>
</tr>
<tr>
<td>New Password</td>
<td>: <input type="password" name="nw" style="width:60mm" value=""> </td>
</tr>
<tr>
<td>Confirm New Password</td>
<td>: <input type="password" name="pw" style="width:60mm" value=""> </td>
</tr>
<tr><td><br/></td><td></td></tr>
<tr>
<td align="center" colspan="2"><input type="submit" name="submit" value="UPDATE"><td> 
</tr>
</table>
</form>
</fieldset>

</body>
</html>

<?php

if ($_POST['submit']){

require("../library/connection.php");

function myAddSlashes($text) {
	if(get_magic_quotes_gpc())
		return $text;
	else
		return addslashes($text);		
}

$opass=myAddSlashes($_POST["ow"]);
$npass=myAddSlashes($_POST["pw"]);

$sql = "SELECT * FROM users WHERE email='$_COOKIE[us]' AND password='$opass'";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){

$sql="UPDATE users SET password='$npass' WHERE email='$_COOKIE[us]'";
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

?>
<script>
alert("Your password has been modified successfully!");
</script>
<?php

}else{

?>
<script>
alert("Your old password is incorrect!\nPassword not changed.");
</script>
<?php
}
mysql_close($con);

}
?>
