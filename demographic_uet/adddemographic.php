<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Demographic -> Add New Question</legend>
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
        if(document.form.start.value==""){
        alert("Please enter the question!");
        return false;
        }
	if(document.form.start.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at question input field.");
        return false;	
	}
        if(document.form.end.value==""){
        alert("Please enter the answer!");
        return false;
        }
	if(document.form.end.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at answer input field.");
        return false;	
	}
    }
</script>
<form name="form" action="adddemographic.php" method="POST" onsubmit="return docheck()">
<table>
<tr>
<td valign="top">Question &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</td>
<td> &nbsp;&nbsp;<textarea name="start" rows="10" cols="70"></textarea><div id="des-status1"></div></td>
</tr>
<tr>
<td valign="top">Answer &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</td>
<td> &nbsp; <textarea name="end" rows="10" cols="70">
New Answer in new line, sample below:-
Apple
Orange</textarea><div id="des-status2"></div></td>
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
	maxlength: 500,
	statusids: ["des-status1"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
	onkeypress:function(maxlength, curlength){ //onkeypress event handler
		if (curlength<maxlength) //if limit hasn't been reached
			this.style.border="2px solid gray" //"this" keyword returns form field
		else
			this.style.border="2px solid red"
	}
})

fieldlimiter.setup({
	thefield: document.form.end, //reference to form field
	maxlength: 500,
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

$sql="INSERT INTO demographic (question,answer)
VALUES
('$_POST[start]','$_POST[end]')";

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
alert("Demographic question has been added successfully!");
</script>
<?php

mysql_close($con);

}
?>