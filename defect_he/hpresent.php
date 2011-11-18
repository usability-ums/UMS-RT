<?php
setcookie("temp1", "$_POST[hd1]", time()+3);

require("../library/connection.php");

function myAddSlashes($text) {
	if(get_magic_quotes_gpc())
		return $text;
	else
		return addslashes($text);		
}

date_default_timezone_set( 'Asia/Kuala_Lumpur' );
$handle = date('d-m-Y D hisa');
$note=myAddSlashes($_POST["nt"]);

if($_POST[st]=="Rejected"||$_POST[st]=="Duplicate"){
$sql="UPDATE defect SET state='$_POST[st]', scrubbingnote='$note',status='$_POST[st]' WHERE id='$_POST[id]'";
if (!mysql_query($sql,$con))
  {
?>
<script type="text/javascript">
alert("Error: <?php echo mysql_error() ?>");
</script>
<?php
die();
  }
}else if($_POST[st]=="Accepted"){
$sql="UPDATE defect SET state='$_POST[st]', scrubbingnote='$note',status='Opened' WHERE id='$_POST[id]'";
if (!mysql_query($sql,$con))
  {
?>
<script type="text/javascript">
alert("Error: <?php echo mysql_error() ?>");
</script>
<?php
die();
  }
}else if($_POST[st]=="KIV"){
$sql="UPDATE defect SET state='$_POST[st]', scrubbingnote='$note',status='KIV' WHERE id='$_POST[id]'";
if (!mysql_query($sql,$con))
  {
?>
<script type="text/javascript">
alert("Error: <?php echo mysql_error() ?>");
</script>
<?php
die();
  }
}

$ip=$_SERVER['REMOTE_ADDR'];

$sql="INSERT INTO defectlog (id,chgby,action,date,ip)
VALUES
('$_POST[id]','$_COOKIE[us]','$_POST[st]','$handle','$ip')";

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
alert("Defect has been '<?php echo $_POST[id] ?>' modified successfully!");
document.location.href='present.php'
</script>
<?php

mysql_close($con);
?>