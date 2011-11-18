<?php
if($_COOKIE["rl"]==NULL){
?>
<script type="text/javascript">
if(top!=self){
top.location=self.location;
}
</script>
<script type="text/javascript">document.location.href='../logout.php'</script>
<?php
}
?>
<html>
<link rel="stylesheet" type="text/css" href="../style/dropmenu.css" />

<script src="../js/dropmenu.js" type="text/javascript"></script>
<body>
<?php
if($_COOKIE["rl"]=="admin" || $_COOKIE["rl"]=="supervisor"){
?>
<ul id="nav">

<li class="top"><a href="#" class="top_link"><span>Home</span></a>
<ul class="sub">
	<li><a href="../home/introduction.php" target="home">Introduction</a></li>
	<li><a href="../home/template.php" target="home">Template</a></li>
</ul>
</li>

<li class="top"><a href="#" class="top_link"><span>Heuristic Evaluation</span></a>
<ul class="sub">
	<li><a href="#" class="fly">Project</a>
		<ul>
			<li><a href="../project_he/addproject.php" target="home">Add HE Project</a></li>
			<li><a href="../project_he/modifyproject.php" target="home">Modify HE Project</a></li>
			<li><a href="../project_he/deleteproject.php" target="home">Delete HE Project</a></li>
			<li><a href="../project_he/listproject.php" target="home">List of Project</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Defect</a>
		<ul>
			<li><a href="../defect_he/adddefect.php" target="home">Add Defect</a></li>
			<li><a href="../defect_he/table.php" target="home">Modify Defect</a></li>
			<li><a href="../defect_he/present.php" target="home">Present Defect</a></li>
			<li><a href="../defect_he/vtable.php" target="home">Verify Defect</a></li>
			<li><a href="../defect_he/convert.php" target="home">Convert Defect</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Result</a>
		<ul>
			<li><a href="../result_he/defectpr.php" target="home">Problem Report Result</a></li>
			<li><a href="../result_he/defectcr.php" target="home">Change Request Result</a></li>
		</ul>
	</li>
</ul>
</li>

<li class="top"><a href="#" class="top_link"><span>User Experience Test</span></a>
<ul class="sub">
	<li><a href="#" class="fly">Project</a>
		<ul>
			<li><a href="../project_uet/addproject.php" target="home">Add UET Project</a></li>
			<li><a href="../project_uet/modifyproject.php" target="home">Modify UET Project</a></li>
			<li><a href="../project_uet/deleteproject.php" target="home">Delete UET Project</a></li>
			<li><a href="../project_uet/lockproject.php" target="home">Lock/Unlock Project</a></li>
			<li><a href="../project_uet/activeproject.php" target="home">Active/Deactive Project</a></li>
			<li><a href="../project_uet/checklist.php" target="home">Project Checklist</a></li>
			<li><a href="../project_uet/listproject.php" target="home">List of Project</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Task</a>
		<ul>
			<li><a href="../task_uet/addtask.php" target="home">Add New Task</a></li>
			<li><a href="../task_uet/table.php" target="home">Modify/Delete Task</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Demographic</a>
		<ul>
			<li><a href="../demographic_uet/adddemographic.php" target="home">Add New Question</a></li>
			<li><a href="../demographic_uet/modifydemographic.php" target="home">Modify/Delete Question</a></li>
			<li><a href="../demographic_uet/assigndemographic.php" target="home">Assign Question</a></li>
			<li><a href="../demographic_uet/unassigndemographic.php" target="home">Remove Assign Question</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Satisfaction</a>
		<ul>
			<li><a href="../satisfaction_uet/addcategory.php" target="home">Add New Category</a></li>
			<li><a href="../satisfaction_uet/deletecategory.php" target="home">Delete Category</a></li>
			<li><a href="../satisfaction_uet/addsatisfaction.php" target="home">Add New Question</a></li>
			<li><a href="../satisfaction_uet/table.php" target="home">Modify/Delete Question</a></li>
			<li><a href="../satisfaction_uet/assignquestion.php" target="home">Assign Question</a></li>
			<li><a href="../satisfaction_uet/removeassignquestion.php" target="home">Remove Assign Question</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Effectiveness</a>
		<ul>
			<li><a href="../effectiveness_uet/addeffectiveness.php" target="home">Add New Question</a></li>
			<li><a href="../effectiveness_uet/modifyeffectiveness.php" target="home">Modify/Delete Question</a></li>
			<li><a href="../effectiveness_uet/assigneffectiveness.php" target="home">Assign Question</a></li>
			<li><a href="../effectiveness_uet/removeassigneffectiveness.php" target="home">Remove Assign Question</a></li>
			<li><a href="../effectiveness_uet/addeffectivenessanswer.php" target="home">Set User Score</a></li>
			<li><a href="../effectiveness_uet/modifyeffectivenessanswer.php" target="home">Modify User Score</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Efficiency</a>
		<ul>
			<li><a href="../efficiency_uet/addefficiency.php" target="home">Add New Question</a></li>
			<li><a href="../efficiency_uet/modifyefficiency.php" target="home">Modify/Delete Question</a></li>
			<li><a href="../efficiency_uet/assignefficiency.php" target="home">Assign Question</a></li>
			<li><a href="../efficiency_uet/removeassignefficiency.php" target="home">Remove Assign Question</a></li>
			<li><a href="../efficiency_uet/addefficiencyanswer.php" target="home">Set User Score</a></li>
			<li><a href="../efficiency_uet/modifyefficiencyanswer.php" target="home">Modify User Score</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Debriefing</a>
		<ul>
			<li><a href="../debriefing_uet/adddebriefing.php" target="home">Add New Question</a></li>
			<li><a href="../debriefing_uet/modifydebriefing.php" target="home">Modify/Delete Question</a></li>
			<li><a href="../debriefing_uet/assigndebriefing.php" target="home">Assign Question</a></li>
			<li><a href="../debriefing_uet/removeassigndebriefing.php" target="home">Remove Assign Question</a></li>			
		</ul>
	</li>
	<li><a href="#" class="fly">User</a>
		<ul>
			
			<li><a href="../user_uet/adduser.php" target="home">Add New User</a></li>
			<li><a href="../user_uet/deleteuser.php" target="home">Delete User</a></li>
			<li><a href="../user_uet/failuser.php" target="home">Mark Incompleted User</a></li>
			<li><a href="../user_uet/lockscore.php" target="home">Lock/Unlock User</a></li>		
		</ul>
	</li>
	<li><a href="#" class="fly">Mouse Click</a>
		<ul>
			<li><a href="../mouseclick/addmouseclickanswer.php" target="home">Set Mouse Click</a></li>
			<li><a href="../mouseclick/modifymouseclickanswer.php" target="home">Modify Mouse Click</a></li>	
		</ul>
	</li>
	<li><a href="#" class="fly">Probe Question</a>
		<ul>
			<li><a href="../probe/addmtquestion.php" target="home">Add Multiply Choice Question</a></li>
			<li><a href="../probe/addopquestion.php" target="home">Add Open Question</a></li>
			<li><a href="../probe/modifyquestion.php" target="home">Modify/Delete Question</a></li>			
		</ul>
	</li>
	<li><a href="#" class="fly">Defect</a>
		<ul>
			<li><a href="../defect_uet/adddefect.php" target="home">Add Defect</a></li>
			<li><a href="../defect_uet/table.php" target="home">Modify Defect</a></li>
			<li><a href="../defect_uet/present.php" target="home">Present Defect</a></li>
			<li><a href="../defect_uet/vtable.php" target="home">Verify Defect</a></li>
			<li><a href="../defect_uet/convert.php" target="home">Convert Defect</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Result</a>
		<ul>
			<li><a href="../result_uet/demographicresult.php" target="home">Demographic Result</a></li>
			<li><a href="../result_uet/satisfactionresult.php" target="home">Satisfaction Result</a></li>
			<li><a href="../result_uet/thinkaloudresult.php" target="home">Think Aloud Result</a></li>
			<li><a href="../result_uet/debriefingresult.php" target="home">Debriefing Result</a></li>
			<li><a href="../result_uet/timeresult.php" target="home">Timing Result</a></li>
			<li><a href="../result_uet/effectivenessresult.php" target="home">Effectiveness Result</a></li>
			<li><a href="../result_uet/efficiencyresult.php" target="home">Efficiency Result</a></li>
			<li><a href="../result_uet/mouseclick.php" target="home">Mouse Click Result</a></li>
			<li><a href="../result_uet/overall.php" target="home">Overall Result</a></li>
			<li><a href="../result_uet/progress.php" target="home">Progress Result</a></li>
			<li><a href="../result_uet/defectpr.php" target="home">Problem Report Result</a></li>
			<li><a href="../result_uet/defectcr.php" target="home">Change Request Result</a></li>
		</ul>
	</li>

</ul>
</li>

<li class="top"><a href="#" class="top_link"><span>Audit</span></a>
<ul class="sub">
	<li><a href="../audit/access.php" target="home">Access Log</a></li>
	<li><a href="../audit/defect.php" target="home">Defect Log</a></li>
</ul>
</li>

<li class="top"><a href="#" class="top_link"><span>User</span></a>
<ul class="sub">
	<li><a href="../user/addumsuser.php" target="home">Add UMS Account</a></li>
	<li><a href="../user/modifyuser.php" target="home">Modify/Delete UMS Account</a></li>
</ul>
</li>

</ul>

<?php
}else if($_COOKIE["rl"]=="management"){
?>

<ul id="nav">

<li class="top"><a href="#" class="top_link"><span>Home</span></a>
<ul class="sub">
	<li><a href="../home/introduction.php" target="home">Introduction</a></li>
</ul>
</li>

<li class="top"><a href="#" class="top_link"><span>Heuristic Evaluation</span></a>
<ul class="sub">
	<li><a href="#" class="fly">Project</a>
		<ul>
			<li><a href="../project_he/listproject.php" target="home">List of Project</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Result</a>
		<ul>
			<li><a href="../result_he/defectpr.php" target="home">Problem Report Result</a></li>
			<li><a href="../result_he/defectcr.php" target="home">Change Request Result</a></li>
		</ul>
	</li>
</ul>
</li>

<li class="top"><a href="#" class="top_link"><span>User Experience Test</span></a>
<ul class="sub">
	<li><a href="#" class="fly">Project</a>
		<ul>
			<li><a href="../project_uet/listproject.php" target="home">List of Project</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Result</a>
		<ul>
			<li><a href="../result_uet/demographicresult.php" target="home">Demographic Result</a></li>
			<li><a href="../result_uet/satisfactionresult.php" target="home">Satisfaction Result</a></li>
			<li><a href="../result_uet/thinkaloudresult.php" target="home">Think Aloud Result</a></li>
			<li><a href="../result_uet/debriefingresult.php" target="home">Debriefing Result</a></li>
			<li><a href="../result_uet/timeresult.php" target="home">Timing Result</a></li>
			<li><a href="../result_uet/effectivenessresult.php" target="home">Effectiveness Result</a></li>
			<li><a href="../result_uet/efficiencyresult.php" target="home">Efficiency Result</a></li>
			<li><a href="../result_uet/mouseclick.php" target="home">Mouse Click Result</a></li>
			<li><a href="../result_uet/overall.php" target="home">Overall Result</a></li>
			<li><a href="../result_uet/progress.php" target="home">Progress Result</a></li>
			<li><a href="../result_uet/defectpr.php" target="home">Problem Report Result</a></li>
			<li><a href="../result_uet/defectcr.php" target="home">Change Request Result</a></li>
		</ul>
	</li>

</ul>
</li>

</ul>

<?php
}else if($_COOKIE["rl"]=="developer"){
?>

<ul id="nav">

<li class="top"><a href="#" class="top_link"><span>Home</span></a>
<ul class="sub">
	<li><a href="../home/introduction.php" target="home">Introduction</a></li>
</ul>
</li>

<li class="top"><a href="#" class="top_link"><span>Heuristic Evaluation</span></a>
<ul class="sub">
	<li><a href="#" class="fly">Project</a>
		<ul>
			<li><a href="../project_he/listproject.php" target="home">List of Project</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Defect</a>
		<ul>
			<li><a href="../defect_he/dtable.php" target="home">Manage Defect</a></li>
			<li><a href="../defect_he/dpresent.php" target="home">View Defect</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Result</a>
		<ul>
			<li><a href="../result_he/defectpr.php" target="home">Problem Report Result</a></li>
			<li><a href="../result_he/defectcr.php" target="home">Change Request Result</a></li>
		</ul>
	</li>
</ul>
</li>

<li class="top"><a href="#" class="top_link"><span>User Experience Test</span></a>
<ul class="sub">
	<li><a href="#" class="fly">Project</a>
		<ul>
			<li><a href="../project_uet/listproject.php" target="home">List of Project</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Defect</a>
		<ul>
			<li><a href="../defect_uet/dtable.php" target="home">Manage Defect</a></li>
			<li><a href="../defect_uet/dpresent.php" target="home">View Defect</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Result</a>
		<ul>
			<li><a href="../result_uet/demographicresult.php" target="home">Demographic Result</a></li>
			<li><a href="../result_uet/satisfactionresult.php" target="home">Satisfaction Result</a></li>
			<li><a href="../result_uet/thinkaloudresult.php" target="home">Think Aloud Result</a></li>
			<li><a href="../result_uet/debriefingresult.php" target="home">Debriefing Result</a></li>
			<li><a href="../result_uet/timeresult.php" target="home">Timing Result</a></li>
			<li><a href="../result_uet/effectivenessresult.php" target="home">Effectiveness Result</a></li>
			<li><a href="../result_uet/efficiencyresult.php" target="home">Efficiency Result</a></li>
			<li><a href="../result_uet/mouseclick.php" target="home">Mouse Click Result</a></li>
			<li><a href="../result_uet/overall.php" target="home">Overall Result</a></li>
			<li><a href="../result_uet/progress.php" target="home">Progress Result</a></li>
			<li><a href="../result_uet/defectpr.php" target="home">Problem Report Result</a></li>
			<li><a href="../result_uet/defectcr.php" target="home">Change Request Result</a></li>
		</ul>
	</li>

</ul>
</li>

</ul>
<?php
}else if($_COOKIE["rl"]=="tester"){
?>

<ul id="nav">

<li class="top"><a href="#" class="top_link"><span>Home</span></a>
<ul class="sub">
	<li><a href="../home/introduction.php" target="home">Introduction</a></li>
	<li><a href="../home/template.php" target="home">Template</a></li>
</ul>
</li>

<li class="top"><a href="#" class="top_link"><span>Heuristic Evaluation</span></a>
<ul class="sub">
	<li><a href="#" class="fly">Project</a>
		<ul>
			<li><a href="../project_he/addproject.php" target="home">Add HE Project</a></li>
			<li><a href="../project_he/modifyproject.php" target="home">Modify HE Project</a></li>
			<li><a href="../project_he/listproject.php" target="home">List of Project</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Defect</a>
		<ul>
			<li><a href="../defect_he/adddefect.php" target="home">Add Defect</a></li>
			<li><a href="../defect_he/table.php" target="home">Modify Defect</a></li>
			<li><a href="../defect_he/present.php" target="home">Present Defect</a></li>
			<li><a href="../defect_he/vtable.php" target="home">Verify Defect</a></li>
			<li><a href="../defect_he/convert.php" target="home">Convert Defect</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Result</a>
		<ul>
			<li><a href="../result_he/defectpr.php" target="home">Problem Report Result</a></li>
			<li><a href="../result_he/defectcr.php" target="home">Change Request Result</a></li>
		</ul>
	</li>
</ul>
</li>

<li class="top"><a href="#" class="top_link"><span>User Experience Test</span></a>
<ul class="sub">
	<li><a href="#" class="fly">Project</a>
		<ul>
			<li><a href="../project_uet/addproject.php" target="home">Add UET Project</a></li>
			<li><a href="../project_uet/modifyproject.php" target="home">Modify UET Project</a></li>
			<li><a href="../project_uet/lockproject.php" target="home">Lock/Unlock Project</a></li>
			<li><a href="../project_uet/activeproject.php" target="home">Active/Deactive Project</a></li>
			<li><a href="../project_uet/checklist.php" target="home">Project Checklist</a></li>
			<li><a href="../project_uet/listproject.php" target="home">List of Project</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Task</a>
		<ul>
			<li><a href="../task_uet/addtask.php" target="home">Add New Task</a></li>
			<li><a href="../task_uet/table.php" target="home">Modify/Delete Task</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Demographic</a>
		<ul>
			<li><a href="../demographic_uet/adddemographic.php" target="home">Add New Question</a></li>
			<li><a href="../demographic_uet/modifydemographic.php" target="home">Modify/Delete Question</a></li>
			<li><a href="../demographic_uet/assigndemographic.php" target="home">Assign Question</a></li>
			<li><a href="../demographic_uet/unassigndemographic.php" target="home">Remove Assign Question</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Satisfaction</a>
		<ul>
			<li><a href="../satisfaction_uet/addcategory.php" target="home">Add New Category</a></li>
			<li><a href="../satisfaction_uet/deletecategory.php" target="home">Delete Category</a></li>
			<li><a href="../satisfaction_uet/addsatisfaction.php" target="home">Add New Question</a></li>
			<li><a href="../satisfaction_uet/table.php" target="home">Modify/Delete Question</a></li>
			<li><a href="../satisfaction_uet/assignquestion.php" target="home">Assign Question</a></li>
			<li><a href="../satisfaction_uet/removeassignquestion.php" target="home">Remove Assign Question</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Effectiveness</a>
		<ul>
			<li><a href="../effectiveness_uet/addeffectiveness.php" target="home">Add New Question</a></li>
			<li><a href="../effectiveness_uet/modifyeffectiveness.php" target="home">Modify/Delete Question</a></li>
			<li><a href="../effectiveness_uet/assigneffectiveness.php" target="home">Assign Question</a></li>
			<li><a href="../effectiveness_uet/removeassigneffectiveness.php" target="home">Remove Assign Question</a></li>
			<li><a href="../effectiveness_uet/addeffectivenessanswer.php" target="home">Set User Score</a></li>
			<li><a href="../effectiveness_uet/modifyeffectivenessanswer.php" target="home">Modify User Score</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Efficiency</a>
		<ul>
			<li><a href="../efficiency_uet/addefficiency.php" target="home">Add New Question</a></li>
			<li><a href="../efficiency_uet/modifyefficiency.php" target="home">Modify/Delete Question</a></li>
			<li><a href="../efficiency_uet/assignefficiency.php" target="home">Assign Question</a></li>
			<li><a href="../efficiency_uet/removeassignefficiency.php" target="home">Remove Assign Question</a></li>
			<li><a href="../efficiency_uet/addefficiencyanswer.php" target="home">Set User Score</a></li>
			<li><a href="../efficiency_uet/modifyefficiencyanswer.php" target="home">Modify User Score</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Debriefing</a>
		<ul>
			<li><a href="../debriefing_uet/adddebriefing.php" target="home">Add New Question</a></li>
			<li><a href="../debriefing_uet/modifydebriefing.php" target="home">Modify/Delete Question</a></li>
			<li><a href="../debriefing_uet/assigndebriefing.php" target="home">Assign Question</a></li>
			<li><a href="../debriefing_uet/removeassigndebriefing.php" target="home">Remove Assign Question</a></li>			
		</ul>
	</li>
	<li><a href="#" class="fly">User</a>
		<ul>
			
			<li><a href="../user_uet/adduser.php" target="home">Add New User</a></li>
			<li><a href="../user_uet/failuser.php" target="home">Mark Incompleted User</a></li>
			<li><a href="../user_uet/lockscore.php" target="home">Lock/Unlock User</a></li>		
		</ul>
	</li>
	<li><a href="#" class="fly">Mouse Click</a>
		<ul>
			<li><a href="../mouseclick/addmouseclickanswer.php" target="home">Set Mouse Click</a></li>
			<li><a href="../mouseclick/modifymouseclickanswer.php" target="home">Modify Mouse Click</a></li>	
		</ul>
	</li>
	<li><a href="#" class="fly">Probe Question</a>
		<ul>
			<li><a href="../probe/addmtquestion.php" target="home">Add Multiply Choice Question</a></li>
			<li><a href="../probe/addopquestion.php" target="home">Add Open Question</a></li>
			<li><a href="../probe/modifyquestion.php" target="home">Modify/Delete Question</a></li>			
		</ul>
	</li>
	<li><a href="#" class="fly">Defect</a>
		<ul>
			<li><a href="../defect_uet/adddefect.php" target="home">Add Defect</a></li>
			<li><a href="../defect_uet/table.php" target="home">Modify Defect</a></li>
			<li><a href="../defect_uet/present.php" target="home">Present Defect</a></li>
			<li><a href="../defect_uet/vtable.php" target="home">Verify Defect</a></li>
			<li><a href="../defect_uet/convert.php" target="home">Convert Defect</a></li>
		</ul>
	</li>
	<li><a href="#" class="fly">Result</a>
		<ul>
			<li><a href="../result_uet/demographicresult.php" target="home">Demographic Result</a></li>
			<li><a href="../result_uet/satisfactionresult.php" target="home">Satisfaction Result</a></li>
			<li><a href="../result_uet/thinkaloudresult.php" target="home">Think Aloud Result</a></li>
			<li><a href="../result_uet/debriefingresult.php" target="home">Debriefing Result</a></li>
			<li><a href="../result_uet/timeresult.php" target="home">Timing Result</a></li>
			<li><a href="../result_uet/effectivenessresult.php" target="home">Effectiveness Result</a></li>
			<li><a href="../result_uet/efficiencyresult.php" target="home">Efficiency Result</a></li>
			<li><a href="../result_uet/mouseclick.php" target="home">Mouse Click Result</a></li>
			<li><a href="../result_uet/overall.php" target="home">Overall Result</a></li>
			<li><a href="../result_uet/progress.php" target="home">Progress Result</a></li>
			<li><a href="../result_uet/defectpr.php" target="home">Problem Report Result</a></li>
			<li><a href="../result_uet/defectcr.php" target="home">Change Request Result</a></li>
		</ul>
	</li>

</ul>
</li>

</ul>

<?php
}else{
?>
<script type="text/javascript">
if(top!=self){
top.location=self.location;
}
</script>
<script type="text/javascript">document.location.href='../logout.php'</script>
<?php
}
?>
</table>
</body>
</html>