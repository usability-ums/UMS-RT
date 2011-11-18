<html>
<link href="../../style/multistyle.css" rel="stylesheet" type="text/css"/>
<?php
require("header.php");
require("../../library/numberonly.php");
?>
<body>
<div id="main">
<div id="logo">
<div id="head">
</div>
<div id="content">
<p align="center" style="font-size:25pt"><b><br/><br/><br/>Welcome to User Experience Test (UET)<br/><br/>Remember to THINK ALOUD!</b><br/></p>
<p>
<script>
    function docheck(){
        if(document.form.id.value==""){
        alert("Please select a project name!");
        return false;
        }
        if(document.form.rl.value==""){
        alert("Please enter the username!");
        return false;
        }
	if(document.form.rl.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at username input field.");
        return false;
	}
        if(document.form.tr.value==""){
        alert("Please enter the password!");
        return false;
        }
	var input=document.form.tr.value;
	if(isNaN(input)){
	alert("Only number allow!\nLocation at password input field.");
        return false;
	}
    }
</script>
<form name="form" action="vlogin.php" method="POST" onsubmit="return docheck()">
<table align="center">
<tr>
<td>Project Name</td>
<td>: <select name="id">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../../library/connection.php");
$sql = "SELECT name FROM project WHERE status='true' AND method_type='UET'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {
?>
	<option value="<?php printf("%s",$myrow["name"]); ?>"><?php printf("%s",$myrow["name"]); ?></option>
<?php
} while ($myrow = mysql_fetch_array($result));
}
else {

}
mysql_close($con);
?>
</select>
</td>
</tr>
<tr>
<td>Username</td>
<td>: <input type="text" name="rl" style="width:70mm" value=""></td>
</tr>
<tr>
<td>Password</td>
<td>: <input type="password" name="tr" style="width:70mm" onKeyPress="return numbersonly(this, event)" value=""></td>
</tr>
<tr>
<td align="center" colspan="2"><input type="submit" name="submit" value="LOGIN"><td> 
</tr>
</table>
</form>

</p>
</div>
<?php
require("footer.php");
?>
</body>
</html>
