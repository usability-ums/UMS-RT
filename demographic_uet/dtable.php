<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<?php
require("../library/connection.php");

$sql="DELETE FROM demographic WHERE id='$_GET[prop_id]'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

mysql_close($con);
?> 
<script type="text/javascript">
alert("The question have been deleted!");
document.location.href='modifydemographic.php'
</script>
</body>
</html>