<?php
require("../library/duration.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<?php
require("../library/connection.php");

$sql="DELETE FROM assigndemo WHERE id='$_GET[prop_id]' AND project='$_GET[pj_id]'";

if (!mysql_query($sql,$con))
  {
  ?>
  <script type="text/javascript">
  alert("Error: <?php echo mysql_error() ?>");
  </script>
  <?php
  die();
  }

mysql_close($con);
?> 
<script type="text/javascript">
alert("Unassign successfully!");
document.location.href='unassigndemographic.php'
</script>
</body>
</html>