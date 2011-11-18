<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<?php
require("../library/connection.php");

$sql="UPDATE project SET security='lock' WHERE name='$_GET[prop_id]' AND method_type='UET'";
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
alert("UET project name '<?php echo $_GET[prop_id] ?>' has been 'Lock'!");
document.location.href='lockproject.php'
</script>
</body>
</html>