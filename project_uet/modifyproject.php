<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<script type="text/javascript">
function showUser(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","dmproject.php?q="+str,true);
xmlhttp.send();
}
</script>
<script>
    function docheck1(){
        if(document.form.rl.value==""){
        alert("Please enter the project url!");
        return false;
        }
	if(document.form.rl.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at project url input field.");
        return false;
	}
        if(document.form.pid.value==""){
        alert("Please select a project name!");
        return false;
        }
        if(document.form.end.value==""){
        alert("Please write tester involved!");
        return false;
        }
	if(document.form.end.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at tester involved input field.");
        return false;	
	}
	if(document.form.end.value.length>500){
	alert("Maximum characters can input for itester involved input field is 500");
        return false;	
	}
        if(document.form.todo.value==""){
        alert("Please write some introduction!");
        return false;
        }
	if(document.form.todo.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at introduction input field.");
        return false;	
	}
	if(document.form.todo.value.length>8000){
	alert("Maximum characters can input for introduction input field is 8000");
        return false;	
	}
    }
</script>
<fieldset>
<legend>User Experience Test -> Project -> Modify UET Project</legend>
<p></p>
<form name="form" action="modifyproject.php" method="POST" onsubmit="return docheck1()">
<table>
<tr>
<td>Project Name&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
<td>: <select name="pid" style="width:60mm" onchange="showUser(this.value)">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");
$sql = "SELECT name FROM project WHERE method_type='UET' ORDER BY name ASC";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){
do {
?>
	<option value="<?php printf("%s",$myrow["name"]); ?>"><?php printf("%s",$myrow["name"]); ?></option>
<?php
} while ($myrow = mysql_fetch_array($result));
} else {
	
}
mysql_close($con);
?>
</table>
<table>
<tr><td>
<div id="txtHint"></div>
</td></tr></table>
</form>
</fieldset>

</body>
</html>

<?php

if ($_POST['submit']){

require("../library/connection.php");
$sql="UPDATE project SET URL='$_POST[rl]', lead='$_POST[pl]', content='$_POST[todo]', resources='$_POST[end]', type='$_POST[type]' WHERE name='$_POST[pid]' AND method_type='UET'";
if (!mysql_query($sql,$con))
  {
  ?>
  <script type="text/javascript">
  alert("Error: <?php echo mysql_error() ?>");
  </script>
  <?php
  die();
  }

?>
<script type="text/javascript">
alert("UET Project name '<?php echo $_POST[pid] ?>' has been modified successfully!");
</script>
<?php

mysql_close($con);

}
?>