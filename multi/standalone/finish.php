<?php
if($_COOKIE["pj"]==NULL){
?>
<script type="text/javascript">document.location.href='login.php'</script>
<?php
}
?>
<html>
<link href="../../style/multistyle.css" rel="stylesheet" type="text/css"/>
<?php
require("header.php");
?>
<body>
<div id="main">
<div id="logo">
<div id="head">
</div>
<div id="content">
<p align="center" style="font-size:23pt"><b><br/><br/><br/>Thank You For Your Participation.<br/><br/>We Hope This Test Will Improve The Ease-Of-Use Of <?php printf("%s",$_COOKIE[pj]); ?> In The Future.<br/><br/>Have A Nice Day.</b></p>
</div>
<?php
require("footer.php");
?>
</body>
</html>