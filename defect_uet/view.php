<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<?php
require("../library/connection.php");
$sql="UPDATE defect SET status='$_POST[st]', scrubbingnote='$_POST[nt]' WHERE id='$_POST[id]'";
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "<p>Defect has been \"$_POST[id]\" modified successfully!</p>";
mysql_close($con);
?>
</body>
</html>