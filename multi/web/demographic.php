<?php
if($_COOKIE["pj"]==NULL){
?>
<script type="text/javascript">document.location.href='login.php'</script>
<?php
}
?>
<html>
<link href="../../style/multistyle.css" rel="stylesheet" type="text/css"/>
<body>
<?php
require("header.php");
require("../../library/connection.php");
?>
<div id="main">
<div id="logo">
<div id="head">
</div>
<div id="content">
<p align="center" style="font-size:25pt"><b><br/><br/>Demographic Question</b><br/></p>
<p>
<form name="form" action="demographic.php" method="POST">
<p><span style="color:red">*</span> Field Required<br/></p>

<?php

$sql = "SELECT * FROM assigndemo WHERE project='$_COOKIE[pj]' ORDER BY CAST(id AS UNSIGNED) ASC";
$result = mysql_query($sql,$con);
$count =1;
if ($myrow = mysql_fetch_array($result)){
do {

$sql7 = "SELECT * FROM demographic WHERE id='$myrow[id]'";
$result7 = mysql_query($sql7,$con);
$myrow7 = mysql_fetch_array($result7);

$string = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow7["question"]);
$string = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string));

$rawend = explode("\n", $myrow7["answer"]);

$loop= count($rawend);
?>
<fieldset><p><span style="color:red">*</span><?php printf("%s",$count);?>. <?php printf("%s",$string); ?></p>
<p>
<?php

for($i=0;$i<$loop;$i++){
$rawend[$i]=trim($rawend[$i]);
?><input type="radio" name="a<?php printf("%s",$count);?>" value="<?php printf("%s",$rawend[$i]); ?>"><?php printf("%s",$rawend[$i]); ?><br/>
<?php
}$count++;
?></p></fieldset><p></p>
<?php
} while ($myrow = mysql_fetch_array($result));
} else { 
}
mysql_close($con);
?>
<p align="center">
<input type="submit" name="submit" value="SUBMIT"/>
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

require("../../library/connection.php");
$count=1;
$check=true;
$sql = "SELECT id FROM assigndemo WHERE project='$_COOKIE[pj]' ORDER BY CAST(id AS UNSIGNED) ASC";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){
do {
$newscore="a".$count; 
if($_POST["$newscore"]==NULL){
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
$sql = "SELECT id FROM assigndemo WHERE project='$_COOKIE[pj]' ORDER BY CAST(id AS UNSIGNED) ASC";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){
do {

$sql5 = "SELECT * FROM demoscore WHERE project='$_COOKIE[pj]' AND user='$_COOKIE[us]' AND question='$myrow[id]'";
$result5 = mysql_query($sql5,$con);
if ($myrow5 = mysql_fetch_array($result5)){

$newscore="a".$count;
$sql1="UPDATE demoscore SET score='$_POST[$newscore]' WHERE project='$_COOKIE[pj]' AND user='$_COOKIE[us]' AND question='$myrow[id]'";
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
$newscore="a".$count; 
$sql1="INSERT INTO demoscore (user,score,project,question)
VALUES
('$_COOKIE[us]','$_POST[$newscore]','$_COOKIE[pj]','$myrow[id]')";
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
<script type="text/javascript">document.location.href='task.php'</script>
<?php
}}
?>