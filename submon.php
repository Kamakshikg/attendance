<html>
<body>
<?php
//Per Subject ,Month
function submon($month,$class,$subject)
{
include("conn.php");
   
$ct=mysqli_query($conn,"select coursename ,classname,subname from course,class,subject  where course.crid=class.crid and class.clid=subject.clid and subid= '$subject'");
$cnr=mysqli_fetch_assoc($ct);
$coursename=$cnr['coursename'];
$classname=$cnr['classname'];
$sub=$cnr['subname'];
 
$mnt=mysqli_query($conn,"select monthname from month where monno='$month'");
	$mntq=mysqli_fetch_assoc($mnt);
	$mont=$mntq['monthname'];

$sql1="SELECT totallect from conductedlect where subid='$subject' and monno='$month' " ;
	$tlr=mysqli_query($conn,$sql1);
	$tlect=mysqli_fetch_assoc($tlr); 
	$tc=$tlect["totallect"]; 

    if($tc=="")
       $totalclass="Not Lecture Done ";
     else
       $totalclass=$tc;  
 
$tablename="Attend".$classname;   
   
$sql="SELECT rollno,attend FROM $tablename ,conductedlect as c  where $tablename.cdtlid =c.cdtlid and monno='$month' and subid='$subject' group by rollno ";
	$result=mysqli_query($conn, $sql);
        $tstudent = mysqli_num_rows($result);

?>
<table align="center" width="50%" border="1">
<tr>
  <td  align="center" > <h2> Attendance  Report  </h2></td>
  </tr>

</table>
<table  align="center" width="50%" border="1">    
  <tr>
    <td>&nbsp&nbsp Faculty : <?php echo $coursename; ?></td>
    <td>&nbsp&nbsp Total Lectures : <?php echo $totalclass; ?></td>
  </tr>
  <tr>
    <td>&nbsp&nbsp Class : <?php echo $classname; ?></td>
    <td>&nbsp&nbsp Total Students : <?php echo $tstudent; ?> </td>
  </tr>
  <tr>
    <td>&nbsp&nbsp Subject : <?php  echo $sub; ?></td>
    <td>&nbsp&nbsp Month :  &nbsp <?php echo $mont; ?></td>
  </tr>
</table>


<table align="center" width="50%" border="1" cellspacing="1" cellpadding="0">

<tr>
<td align="center" ><strong>Roll No</strong></td>
<!--td align="center"><strong>Name of Student</strong></td-->
<td align="center"><strong>Attended Days</strong>
</td>


<?php
while($rows=mysqli_fetch_assoc($result))
{ 
?>
<tr>
<td align="center">
<input   type="hidden"  /> <?php echo $rows['rollno']; ?>
</td>
<!--td align="center">
<input id="name"   name="name"    type="hidden"  size="10" />
</td-->
<td align="center">
<input type="hidden" /><?php echo $rows['attend']; ?>
</td>
</tr>

<?php
}
?>

</table>

</body>
</html>
<?php
}   //function
?>
