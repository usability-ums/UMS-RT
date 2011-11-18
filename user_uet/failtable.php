<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<?php
require("../library/connection.php");

$sql="UPDATE user SET complete='fail' WHERE project='$_GET[prop_id]' AND user='$_GET[prop_un]'";
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
alert("Username '<?php echo $_GET[prop_un] ?>' have fail this UET!");
document.location.href='failuser.php'
</script>
</body>
</html>