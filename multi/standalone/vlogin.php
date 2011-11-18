<?php
if($_POST["id"]==NULL){
?>
<script type="text/javascript">document.location.href='login.php'</script>
<?php
}

require("../../library/connection.php");
//-----------------------------------------4
//check if user exist
$sql = "SELECT status FROM user WHERE project='$_POST[id]' AND user='$_POST[rl]' AND password='$_POST[tr]'";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){

$converter=strtolower($_POST[rl]);
setcookie("us", "$converter", time()+10800);
setcookie("pj", "$_POST[id]", time()+10800);

//------------------------------------3
//if yes check if user completed any task
$sql1 = "SELECT task FROM time WHERE project='$_POST[id]' AND user='$_POST[rl]'";
$result1 = mysql_query($sql1,$con);
if ($myrow1 = mysql_fetch_array($result1)){

//find until what task have complete
$sql8 = "SELECT COUNT(DISTINCT task) AS t_points FROM time WHERE project='$_POST[id]' AND user='$_POST[rl]'"; 
$result8 = mysql_query($sql8) or die(mysql_error()); 
$it = mysql_fetch_array($result8);

//-------------------------------2
//find if user complete satisfaction
$sql3 = "SELECT score FROM score WHERE project='$_POST[id]' AND user='$_POST[rl]' AND task='$it[t_points]'";
$result3 = mysql_query($sql3,$con);
if ($myrow3 = mysql_fetch_array($result3)){


//------------------1
//find if user complete thinkaloud
$sql7 = "SELECT answer FROM thinkaloud WHERE PName='$_POST[id]' AND user='$_POST[rl]' AND task='$it[t_points]'";
$result7 = mysql_query($sql7,$con);
if ($myrow7 = mysql_fetch_array($result7)){

$pt=$it[t_points]+1;
setcookie("tn", "$pt", time()+10800);

?>
<script type="text/javascript">
document.location.href='task.php'
</script>
<?php
//if not complete thinkaloud go thinkaloud
}else{
setcookie("tn", "$it[t_points]", time()+10800);
?>
<script type="text/javascript">
document.location.href='comment.php'
</script>
<?php
}
//--------------------1

//if not complete satisfaction go satisfaction
}else{
setcookie("tn", "$it[t_points]", time()+10800);
?>
<script type="text/javascript">
document.location.href='question.php'
</script>
<?php
}
//-------------------------2

//if not complete any task
}else{
setcookie("tn", "1", time()+10800);

//---------------2.5
//check if user complete demographic
$sql4 = "SELECT score FROM demoscore WHERE project='$_POST[id]' AND user='$_POST[rl]'";
$result4 = mysql_query($sql4,$con);
if ($myrow4 = mysql_fetch_array($result4)){

?>
<script type="text/javascript">
document.location.href='task.php'
</script>
<?php

}
//if not complete demographic
else{
?>
<script type="text/javascript">
document.location.href='introduction.php'
</script>
<?php
}
//---------------2.5

}
//-------------------------------3

//if user not exist
} else{
?>
<script type="text/javascript">
alert("Username or password wrong, please try again.");
document.location.href='login.php'
</script>
<?php
}
//-----------------------------------------4
?>