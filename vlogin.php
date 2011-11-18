<?php
if($_POST["username"]==NULL){
?>
<script type="text/javascript">document.location.href='login.php'</script>
<?php
}

require("library/connection.php");

$sql = "SELECT * FROM users WHERE email='$_POST[username]' AND password='$_POST[password]'";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){

setcookie("us", "$_POST[username]", time()+43200);
setcookie("rl", "$myrow[role]", time()+43200);
setcookie("un", "$myrow[name]", time()+43200);

date_default_timezone_set( 'Asia/Kuala_Lumpur' );
$handle = date('d-m-Y hisa D');
$ip=$_SERVER['REMOTE_ADDR'];

$sql="INSERT INTO accesslog (name,action,date,ip)
VALUES
('$_POST[username]','login','$handle','$ip')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

?>
<script type="text/javascript">
document.location.href='ums.php'
</script>
<?php

}else{

?>
<script type="text/javascript">
alert("Username or password wrong, please try again.");
document.location.href='login.php'
</script>
<?php
}
?>