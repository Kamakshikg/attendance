<?php
session_start();
if(!$_SESSION["type"]=="admin")
	{	
	include("index.php");
	}
   else
     {
       include"header.html";
}
?>
<table align="center" width="100%">
<tr >
<td align="center">
<!--a href="adminmenu.php"><font size="3" color="blue"> <span>Home</span></a> &nbsp&nbsp

<a href="courseentry.php"> <font size="3" color="blue"><span>Faculty</span></a>&nbsp&nbsp
<-->
<a href="classentry.php"> <font size="3" color="blue"><span>Class Entry</span></a>&nbsp&nbsp
<a href="subview.php"> <font size="3" color="blue"><span>Subject View</span></a>&nbsp&nbsp
<a href="subentry.php"> <font size="3" color="blue"><span>Subject Entry</span></a>&nbsp&nbsp
<a href="subreportsel.php"> <font size="3" color="blue"><span>Student Subject</span></a>&nbsp&nbsp
<a href="studentsubent.php"> <font size="3" color="blue"><span>Subject Selection</span></a>&nbsp&nbsp
</td>
</tr>
<tr >
<td align="center">

<a href="attendenceentry.php"> <font size="3" color="blue"><span>Attendence Entry</span></a>&nbsp&nbsp
<a href="attendenceentryup.php"> <font size="3" color="blue"><span>Attendence Update</span></a>&nbsp&nbsp
<a href="attsubentup.php"> <font size="3" color="blue"><span>Attendence Add/up</span></a>&nbsp&nbsp
</td>
</tr>
<tr >
<td align="center">

<a href="reportSel.php"> <font size="3" color="blue"><span>Attendence Report 1</span></a>&nbsp&nbsp
<a href="reportSel2.php"> <font size="3" color="blue"><span> Report 2</span></a>&nbsp&nbsp
<a href="reportSel3.php"> <font size="3" color="blue"><span>Semester Report 1 </span></a>&nbsp&nbsp
<a href="reportSel4.php"> <font size="3" color="blue"><span> Report</span></a>&nbsp&nbsp
<a href="StudreportSel.php"> <font size="3" color="blue"><span> Roll no wise </span></a>&nbsp&nbsp

</td>
</tr>
<tr >
<td align="center">
<a href="Unsend.php"> <font size="3" color="blue"><span>Unsend Report</span></a>&nbsp&nbsp

<a href="logout.php"> <font size="3" color="blue"><span>Log Out</span></a>
</td>
</tr>
</table>
