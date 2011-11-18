<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> User -> Add New User</legend>
<p></p>
<script>

    function doCheck(){
        if(document.form.id.value==""){
        alert("Please select a project name!");
        return false;
        }
        if(document.form.rl.value==""){
        alert("Please enter the username!");
        return false;
        }
        if(document.form.todo.value==""){
        alert("Please enter the password!");
        return false;
        }
	if(document.form.rl.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at username input field.");
        return false;
	}
	if(document.form.todo.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at password input field.");
        return false;
	}
    }
</script>
<form name="form" action="adduser.php" method="POST" onsubmit="return doCheck()">
<table>
<tr>
<td>Project Name</td>
<td>: <select name="id">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");
require("../library/numberonly.php");

$sql = "SELECT name FROM project WHERE method_type='UET'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

?>
	<option value="<?php printf("%s",$myrow["name"]); ?>"><?php printf("%s",$myrow["name"]); ?></option>
<?php
} while ($myrow = mysql_fetch_array($result));

} else {
	echo "No information."; 
}
mysql_close($con);
?>
</select>
</td>
</tr>
<tr>
<td>Username</td>
<td>: <input type="text" name="rl" style="width:60mm" value=""></td>
</tr>
<tr>
<td>Password</td>
<td>: <input type="text" name="todo" style="width:60mm" value="" onKeyPress="return numbersonly(this, event)"></td>
</tr>
<tr>
<td><br/></td>
<td> </td>
</tr>
<tr>
<td align="center" colspan="2"><input type="submit" name="submit" value="ADD"><td> 
</tr>
</table>
</form>

</fieldset>
</body>
</html>

<?php

if ($_POST["submit"]){

require("../library/connection.php");

$converter=strtolower($_POST[rl]);
$sql="INSERT INTO user (user,status,project,password)
VALUES
('$converter','false','$_POST[id]','$_POST[todo]')";

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
alert("Username '<?php echo $_POST[rl] ?>' for '<?php echo $_POST[id] ?>' project has been added successfully!");
</script>
<?php

mysql_close($con);


}
?>