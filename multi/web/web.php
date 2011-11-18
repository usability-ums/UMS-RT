<?php
if($_COOKIE["pj"]==NULL){
?>
<script type="text/javascript">document.location.href='login.php'</script>
<?php
}
?>
<html>
<?php
require("header.php");
?>
	<frameset rows="90%,*" border="0">
		  <frame src="none.php" name="link" noresize="noresize"/>
		  <frame src="itask.php" name="home" noresize="noresize"/>
	      </frameset>		  
	</frameset>
</html>