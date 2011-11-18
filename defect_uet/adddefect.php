<?php
require("../library/navigation.php");
?>

<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Defect -> Add Defect</legend>
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
        if(document.form.pj12.value==""){
        alert("Please select a project name!");
        return false;
        }
        if(document.form.is.value==""){
        alert("Please enter the issue!");
        return false;
        }
        if(document.form.rc.value==""){
        alert("Please enter the recommendation!");
        return false;
        }
        if(document.form.im.value==""){
        alert("Please enter the impact!");
        return false;
        }
        if(document.form.sc.value==""){
        alert("Please enter the screen appear!");
        return false;
        }
        if(document.form.userfile.value==""){
        alert("Please upload a screenshot!");
        return false;
        }
        if(document.form.env.value==""){
        alert("Please enter the environment!");
        return false;
        }
	var fileName = document.form.userfile.value;
	var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "PNG" || ext == "png")
	{
	return true;
	} 
	else
	{
	alert("Upload jpg or png screenshot only");
	return false;
	}
    }
</script>
<form name="form" action="adddefect.php" ENCTYPE="multipart/form-data" method="POST" onsubmit="return docheck()">
<?php
require("../library/connection.php");
$sql = "SELECT no,format FROM data";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){

$format=$myrow["format"];
$no=(int)$myrow["no"]+1;
if(strlen($no)==1){
$no="00000".$no;
}
if(strlen($no)==2){
$no="0000".$no;
}
if(strlen($no)==3){
$no="000".$no;
}
if(strlen($no)==4){
$no="00".$no;
}
if(strlen($no)==5){
$no="0".$no;
}
if(strlen($no)==6){
$no=$no;
}
$id=$format.$no;
$sql="UPDATE data SET no='$no' WHERE format='UR'";
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
?>
<table>
<tr>
<td>Defect No</td>
<td>: <input type="text" style="width:60mm" name="no12" value="<?php printf("%s",$id); ?>" disabled="disabled"></td>
</tr>
<input type="hidden" name="no" value="<?php printf("%s",$id); ?>">
<?php
}
?>
<tr>
<td>Project Name</td>
<td>: <select name="pj12" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");
$sql = "SELECT name FROM project WHERE method_type='UET'";
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
<td>Defect Type</td>
<td>: <select name="tp"><option value="Problem Report">Problem Report (PR)</option><option value="Change Request">Change Request (CR)</option></select></td>
</tr>
<tr>
<td>Stage of Prototype</td>
<td>: <select name="sp"><option value="Early">Early</option><option value="Intermediate">Intermediate</option><option value="Advance">Advance</option></select></td>
</tr>
<tr>
<td>Stage of SDLC</td>
<td>: <select name="st"><option value="Requirement">Requirement</option><option value="Design">Design</option><option value="System Test">System Test</option></select></td>
</tr>
<tr>
<td>Issue</td>
<td> :&nbsp;<textarea name="is" rows="4" cols="60"></textarea><div id="des-status"></div></td>
</tr>
<tr>
<td>Category</td>
<td>: <select name="ct">
<option value="Compatibility">Compatibility</option>
<option value="Consistency">Consistency</option>
<option value="Error Prevention & Correction">Error Prevention & Correction</option>
<option value="Explicitness">Explicitness</option>
<option value="Flexibility">Flexibility</option>
<option value="Functionality">Functionality</option>
<option value="Informative Feedback">Informative Feedback</option>
<option value="Language & Content">Language & Content</option>
<option value="Navigation">Navigation</option>
<option value="Privacy">Privacy</option>
<option value="User Guidance & Support">User Guidance & Support</option>
<option value="Visual Clarity">Visual Clarity</option>
<option value="Others">Others</option>
</select></td>
</tr>
<tr>
<td>Severity</td>
<td>: <select name="sr"><option value="Minor">Minor</option><option value="Major">Major</option><option value="Critical">Critical</option></select></td>
</tr>
<tr>
<td>Recommendation</td>
<td> :&nbsp;<textarea name="rc" rows="4" cols="60"></textarea><div id="des-status1"></div></td>
</tr>
<tr>
<td>Impact</td>
<td> :&nbsp;<textarea name="im" rows="4" cols="60"></textarea><div id="des-status4"></div></td>
</tr>
<tr>
<td>Screen Appear</td>
<td> :&nbsp;<textarea name="sc" rows="4" cols="60"></textarea><div id="des-status2"></div></td>
</tr>
<tr>
<td>Screenshot</td>
<td>: <input type="file" name="userfile"/> .jpg & png format only</td>
</tr>
<tr>
<td>Environment</td>
<td> :&nbsp;<textarea name="env" rows="4" cols="60"></textarea><div id="des-status3"></div></td>
</tr>
<tr>
<td align="center" colspan="2"><br/><input type="submit" name="submit" value="ADD"><td> 
</tr>
</table>
</form>

<script type="text/javascript">
fieldlimiter.setup({
	thefield: document.form.is, //reference to form field
	maxlength: 1000,
	statusids: ["des-status"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
	onkeypress:function(maxlength, curlength){ //onkeypress event handler
		if (curlength<maxlength) //if limit hasn't been reached
			this.style.border="2px solid gray" //"this" keyword returns form field
		else
			this.style.border="2px solid red"
	}
})
fieldlimiter.setup({
	thefield: document.form.rc, //reference to form field
	maxlength: 1000,
	statusids: ["des-status1"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
	onkeypress:function(maxlength, curlength){ //onkeypress event handler
		if (curlength<maxlength) //if limit hasn't been reached
			this.style.border="2px solid gray" //"this" keyword returns form field
		else
			this.style.border="2px solid red"
	}
})
fieldlimiter.setup({
	thefield: document.form.sc, //reference to form field
	maxlength: 1000,
	statusids: ["des-status2"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
	onkeypress:function(maxlength, curlength){ //onkeypress event handler
		if (curlength<maxlength) //if limit hasn't been reached
			this.style.border="2px solid gray" //"this" keyword returns form field
		else
			this.style.border="2px solid red"
	}
})
fieldlimiter.setup({
	thefield: document.form.env, //reference to form field
	maxlength: 1000,
	statusids: ["des-status3"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
	onkeypress:function(maxlength, curlength){ //onkeypress event handler
		if (curlength<maxlength) //if limit hasn't been reached
			this.style.border="2px solid gray" //"this" keyword returns form field
		else
			this.style.border="2px solid red"
	}
})
fieldlimiter.setup({
	thefield: document.form.im, //reference to form field
	maxlength: 1000,
	statusids: ["des-status4"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
	onkeypress:function(maxlength, curlength){ //onkeypress event handler
		if (curlength<maxlength) //if limit hasn't been reached
			this.style.border="2px solid gray" //"this" keyword returns form field
		else
			this.style.border="2px solid red"
	}
})
</script>
</fieldset>
<?php

if ($_POST["submit"]){

//define a max size for the uploaded images in Kb
define ("MAX_SIZE","2000"); 

//get the size of the image in bytes
//$_FILES['image']['tmp_name'] is the temporary filename of the file
//in which the uploaded file was stored on the server
$size=filesize($_FILES['userfile']['tmp_name']);

if($size <= MAX_SIZE*1024){

require("../library/connection.php");

function myAddSlashes($text) {
	if(get_magic_quotes_gpc())
		return $text;
	else
		return addslashes($text);		
}

function findexts ($filename) { 
$filename = strtolower($filename) ;
$exts = split("[/\\.]", $filename) ;
$n = count($exts)-1; $exts = $exts[$n];
return $exts;
}

$cheissue=myAddSlashes($_POST["is"]);
$cherecommendation=myAddSlashes($_POST["rc"]);
$chescreen=myAddSlashes($_POST["sc"]);
$cheenvironment=myAddSlashes($_POST["env"]);
$impact=myAddSlashes($_POST["im"]);

$ext = findexts ($_FILES['userfile']['name']) ;


$ran = rand () ; 
$ran2 = $_POST["no"]."-".$ran."."; 

$target_path = "uploads/";
$target_path = $target_path . $ran2.$ext; 
$provect= $ran2.$ext; 

date_default_timezone_set( 'Asia/Kuala_Lumpur' );
$handle = date('d-m-Y D hisa');

$sql="INSERT INTO defect (id,project,defecttype,testingtype,stage1,stage2,issue,category,severity,screen,recommendation,file,environment,submitdate,impact,raiseby)
VALUES
('$_POST[no]','$_POST[pj12]','$_POST[tp]','UET','$_POST[sp]','$_POST[st]','$cheissue','$_POST[ct]','$_POST[sr]','$chescreen','$cherecommendation','$provect','$cheenvironment','$handle','$impact','$_COOKIE[us]')";

if (!mysql_query($sql,$con))
  {
?>
<script type="text/javascript">
alert("Error: <?php echo mysql_error() ?>");
</script>
<?php
die();
  }

$copied = copy($_FILES['userfile']['tmp_name'], $target_path);

if (!$copied) 
{
?>
<script type="text/javascript">
alert("Copy unsuccessfull!");
</script>
<?php
		
}

?>
<script type="text/javascript">
alert("Defect '<?php echo $_POST[no] ?>' has been added successfully!");
</script>
<?php

$ip=$_SERVER['REMOTE_ADDR'];

$sql="INSERT INTO defectlog (id,chgby,action,date,ip)
VALUES
('$_POST[no]','$_COOKIE[us]','Submitted','$handle','$ip')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

mysql_close($con);
}

}
?>
</body>
</html>