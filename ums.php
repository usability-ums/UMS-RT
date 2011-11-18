<?php
if($_COOKIE["rl"]==NULL){
?>
<script type="text/javascript">
if(top!=self){
top.location=self.location;
}
</script>
<script type="text/javascript">document.location.href='logout.php'</script>
<?php
}
?>
<html>
<head>
	<title>Usability Management System</title>
</head>

	<frameset rows="9%,*,3%" border="0">
		<frame src="library/header.php" marginheight="1" scrolling="no" noresize="noresize"/>
		<frame src="home/introduction.php" name="home" marginheight="1" scrolling="yes" noresize="noresize"/>
	<frame src="library/footer.php" marginheight="0" scrolling="no" noresize="noresize"/>
	</frameset>

</html>