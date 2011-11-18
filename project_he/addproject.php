<?php
require("../library/navigation.php");
?>

<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>Heuristic Evaluation -> Project -> Add HE Project</legend>
<p></p>
<script type="text/javascript" src="../js/formfieldlimiter.js">

/***********************************************
* Form field Limiter v2.0- � Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com for full source code
***********************************************/

</script>
<script>
    function docheck(){
        if(document.form.id.value==""){
        alert("Please enter a project name!");
        return false;
        }
	if(document.form.id.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at project name input field.");
        return false;	
	}
        if(document.form.url.value==""){
        alert("Please enter the test environment!");
        return false;
        }
	if(document.form.url.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at test environment input field.");
        return false;	
	}
        if(document.form.pl.value==""){
        alert("Please select a project lead!");
        return false;
        }
        if(document.form.end.value==""){
        alert("Please write down tester involved!");
        return false;
        }
	if(document.form.end.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at tester involved input field.");
        return false;	
	}
    }
</script>
<form name="form" action="addproject.php" method="POST" onsubmit="return docheck()">
<table>
<tr>
<td>Project Name</td>
<td>: <input type="text" style="width:60mm" name="id" value=""></td>
</tr>
<tr>
<td>Test Environment</td>
<td>: <input type="text" style="width:60mm" name="url" value=""></td>
</tr>
<tr>
<td>Project Lead</td>
<td>: <select name="pl" style="width:60mm">
<option value=""> - SELECT LEAD NAME -</option>
<?php
require("../library/connection.php");
$sql = "SELECT * FROM users WHERE role!='management' AND role!='developer' ORDER BY name ASC";
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
<td valign="top">Tester Involved &nbsp; &nbsp; :</td>
<td> &nbsp;&nbsp;<textarea name="end" rows="5" cols="70">
New Answer in new line, sample below:-
John
Jonny</textarea><div id="des-status2"></div>
</td>
</tr>
<tr><td><br/></td><td></td></tr>
<tr>
<td></td>
<td><input type="submit" name="submit" value="ADD"></td> 
</tr>
</table>
</form>

<script type="text/javascript">
fieldlimiter.setup({
	thefield: document.form.end, //reference to form field
	maxlength: 1000,
	statusids: ["des-status2"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
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

date_default_timezone_set( 'Asia/Kuala_Lumpur' );
$handle = date('d-m-Y');

$sql="INSERT INTO project (name,URL,method_type,date,lead,resources)
VALUES
('$_POST[id]','$_POST[url]','HE','$handle','$_POST[pl]','$_POST[end]')";

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
alert("HE project name '<?php echo $_POST[id] ?>' has been added successfully!");
document.location.href='addproject.php'
</script>
<?php

mysql_close($con);

}
?>