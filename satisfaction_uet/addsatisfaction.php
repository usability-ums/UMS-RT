<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Satisfaction -> Add New Question</legend>
<script type="text/javascript" src="../js/formfieldlimiter.js">

/***********************************************
* Form field Limiter v2.0- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com for full source code
***********************************************/

</script>
<script>
    function doCheck(){
        if(document.form.id.value==""){
        alert("Please select the category!");
        return false;
        }
        if(document.form.todo.value==""){
        alert("Please enter the question!");
        return false;
        }
	if(document.form.todo.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at question input field.");
        return false;	
	}
    }
</script>
<form name="form" action="addsatisfaction.php" method="POST" onsubmit="return doCheck()">
<p></p>
<table>
<tr>
<td>Category :</td><td>&nbsp;
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
<td>Question:</td>
<td> &nbsp;&nbsp;<textarea name="todo" rows="6" cols="70"></textarea><div id="des-status"></div></td>
</tr>
<tr>
<td><br/></td>
<td> </td>
</tr>
<tr>
<td></td>
<td> &nbsp;<input type="submit" name="submit" value="ADD"><td> 
</tr>
</table>
</form>

<script type="text/javascript">
fieldlimiter.setup({
	thefield: document.form.todo, //reference to form field
	maxlength: 500,
	statusids: ["des-status"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
	onkeypress:function(maxlength, curlength){ //onkeypress event handler
		if (curlength<maxlength) //if limit hasn't been reached
			this.style.border="2px solid gray" //"this" keyword returns form field
		else
			this.style.border="2px solid red"
	}
})
</script>
</fieldset>
</body>
</html>

<?php

if ($_POST["submit"]){

require("../library/connection.php");

$sql="INSERT INTO satisfaction (question,category)
VALUES
('$_POST[todo]','$_POST[id]')";

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
alert("Question has been added successfully!");
</script>
<?php

mysql_close($con);


}
?>
