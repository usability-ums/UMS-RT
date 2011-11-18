<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Satisfaction -> Add New Category</legend>
<script type="text/javascript" src="../js/formfieldlimiter.js">

/***********************************************
* Form field Limiter v2.0- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com for full source code
***********************************************/

</script>
<script>
    function doCheck(){
        if(document.form.todo.value==""){
        alert("Please enter the category!");
        return false;
        }
	if(document.form.todo.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at category input field.");
        return false;	
	}
    }
</script>
<form name="form" action="addcategory.php" method="POST" onsubmit="return doCheck()">
<p></p>
<table>
<tr>
<td>Category :</td>
<td> <input type="text" style="width:60mm" name="todo" value=""></td>
</tr>
<td><br/></td>
<td> </td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="submit" value="ADD"><td> 
</tr>
</table>
</form>

</fieldset>
</body>
</html>

<?php

if ($_POST["submit"]){

require("../library/connection.php");

$sql="INSERT INTO scategory (category)
VALUES
('$_POST[todo]')";

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
alert("Category name '<?php echo $_POST[todo] ?>' has been added successfully!");
</script>
<?php

mysql_close($con);


}
?>