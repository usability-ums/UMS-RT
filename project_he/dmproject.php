<?php
$q=$_GET["q"];

require("../library/connection.php");

$sql="SELECT * FROM project WHERE name= '".$q."' AND method_type= 'HE'";

$result = mysql_query($sql);

while($row = mysql_fetch_array($result))
  {

  echo "<tr>";
  echo "<td>Test Environment &nbsp; </td>";
  echo "<td>: <input type='text' style='width:60mm' name='rl' value='". $row['URL'] ."'></td>";
  echo "<br/></tr>";
  echo "<tr>";
  echo "<td>Project Lead &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>";
  echo "<td>: <select style='width:60mm' name='pl'><option value='". $row['lead'] ."'>". $row['lead'] ."</option></td>";

$sql1 = "SELECT * FROM users WHERE role!='management' AND role!='developer' AND name!='$row[lead]' ORDER BY name ASC";
$result1 = mysql_query($sql1,$con);
if ($myrow1 = mysql_fetch_array($result1)){
do {
?>
	<option value="<?php printf("%s",$myrow1["name"]); ?>"><?php printf("%s",$myrow1["name"]); ?></option>
<?php
} while ($myrow1 = mysql_fetch_array($result1));
} else { } 

  echo "</select><br/></tr>";
  echo "<tr>";	
  echo "<td>Tester Involved &nbsp;</td>";
  echo "<td> &nbsp; &nbsp; :&nbsp;<textarea name='end' rows='5' cols='70'>". $row['resources'] ."</textarea></td>";
  echo "<br/></tr>";
  echo "<tr>";
  echo "<tr>";	
  echo "<td>Date Started &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>";
  echo "<td>: ".$row['date'] ."</td>";
  echo "<br/></tr>";
  echo "<tr>";
  echo "<td colspan='2'><br/> &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; <input type='submit' name='submit' value='UPDATE'><td>";
  echo "</tr>";  

  }

mysql_close($con);
?> 