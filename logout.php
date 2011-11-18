<?php

setcookie("us", "",time()-43200); 
setcookie("rl", "",time()-43200); 
setcookie("un", "",time()-43200); 

session_start();

?>
<script type="text/javascript">
if(top!=self){
top.location=self.location;
}
</script>
<?php
session_destroy();
?>
<meta http-equiv="refresh" content="0; url=index.php">
<html>
<title>Usability Management System (UMS)</title>
<link href="style/design.css" rel="stylesheet" type="text/css"/>	
<body>
</body>
</html>
