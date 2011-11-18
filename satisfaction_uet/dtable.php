<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<?php
require("../library/connection.php");

$sql="DELETE FROM satisfaction WHERE no='$_GET[prop_id]'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

mysql_close($con);
?> 
<script type="text/javascript">
alert("The question have been deleted!");
document.location.href='table.php'
</script>
</body>
</html>