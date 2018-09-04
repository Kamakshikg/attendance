<html>
<body>
<?php
//Per Subject ,Month
function submon($class,$subject)
{
include("conn.php");
   
$ct=mysqli_query($conn,"select coursename ,classname,subname from course,class,subject  where course.crid=class.crid and class.clid=subject.clid and subid= '$subject'");
$cnr=mysqli_fetch_assoc($ct);
$coursename=$cnr['coursename'];
$classname=$cnr['classname'];
$sub=$cnr['subname'];
   
   
$sql="SELECT rollno FROM ".$classname." where sub1='$subject' or  sub2='$subject' or sub3='$subject' or sub4='$subject'  or sub5='$subject ' or sub6='$subject' or sub7='$subject' or sub8='$subject' order by rollno ";
	$result=mysqli_query($conn, $sql);
        $tstudent = mysqli_num_rows($result);
$t=0;
while($rows=mysqli_fetch_assoc($result))
{
  $r[$t++]=$rows['rollno'];
} 

?>
<table align="center" width="85%" border="1">
<tr>
  <td  align="center" > <h2> Subject Wise Roll No  </h2></td>
  </tr>

</table>
<table  align="center" width="85%" border="1">    
  <tr>
    <td>&nbsp&nbsp Faculty :<?php echo $coursename; ?></td>
    <td>&nbsp&nbsp Class : <?php echo  $classname; ?></td>
  </tr>
  <tr>
    <td>&nbsp&nbsp Subject : <?php echo $sub; ?></td>
    <td>&nbsp&nbsp Total Students : <?php echo $tstudent; ?> </td>
  </tr>
  </table>


<table align="center" width="85%" border="1" cellspacing="1" cellpadding="0">

<?php
/*
echo"<tr>";

for($i=0;$i<10;$i++)
{
?>
<td align="center" ><strong>Roll No</strong></td>
</td>

<?php
}
echo"</tr>";
*/
for($j=0;$j<$t;)
{
echo"<tr>";
for($i=0;$i<10;$i++)
{
?>
<td align="center">
<input   type="hidden"  /> <?php echo $r[$j++]; ?>
</td>
<!--td align="center">
<input id="name"   name="name"    type="hidden"  size="10" />
</td-->

<?php
}
echo"</tr>";
 
}
?>

</table>

</body>
</html>
<?php
}   //function
?>
