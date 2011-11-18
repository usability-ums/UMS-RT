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
require("../../library/connection.php");
$number=$_COOKIE["tn"];
$number1=$_COOKIE["tn"]+1;
?>
<body>
<div id="main">
<div id="logo">
<div id="head">
</div>
<div id="content">
<?php
$sql1 = "SELECT question FROM task WHERE PName='$_COOKIE[pj]' AND no='$number'";
$result1 = mysql_query($sql1,$con);
if ($myrow1 = mysql_fetch_array($result1)){
do {
$content = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow1["question"]);
$content = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $content));
} while ($myrow1 = mysql_fetch_array($result1));

} else {
	echo "";  
}
?>
<p align="center" style="font-size:20pt"><b><br/><br/><u>TASK <?php printf("%d",$number); ?> - Feedback</u> <br/></b></p>
<p style="margin-left:50px" align="left"><b><font size="4"><?php printf("%s",$content); ?></font></b><br/></p>
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
        alert("Please write down any feedback on the textarea!");
        return false;
        }
    }
</script>
<form name="form" action="hcomment.php" method="POST" onsubmit="return docheck()">
<table align="center">
<tr>
<td colspan="3">Please write down any feedback for task <?php printf("%d",$number); ?> below:
<input type="hidden" name="tr" value="<?php printf("%d",$number1); ?>" style="width:0mm"</td>
</tr>
<tr>
<td align="center" style="colspan:3"><textarea name="answer" rows="10" cols="70"></textarea><div id="des-status"></div></td>
</tr>


<td><br/></td>
<td> </td>
</tr>
<tr>
<td align="center"><input type="submit" name="submit" value="SUBMIT"><td> 
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
</p>
</div>
<?php
require("footer.php");
?>
</body>
</html>
