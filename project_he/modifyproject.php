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
        alert("Please enter the test environment!");
        return false;
        }
	if(document.form.rl.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at test environment input field.");
        return false;
	}
        if(document.form.end.value==""){
        alert("Please write down tester involved!");
        return false;
        }
	if(document.form.end.value.match("'")){
	alert("Symbol ' can not be use!\nLocation at tester involved input field.");
        return false;	
	}
	if(document.form.end.value.length>1000){
	alert("Maximum characters can input for tester involved input field is 1000!");
        return false;	
	}
    }
</script>
<fieldset>
<legend>Heuristics Evaluation -> Project -> Modify HE Project</legend>
<p></p>
<form name="form" action="modifyproject.php" method="POST" onsubmit="return docheck1()">
<table>
<tr>
<td>Project Name &nbsp; &nbsp; &nbsp; &nbsp; </td>
<td>: <select name="pid" style="width:60mm" onchange="showUser(this.value)">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");
$sql = "SELECT name FROM project WHERE method_type='HE' ORDER BY name ASC";
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
$sql="UPDATE project SET URL='$_POST[rl]', lead='$_POST[pl]', resources='$_POST[end]' WHERE name='$_POST[pid]' AND method_type='HE'";
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
alert("HE project name '<?php echo $_POST[pid] ?>' has been modified successfully!");
</script>
<?php

mysql_close($con);

}
?>