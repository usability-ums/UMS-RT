<?php
if($_COOKIE["pj"]==NULL){
?>
<script type="text/javascript">document.location.href='login.php'</script>
<?php
}
?>
<script type="text/javascript">
if(top!=self){
top.location=self.location;
}
</script>
<html>
<link href="../../style/multistyle.css" rel="stylesheet" type="text/css"/>
<?php
require("header.php");
require("../../library/connection.php");
$number=$_COOKIE[tn];
$content=nocontent;
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

}
?>
<p align="center" style="font-size:20pt"><b><br/><br/><u>TASK <?php printf("%d",$number); ?> - Evaluate</u> <br/></b></p>
<p style="margin-left:50px" align="left"><b><font size="4"><?php printf("%s",$content); ?></font></b><br/></p>
<p>
<form name="form" action="question.php" method="POST">
<table align="center" border="1">
<tr>
<td>No</td>
<td>Question</td>
<td width="20mm" style="text-align:center">Strongly Disagree</td>
<td width="20mm" style="text-align:center">Disagree</td>
<td width="20mm" style="text-align:center">Somewhat Disagree</td>
<td width="20mm" style="text-align:center">Neutral</td>
<td width="20mm" style="text-align:center">Somewhat Agree</td>
<td width="20mm" style="text-align:center">Agree</td>
<td width="20mm" style="text-align:center">Strongly Agree</td>
</tr>
<?php

$sql = "SELECT * FROM assignsatis WHERE project='$_COOKIE[pj]' AND task='$number' ORDER BY CAST(no AS UNSIGNED) ASC";
$result = mysql_query($sql,$con);
$count =1;
if ($myrow = mysql_fetch_array($result)){
do {

$sql7 = "SELECT * FROM satisfaction WHERE no='$myrow[no]'";
$result7 = mysql_query($sql7,$con);
$myrow7 = mysql_fetch_array($result7);

$string = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow7["question"]);
$string = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string));

?>
	<tr>
	<td><?php printf("%s",$count);?>)</td>
	<td><?php printf("%s",$string); ?></td>
	<td align="center"><input type="radio" name="<?php printf("%s",$count); ?>" value="0"/></td>
	<td align="center"><input type="radio" name="<?php printf("%s",$count); ?>" value="1"/></td>
	<td align="center"><input type="radio" name="<?php printf("%s",$count); ?>" value="1.5"/></td>
	<td align="center"><input type="radio" name="<?php printf("%s",$count); ?>" value="2"/></td>
	<td align="center"><input type="radio" name="<?php printf("%s",$count); ?>" value="2.5"/></td>
	<td align="center"><input type="radio" name="<?php printf("%s",$count); ?>" value="3"/></td>
	<td align="center"><input type="radio" name="<?php printf("%s",$count);$count++; ?>" value="4"/></td>
	</tr>

<?php
} while ($myrow = mysql_fetch_array($result));

} else {
 
}

mysql_close($con);
?>

</table>
<p align="center">
<input type="submit" name="submit" value="SUBMIT">
</p> 
</form>

</p>
</div>
<?php
require("footer.php");
?>
</body>
</html>

<?php

if ($_POST["submit"]){
$number=$_COOKIE["tn"];
require("../../library/connection.php");

$count=1;
$check=true;
$sql = "SELECT no FROM assignsatis WHERE project='$_COOKIE[pj]' AND task='$number' ORDER BY CAST(no AS UNSIGNED) ASC";
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
$sql = "SELECT no FROM assignsatis WHERE project='$_COOKIE[pj]' AND task='$number' ORDER BY CAST(no AS UNSIGNED) ASC";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){
do {

$sql5 = "SELECT * FROM score WHERE project='$_COOKIE[pj]' AND user='$_COOKIE[us]' AND question='$myrow[no]' AND task='$number'";
$result5 = mysql_query($sql5,$con);
if ($myrow5 = mysql_fetch_array($result5)){

$sql1="UPDATE score SET score='$_POST[$count]' WHERE project='$_COOKIE[pj]' AND user='$_COOKIE[us]' AND question='$myrow[no]' AND task='$number'";
if (!mysql_query($sql1,$con))
  {
  ?>
  <script type="text/javascript">
  alert("Error: <?php echo mysql_error() ?>");
  </script>
  <?php
  die();
  }
$count++;
} else {
 
$sql1="INSERT INTO score (user,score,task,project,question)
VALUES
('$_COOKIE[us]','$_POST[$count]','$number','$_COOKIE[pj]','$myrow[no]')";
if (!mysql_query($sql1,$con))
  {
  ?>
  <script type="text/javascript">
  alert("Error: <?php echo mysql_error() ?>");
  </script>
  <?php
  die();
  }
$count++;
}

} while ($myrow = mysql_fetch_array($result));

} else {
 
}
mysql_close($con);
?>
<script type="text/javascript">document.location.href='comment.php'</script>
<?php
}}
?>