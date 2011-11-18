<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Probe Question -> Add Open Question</legend>
<p></p>
<script type="text/javascript" src="../js/formfieldlimiter.js">

/***********************************************
* Form field Limiter v2.0- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com for full source code
***********************************************/

</script>
<script>
    function docheck(){
        if(document.form.title.value==""){
        alert("Please select a project name!");
        return false;
        }
        if(document.form.task.value==""){
        alert("Please select a task no!");
        return false;
        }
        if(document.form.start.value==""){
        alert("Please enter the question!");
        return false;
        }
	if(document.form.start.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at question input field.");
        return false;	
	}
        if(document.form.ans.value==""){
        alert("Please enter the answer!");
        return false;
        }
	if(document.form.ans.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at answer input field.");
        return false;	
	}
    }
</script>
<form name="form" action="addopquestion.php" method="POST" onsubmit="return docheck()">
<table>
<tr>
<td>Project Name</td>
<td>: <select name="title" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");
$sql = "SELECT * FROM project WHERE method_type='UET' AND type='remote'";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){
do {
?>
	<option value="<?php printf("%s",$myrow["name"]); ?>"><?php printf("%s",$myrow["name"]); ?></option>
<?php
} while ($myrow = mysql_fetch_array($result));
} else {
	
}
mysql_close($con);
?>
</td>
</tr>
<tr>
<td>Task No</td>
<td>: <select name="task" style="width:60mm">
<option value=""> - SELECT TASK NO -</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
</td>
</tr>
<tr>
<td>Question :</td>
<td> &nbsp;&nbsp;<textarea name="start" rows="10" cols="70"></textarea><div id="des-status1"></div></td>
</td>
</tr>
<tr>
<td>Answer </td>
<td>: <input type="text" name="ans" style="width:60mm"/></td>
</td>
</tr>
<tr>
<tr><td><br/></td><td></td></tr>
<tr>
<td></td>
<td><input type="submit" name="submit" value="ADD QUESTION"><td> 
</tr>
</table>
</form>

<script type="text/javascript">
fieldlimiter.setup({
	thefield: document.form.start, //reference to form field
	maxlength: 1000,
	statusids: ["des-status1"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
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

$sql="INSERT INTO p_question (title,task,question,answer,type)
VALUES
('$_POST[title]','$_POST[task]','$_POST[start]','$_POST[ans]','Open Question')";

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
alert("Open Question for project '<?php echo $_POST[title] ?>' - task'<?php echo $_POST[task] ?>' has been added successfully!");
</script>
<?php

mysql_close($con);

}
?>