<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Task -> Add New Task</legend>
<p></p>
<script type="text/javascript" src="../js/formfieldlimiter.js">

/***********************************************
* Form field Limiter v2.0- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com for full source code
***********************************************/

</script>
<script>

    function doCheck(){
        if(document.form.taskid.value==""){
        alert("Please select a task number!");
        return false;
        }
        if(document.form.id.value==""){
        alert("Please select a project name!");
        return false;
        }
        if(document.form.todo.value==""){
        alert("Please enter the scenario!");
        return false;
        }
	if(document.form.todo.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at scenario input field.");
        return false;
	}
    }
</script>
<form name="form" action="addtask.php" method="POST" onsubmit="return doCheck()">
<table>
<tr>
<td>Task No</td>
<td>: <select name="taskid"><option value=""> - SELECT TASK NUMBER -</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option></select></td>
</tr>
<tr>
<td>Project Name</td>
<td>: <select name="id">
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
	echo "No information."; 
}
mysql_close($con);
?>
</select>
</td>
</tr>
<tr>
<td>Scenario &nbsp; &nbsp; &nbsp; :</td>
<td> &nbsp;&nbsp;<textarea name="todo" rows="10" cols="70"></textarea><div id="des-status"></div></td>
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

<script type="text/javascript">
fieldlimiter.setup({
	thefield: document.form.todo, //reference to form field
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
</fieldset>
</body>
</html>

<?php

if ($_POST['submit']){

require("../library/connection.php");

$sql="INSERT INTO task (no,PName,question)
VALUES
('$_POST[taskid]','$_POST[id]','$_POST[todo]')";

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
alert("Task No '<?php echo $_POST[taskid] ?>' for '<?php echo $_POST[id] ?>' project has been added successfully!");
</script>
<?php

mysql_close($con);

}
?>
