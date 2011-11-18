<?php
if($_COOKIE["pj"]==NULL){
?>
<script type="text/javascript">document.location.href='login.php'</script>
<?php
}

require("../../library/connection.php");

$sql = "SELECT * FROM task WHERE PName='$_COOKIE[pj]' AND no='$_COOKIE[tn]'";
$result = mysql_query($sql,$con);

if ($myrow1 = mysql_fetch_array($result)){

$sql2="INSERT INTO time (user,task,project,time)
VALUES
('$_COOKIE[us]','$_COOKIE[tn]','$_COOKIE[pj]','$_POST[day]')";

if (!mysql_query($sql2,$con)){
}else{}

}else{}

$sql16 = "SELECT type FROM project WHERE name='$_COOKIE[pj]'";
$result16 = mysql_query($sql16,$con);
if ($myrow16 = mysql_fetch_array($result16)){
$pjtype=$myrow16["type"];

}

if($pjtype=="manual"){

}else if($pjtype=="remote"){

function myAddSlashes($text) {
	if(get_magic_quotes_gpc())
		return $text;
	else
		return addslashes($text);		
}

$sql = "SELECT * FROM p_question WHERE title='$_COOKIE[pj]' AND task='$_COOKIE[tn]' ORDER BY CAST(id AS UNSIGNED) ASC";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){
do {
$code=$myrow["id"];
$convert=myAddSlashes($_POST["$code"]);
$sql2="INSERT INTO a_question (id,project,name,task,answer)
VALUES
('$myrow[id]','$_COOKIE[pj]','$_COOKIE[us]','$_COOKIE[tn]','$convert')";

if (!mysql_query($sql2,$con))
{}else{}

} while ($myrow = mysql_fetch_array($result));

} else {
 
}

}
mysql_close($con);
?>
<script type="text/javascript">document.location.href='question.php'</script>