<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Satisfaction -> Delete Category</legend>
<script>
    function doCheck(){
        if(document.form.id.value==""){
        alert("Please select a category!");
        return false;
        }
    }
</script>
<form name="form" action="deletecategory.php" method="POST" onsubmit="return doCheck()">
<p></p>
<table>
<tr>
<td>Category :
<select name="id" style="width:60mm">
<option value=""> - SELECT CATEGORY -</option>
<?php
require("../library/connection.php");

$sql = "SELECT category FROM scategory";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

?>
	<option value="<?php printf("%s",$myrow["category"]); ?>"><?php printf("%s",$myrow["category"]); ?></option>
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
<td><br/></td>
<td> </td>
</tr>
<tr>
<td style="padding-left:90px"><input type="submit" name="submit" onClick="return confirm('Are you sure you want to delete this category?')" value="DELETE"><td> 
</tr>
</table>
</form>

</fieldset>
</body>
</html>

<?php

if ($_POST["submit"]){

require("../library/connection.php");

$sql="DELETE FROM scategory WHERE category='$_POST[id]'";

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
alert("Category name '<?php echo $_POST[id] ?>' has been deleted successfully!");
</script>
<?php

mysql_close($con);


}
?>
