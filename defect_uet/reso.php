<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Defect -> Resolution</legend>
<p></p>
<?php
if($_GET[prop_id] !=""){
?>
<script type="text/javascript" src="../js/formfieldlimiter.js">

/***********************************************
* Form field Limiter v2.0- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com for full source code
***********************************************/

</script>
<script>
    function doCheck(){
        if(document.form.is.value==""){
        alert("Please enter developer notes!");
        return false;
        }
        if(document.form.tp.value==""){
        alert("Please select a state!");
        return false;
        }
    }
</script>
<form name="form" action="reso.php" method="POST" onsubmit="return doCheck()">
<table>
<?php
require("../library/connection.php");

$sql = "SELECT * FROM defect WHERE id='$_GET[prop_id]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
?>
<tr>
<td>Defect No</td>
<td>: <input type="text" style="width:60mm" name="no12" value="<?php printf("%s - %s",$_GET[prop_id],$myrow["status"]); ?>" disabled="disabled"></td>
</tr>
<input type="hidden" name="no" value="<?php printf("%s",$_GET[prop_id]); ?>">
<tr>
<td>Project Name</td>
<td>: <input type="text" style="width:60mm" name="pj12" value="<?php printf("%s",$myrow["project"]); ?>" disabled="disabled"></td>
</tr>
<tr>
<td>State</td>
<td>: <select name="tp">
<option value="">- SELECT STATE -</option>
<option value="Resolved">Resolved</option>
<option value="Postponed">Postponed</option>
</select></td>
</tr>
<tr>
<td>Developer Notes</td>
<td> :&nbsp;<textarea name="is" rows="4" cols="60"><?php printf("%s", $myrow["resolvenote"]); ?></textarea><div id="des-status"></div></td>
</tr>
<tr>
<td align="center" colspan="2"><br/><input type="button" value="BACK" onclick="history.go(-1)"><input type="submit" name="submit" value="UPDATE"><td> 
</tr>
<?php
} else {}

mysql_close($con);
?>
</table>
</form>

<script type="text/javascript">
fieldlimiter.setup({
	thefield: document.form.is, //reference to form field
	maxlength: 250,
	statusids: ["des-status"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
	onkeypress:function(maxlength, curlength){ //onkeypress event handler
		if (curlength<maxlength) //if limit hasn't been reached
			this.style.border="2px solid gray" //"this" keyword returns form field
		else
			this.style.border="2px solid red"
	}
})
</script>
<?php
}
?>
</fieldset>
</body>
</html>

<?php

if ($_POST["submit"]){

require("../library/connection.php");

function myAddSlashes($text) {
	if(get_magic_quotes_gpc())
		return $text;
	else
		return addslashes($text);		
}

date_default_timezone_set( 'Asia/Kuala_Lumpur' );
$handle = date('d-m-Y D hisa');

$note=myAddSlashes($_POST["is"]);

$sql="UPDATE defect SET status='$_POST[tp]', resolvenote='$note', resolvedate='$handle', resolveby='$_COOKIE[us]' WHERE id='$_POST[no]'";

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
alert("'<?php echo $_POST[no] ?>' has been modified successfully!");
</script>
<?php

$ip=$_SERVER['REMOTE_ADDR'];

$sql="INSERT INTO defectlog (id,chgby,action,date,ip)
VALUES
('$_POST[no]','$_COOKIE[us]','$_POST[tp]','$handle','$ip')";

if (!mysql_query($sql,$con))
  {
?>
<script type="text/javascript">
alert("Error: <?php echo mysql_error() ?>");
</script>
<?php
die();
  }

mysql_close($con);
?>
<script type="text/javascript">
document.location.href='dtable.php'
</script>
<?php
}
?>