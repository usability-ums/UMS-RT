<?php
require("../library/duration.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<?php
require("../library/connection.php");

$sql="DELETE FROM task WHERE no='$_GET[prop_id]' AND PName='$_GET[pj_id]'";

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
alert("Task No '<?php echo $_GET[prop_id] ?>' for '<?php echo $_GET[pj_id] ?>' project has been deleted successfully!");
document.location.href='table.php'
</script>
</body>
</html>