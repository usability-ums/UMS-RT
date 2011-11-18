<?php
require("../library/navigation.php");
?>
<html>
<link href="../style/design.css" rel="stylesheet" type="text/css"/>
<body>
<fieldset>
<legend>User Experience Test -> Project -> Project Checklist</legend>
<p></p>
<script type="text/javascript" src="../js/formfieldlimiter.js">

/***********************************************
* Form field Limiter v2.0- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com for full source code
***********************************************/

</script>
<script>
    function doCheck(){
        if(document.form1.pid.value==""){
        alert("Please select a project name!");
        return false;
        }
    }
</script>
<form name="form1" action="checklist.php" method="POST" onsubmit="return doCheck()">
<table>
<tr>
<td>Project Name</td>
<td>: <select name="pid" style="width:60mm">
<option value=""> - SELECT PROJECT NAME -</option>
<?php
require("../library/connection.php");

$sql = "SELECT name FROM project WHERE method_type='UET'";
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

</select>
</td>
<td>
<input type="submit" name="submit" value="SEARCH">
</td> 
</tr>
</table>

<?php
if($_POST[pid] !=""){
$counter=0;
require("../library/connection.php");

$sql = "SELECT * FROM project WHERE name='$_POST[pid]' AND method_type='UET'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
$type=$myrow[type];
}

$sql = "SELECT * FROM task WHERE PName='$_POST[pid]'";
$result = mysql_query($sql,$con);
	?><p><br/><b><u><?php printf("%s",$_POST[pid]); ?></b></u></p>
	
<?php
if ($myrow = mysql_fetch_array($result)){


}else {
	echo "<p><font color=\"red\">ALERT! No task has been created!</font><br/>Solution: Go to <b><font color=\"green\">User Experience Test -> Task -> </font><a href=\"../task_uet/addtask.php\" target=\"home\" >Add New Task</b></a> to create task.</p>";
	$counter++;	 
}


$sql = "SELECT * FROM assigndemo WHERE project='$_POST[pid]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){


}else {
	echo "<p><font color=\"red\">ALERT! No demographic question has been assigned!</font><br/>Solution: Go to <b><font color=\"green\">User Experience Test -> Demographic -> </font><a href=\"../demographic_uet/assigndemographic.php\" target=\"home\" >Assign Question</b></a> to assign question.</p>";
	$counter++;	 
}



$sql = "SELECT * FROM assignsatis WHERE project='$_POST[pid]'";
$result = mysql_query($sql,$con);
	
if ($myrow = mysql_fetch_array($result)){


}else {
	echo "<p><font color=\"red\">ALERT! No satisfaction question has been assigned!</font><br/>Solution: Go to <b><font color=\"green\">User Experience Test -> Satisfaction -> </font><a href=\"../satisfaction_uet/assignquestion.php\" target=\"home\" >Assign Question</b></a> to assign question.</p>";
	$counter++;	 
}

$sql = "SELECT * FROM assigndef WHERE project='$_POST[pid]'";
$result = mysql_query($sql,$con);
	
if ($myrow = mysql_fetch_array($result)){


}else {
	echo "<p><font color=\"red\">ALERT! No debriefing question has been assigned!</font><br/>Solution: Go to <b><font color=\"green\">User Experience Test -> Debriefing -> </font><a href=\"../debriefing_uet/assigndebriefing.php\" target=\"home\" >Assign Question</b></a> to assign question.</p>";
	$counter++;	 
}

$sql = "SELECT * FROM user WHERE project='$_POST[pid]'";
$result = mysql_query($sql,$con);
	
if ($myrow = mysql_fetch_array($result)){


}else {
	echo "<p><font color=\"red\">ALERT! No user account has been created!</font><br/>Solution: Go to <b><font color=\"green\">User Experience Test -> User -> </font><a href=\"../user_uet/adduser.php\" target=\"home\" >Add New User</b></a> to add new user account.</p>";
	$counter++;	 
}

if($type=="remote"){

$sql = "SELECT * FROM p_question WHERE title='$_POST[pid]'";
$result = mysql_query($sql,$con);
	
if ($myrow = mysql_fetch_array($result)){

}else {
	echo "<p><font color=\"red\">ALERT! No probe question has been added!</font><br/>Solution: Go to <b><font color=\"green\">User Experience Test -> Probe Question -> </font><a href=\"../probe/addmtquestion.php\" target=\"home\" >Add Multiple Choice Question</b></a> to add question.</p>";
	$counter++;	 
}

}

if($type=="manual"){

$sql = "SELECT * FROM assigneffectiveness WHERE project='$_POST[pid]'";
$result = mysql_query($sql,$con);
	
if ($myrow = mysql_fetch_array($result)){


}else {
	echo "<p><font color=\"red\">ALERT! No effectiveness question has been assigned!</font><br/>Solution: Go to <b><font color=\"green\">User Experience Test -> Effectiveness -> </font><a href=\"../effectiveness_uet/assigneffectiveness.php\" target=\"home\" >Assign Question</b></a> to assign question.</p>";
	$counter++;	 
}

$sql = "SELECT * FROM assignefficiency WHERE project='$_POST[pid]'";
$result = mysql_query($sql,$con);
	
if ($myrow = mysql_fetch_array($result)){


}else {
	echo "<p><font color=\"red\">ALERT! No efficiency question has been assigned!</font><br/>Solution: Go to <b><font color=\"green\">User Experience Test -> Efficiency -> </font><a href=\"../efficiency_uet/assignefficiency.php\" target=\"home\" >Assign Question</b></a> to assign question.</p>";
	$counter++;	 
}

}

mysql_close($con);

if($counter=="0"){
require("../library/connection.php");
$sql = "SELECT ip FROM data";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){
$ip=$myrow["ip"];
}

echo "<p>Congratulations!<br/>
You have completed the minimum requirement to active the project but there is some recommendation for you.<br/>
1) Do pilot run before ask the actual user to perform.<br/>
2) Request administrator to delete dummy data from pilot run before start User Experience Test (UET).<br/>
3) Request administrator to lock the project so no more modification can be done to the project. (To avoid unusual system behavior)<br/><br/>

<u>User Experience Test URL</u><br/>
<b>Web base project -></b> <a href=\"http://$ip/multi/web\" target=\"_blank\">http://$ip/multi/web</a><br/>
<b>Standalone project -></b> <a href=\"http://$ip/multi/standalone\" target=\"_blank\">http://$ip/multi/standalone</a>
</p>";

}else{

echo "<p>There are <font color=\"red\"><b>$counter Alert</b></font>, please resolve all the item before activate the project.</p>";

}

} else {}
?>
</form>
</fieldset>
</body>
</html>
