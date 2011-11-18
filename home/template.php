<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>Home -> Template</legend>
<?php
require("../library/connection.php");
$sql = "SELECT ip FROM data";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){
$ip=$myrow["ip"];
}
?>
<p>1) <a href="http://<?php printf("%s",$ip); ?>/multi/web" target="_black"> Login Page for Web Base User Experience Test</a><br/></p>
<p>2) <a href="http://<?php printf("%s",$ip); ?>/multi/standalone" target="_black"> Login Page for Standalone Application User Experience Test</a><br/></p>
</fieldset>
</body>
</html>

