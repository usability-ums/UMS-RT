<?php
if($_COOKIE["pj"]==NULL){
?>
<script type="text/javascript">document.location.href='login.php'</script>
<?php
}
?>
<html>
<link href="../../style/multistyle.css" rel="stylesheet" type="text/css"/>
<?php
require("header.php");
?>
<body>
<div id="main">
<div id="logo">
<div id="head">
</div>
<div id="content">
<p align="center" style="font-size:25pt"><b><br/><br/>Debriefing Question</b><br/></p>
<p>
<script type="text/javascript" src="../../js/formfieldlimiter.js">

/***********************************************
* Form field Limiter v2.0- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com for full source code
***********************************************/

</script>
<script>
    function docheck(){
        if(document.form.answer.value==""){
        alert("Please write your comment on the textarea!");
        return false;
        }
        if(document.form.answer1.value==""){
        alert("Please write your comment on the textarea!");
        return false;
        }
    }
</script>
<form name="form" action="debriefing.php" method="POST" onsubmit="return docheck()">
<?php
require("../../library/connection.php");

$sql4 = "SELECT score FROM debriefingscore WHERE project='$_COOKIE[pj]' AND user='$_COOKIE[us]'";
$result4 = mysql_query($sql4,$con);
if ($myrow4 = mysql_fetch_array($result4)){

?>
<script type="text/javascript">
document.location.href='finish.php'
</script>
<?php

}else{
?>
<table align="center" border="1">
<tr>
<td>No</td>
<td width="410mm">Question</td>
<td width="40mm" style="text-align:center">Disagree</td>
<td width="55mm" style="text-align:center">Agree</td>
</tr>
<?php
$sql = "SELECT * FROM assigndef WHERE project='$_COOKIE[pj]'";
$result = mysql_query($sql,$con);
$count =1;
if ($myrow = mysql_fetch_array($result)){
do {

$sql7 = "SELECT * FROM debriefing WHERE no='$myrow[no]'";
$result7 = mysql_query($sql7,$con);
$myrow7 = mysql_fetch_array($result7);

$string = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow7["question"]);
$string = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string));

?>
	<tr>
	<td valign="top"><?php printf("%s",$count);?>) </td>
	<td><?php printf("%s",$string); ?></td>
	<td align="center"><input type="radio" name="<?php printf("%s",$count); ?>" value="Disagree"/></td>
	<td align="center"><input type="radio" name="<?php printf("%s",$count);$count++; ?>" value="Agree"/></td>
	</tr>

<?php
} while ($myrow = mysql_fetch_array($result));

} else {

}
?>
</table><p></p>
<?php
mysql_close($con);
?>
<table align="center" width="50%">
<tr>
<td colspan="3">How do you think the <?php printf("%s",$_COOKIE["pj"]); ?> could be improved?</td>
</tr>
<tr>
<td colspan="3"><textarea name="answer" rows="10" cols="70"></textarea><div id="des-status"></div><br/></td>
</tr>
<tr>
<td colspan="3">How do you think the usability team could improve in conducting future UET?</td>
</tr>
<tr>
<td colspan="3"><textarea name="answer1" rows="10" cols="70"></textarea><div id="des1-status"></div></td>
</tr>
<tr>
<td colspan="3"><br/>How many star you would give for <?php printf("%s",$_COOKIE[pj]); ?> project?</td>
</tr>
<tr>
<td colspan="3">
<input checked type="radio" name="star" value="1" /><img title="Poor" src="../../images/1star.jpg"/><br/><br/>
<input type="radio" name="star" value="2" /><img title="Ordinary" src="../../images/2star.jpg"/><br/><br/>
<input type="radio" name="star" value="3" /><img title="Fair" src="../../images/3star.jpg"/><br/><br/>
<input type="radio" name="star" value="4" /><img title="Good" src="../../images/4star.jpg"/><br/><br/>
<input type="radio" name="star" value="5" /><img title="Excellent" src="../../images/5star.jpg"/><br/><br/>
</td>
</tr>
<tr>
<td></td>
<td align="center">
<input type="submit" name="submit" value="SUBMIT">
</td> 
</tr>
</table>
</form>

<script type="text/javascript">
fieldlimiter.setup({
	thefield: document.form.answer, //reference to form field
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
<script type="text/javascript">
fieldlimiter.setup({
	thefield: document.form.answer1, //reference to form field
	maxlength: 1000,
	statusids: ["des1-status"], //id(s) of divs to output characters limit in the form [id1, id2, etc]. If non, set to empty array [].
	onkeypress:function(maxlength, curlength){ //onkeypress event handler
		if (curlength<maxlength) //if limit hasn't been reached
			this.style.border="2px solid gray" //"this" keyword returns form field
		else
			this.style.border="2px solid red"
	}
})
</script>
</p>
</div>
<?php
require("footer.php");
}
?>
</body>
</html>

<?php

if ($_POST["submit"]){

require("../../library/connection.php");
$count=1;
$check=true;
$sql = "SELECT no FROM assigndef WHERE project='$_COOKIE[pj]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

if($_POST["$count"]==NULL){
	$check=false;
}

if($check==false){
?>
  <script type="text/javascript">
  alert("Question <?php echo $count ?> is mandatory!");
	window.history.go(-1)
  </script>
<?php
}
$count++;

} while ($myrow = mysql_fetch_array($result));

} else {}


if($check==true){
$count=1;

$sql = "SELECT no FROM assigndef WHERE project='$_COOKIE[pj]'";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){
do {

$sql1="INSERT INTO debriefingscore (user,score,project,question)
VALUES
('$_COOKIE[us]','$_POST[$count]','$_COOKIE[pj]','$myrow[no]')";
$count++;
if (!mysql_query($sql1,$con))
  {
  die('Error: ' . mysql_error());
  }

} while ($myrow = mysql_fetch_array($result));

} else {

}
function myAddSlashes($text) {
	if(get_magic_quotes_gpc())
		return $text;
	else
		return addslashes($text);		
}

$convert=myAddSlashes($_POST["answer"]);
$convert1=myAddSlashes($_POST["answer1"]);

$sql16 = "SELECT type FROM project WHERE name='$_COOKIE[pj]'";
$result16 = mysql_query($sql16,$con);
if ($myrow16 = mysql_fetch_array($result16)){
$pjtype=$myrow16["type"];
}

$sql3="INSERT INTO debriefingc (user,comment,project,question)
VALUES
('$_COOKIE[us]','$convert','$_COOKIE[pj]','1')";
if (!mysql_query($sql3,$con))
  {
  die('Error: ' . mysql_error());
  }

$sql4="INSERT INTO debriefingc (user,comment,project,question)
VALUES
('$_COOKIE[us]','$convert1','$_COOKIE[pj]','2')";
if (!mysql_query($sql4,$con))
  {
  die('Error: ' . mysql_error());
  }

$sql5="INSERT INTO debriefingc (user,comment,project,question)
VALUES
('$_COOKIE[us]','$_POST[star]','$_COOKIE[pj]','3')";
if (!mysql_query($sql5,$con))
  {
  die('Error: ' . mysql_error());
  }

if($pjtype=="remote"){
$sql="UPDATE user SET mouseclick='Yes' WHERE user='$_COOKIE[us]'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
}
mysql_close($con);
?>
<script>
location.href = "finish.php";
</script>
<?php
}}
?>