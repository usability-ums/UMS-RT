<?php
if($_COOKIE["pj"]==NULL){
?>
<script type="text/javascript">document.location.href='login.php'</script>
<?php
}

setcookie("tn", "$_POST[tr]", time()+360000);

function myAddSlashes($text) {
	if(get_magic_quotes_gpc())
		return $text;
	else
		return addslashes($text);		
}

$number=$_POST["tr"]-1;
require("../../library/connection.php");

$sql = "SELECT count(no) as total FROM task WHERE PName='$_COOKIE[pj]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

$check=$myrow["total"];

} while ($myrow = mysql_fetch_array($result));

} else {

}

$convert=myAddSlashes($_POST["answer"]);

$sql6 = "SELECT * FROM task WHERE PName='$_COOKIE[pj]' AND no='$number'";
$result6 = mysql_query($sql6,$con);

if ($myrow6 = mysql_fetch_array($result6)){


$sql="INSERT INTO thinkaloud (PName,task,answer,user)
VALUES
('$_COOKIE[pj]','$number','$convert','$_COOKIE[us]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

}else{

}

mysql_close($con);

if($check==$number){
?>
<script type="text/javascript">document.location.href='debriefing.php'</script>
<?php
}else{
?>
<script type="text/javascript">document.location.href='task.php'</script>
<?php
}
?>