<?php
if($_COOKIE[pj]==NULL){
?>
<script type="text/javascript">document.location.href='login.php'</script>
<?php
}
?>
<html>
<link href="../../style/design.css" rel="stylesheet" type="text/css"/>
<script language="javascript" type="text/javascript">
speed=1000;
len=40;
tid = 0;
num=0;
clockA = new Array();
timeA = new Array();
formatA = new Array();
dd = new Date();
var d,x;

function doDate(x)
{
  for (i=0;i<num;i++) {
    dt = new Date();
  
    if (timeA[i] != 0) {
      v1 = Math.round(( dt - timeA[i] )/1000) ;
      if (formatA[i] == 1)
        clockA[i].date.value = v1;
      else if (formatA[i] ==2) {
        sec = v1%60;
	v1 = Math.floor( v1/60);
	min = v1 %60 ;
	hour = Math.floor(v1 / 60);
	if (sec < 10 ) sec = "0"+sec;
	if (min < 10 ) min = "0"+min;
	clockA[i].date.value = hour+":"+min+":"+sec;
	document.sw.day.value = clockA[i].date.value;
        clockA[i].date.value = hour+"h "+min+"m "+sec+"";	
        }
      else if (formatA[i] ==3) {
        sec = v1%60;
	v1 = Math.floor( v1/60);
	min = v1 %60 ;
	v1 = Math.floor(v1 / 60);
	hour = v1 %24 ;
	day = Math.floor(v1 / 24);
	if (sec < 10 ) sec = "0"+sec;
	if (min < 10 ) min = "0"+min;
	if (hour < 10 ) hour = "0"+hour;
        clockA[i].date.value = day+"d "+hour+"h "+min+"m "+sec+"s";
   	}
      else if (formatA[i] ==4 ) {
        sec = v1%60;
	v1 = Math.floor( v1/60);
	min = v1 %60 ;
	v1 = Math.floor(v1 / 60);
	hour = v1 %24 ;
	day = Math.floor(v1 / 24);
        clockA[i].date.value = day+(day==1?"day ":"days ")+hour+(hour==1?"hour ":"hours ")+min+(min==1?"min ":"mins ")+sec+(sec==1?"sec ":"secs ")  
	}
      else
        clockA[i].date.value = "Invalid Format spec";
      }
    else
      clockA[i].date.value = "Countup from when?";
    }

  tid=window.setTimeout("doDate()",speed);

}

function start(d,x,format) {
  clockA[num] = x
  if (d == "now")
    timeA[num] = new Date();
  else
    timeA[num] = new Date(d);
  formatA[num] = format;
//window.alert(timeA[num]+":"+d);
  if (num == 0)  
    tid=window.setTimeout("doDate()",speed);
  num++;

}

function CountupLong(t,format,len)
{
  document.write('<FORM name=form'+num+'><input name=date size=')
  document.write(len)
  document.write(' type="hidden" value=""></FORM>')
  start(t,document.forms["form"+num],format);
}
</script>

<body topmargin="7" leftmargin="0" style="background-color: #ffaa50">
<script language="javascript">
  CountupLong("now",2,10);
</script>

<body style="background-color: #ffaa50">
<?php
require("../../library/connection.php");

$sql = "SELECT URL FROM project WHERE name='$_COOKIE[pj]'";
$result = mysql_query($sql,$con);

if ($myrow = mysql_fetch_array($result)){
do {

$link=$myrow["URL"];

} while ($myrow = mysql_fetch_array($result));

} else {
  
}

mysql_close($con);
require("header.php");
require("../../library/numberonly.php");
$counter=1;
?>
<script language="javascript"> 
if (window.screen) {
        w = window.screen.availWidth * 100 / 100;
        h = window.screen.availHeight * 78 / 100;
    }
timer=setTimeout("window.open('<?php echo "$link"; ?>','MyWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width='+w+',height='+h+',left=0px,top=0px')",1000)

function popup() {
    if (window.screen) {
        w = window.screen.availWidth * 100 / 100;
        h = window.screen.availHeight * 78 / 100;
    }
timer=setTimeout("window.open('<?php echo "$link"; ?>','MyWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width='+w+',height='+h+',left=0px,top=0px')",1000)
}
</script> 
<p align="center"><br/></br/>
Reopen URL<br/>( Make sure you allow pop-up for this site )<br/>
<a href="#" onClick="popup();"><?php echo "$link"; ?></a><br/>
</p>

<?php
require("../../library/connection.php");

$sql16 = "SELECT type FROM project WHERE name='$_COOKIE[pj]'";
$result16 = mysql_query($sql16,$con);
if ($myrow16 = mysql_fetch_array($result16)){
$pjtype=$myrow16["type"];

}

if($pjtype=="manual"){

?>
<form name="sw" action="hclock.php" method="POST">
<table align="center">
<tr>
<td><br/><input type="submit" name="rl" value="FINISH" onClick="return confirm('Are you sure?')"></td>
<td><input type="hidden" name="day" style="width:0mm"></td>
</tr>
</table>
</form>

<?php
}else if($pjtype=="remote"){
?>
<form name="sw" action="hclock.php" method="POST">

<h2 align="center"><u>QUESTION</u></h2>
<table align="center">
<?php
$count=1;
$sql = "SELECT * FROM p_question WHERE title='$_COOKIE[pj]' AND task='$_COOKIE[tn]' ORDER BY CAST(id AS UNSIGNED) ASC";
$result = mysql_query($sql,$con);
if ($myrow = mysql_fetch_array($result)){
do {

$string = preg_replace("(\r\n\r\n|\n\n|\r\r)", "<p />", $myrow["question"]);
$string = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", $string));
?>
	<tr>
	<td><?php printf("%s",$count);$count++; ?>) <?php printf("%s",$string); ?></td>
	</tr>
<?php
if($myrow["type"]=="Multiple Choice Question"){
$rawend = explode("\n", $myrow["selection"]);
$loop= count($rawend);
?>
	<tr>
	<td>
<?php
for($i=0;$i<$loop;$i++){
$rawend[$i]=trim($rawend[$i]);
	?><input type="radio" name="<?php printf("%s",$myrow[id]);?>" value="<?php printf("%s",$rawend[$i]); ?>"><?php printf("%s",$rawend[$i]); ?><br/><?php
}
?>
</td></tr>
<?php
}else{
?><tr><td><input type="text" name="<?php printf("%s",$myrow[id]);?>" style="width:60mm"></td></tr><?php
}
} while ($myrow = mysql_fetch_array($result));
} else {

}
mysql_close($con);
?>
</table>

<table align="center">
<tr>
<td><br/><input type="submit" name="rl" value="FINISH" onClick="return confirm('Are you sure?')"></td>
<td><input type="hidden" name="day" style="width:0mm"></td>
</tr>
</table>
</form>

<?php
}
?>
</body>
</html>