<html>
<body>
<?php
//   All subject month
function allsubmon($month,$class,$subject)
{
 include("conn.php");

$subj="All Subject";


$ct=mysqli_query($conn,"select coursename ,classname,thsub from course,class  where course.crid=class.crid and clid= '$class'");
$cnr=mysqli_fetch_assoc($ct);
$coursename=$cnr['coursename'];
$classname=$cnr['classname'];
$thsub=$cnr['thsub'];





$resclass="select s.subid,subname,totallect  from subject as s,conductedlect as c where s.subid=c.subid and monno='$month' and class='$class' order by subid ";
$resclass = mysqli_query($conn,$resclass);
       $totalsub=0;
	while($row2 = mysqli_fetch_assoc($resclass))
         {
        $sid[$totalsub]=$row2['subid'];
        $tl[$totalsub]=$row2['totallect'];  
  	$sub[$totalsub++]=$row2["subname"];
          }

$mnt=mysqli_query($conn,"select monthname from month where monno='$month'");
	$mntq=mysqli_fetch_assoc($mnt);
	$mntr=$mntq['monthname'];
/*
$sql1="SELECT sum(totallect) as totallect from conductedlect where mon='$month' and class='$class' " ;
	$tlr=mysqli_query($conn,$sql1);
	$tlect=mysqli_fetch_assoc($tlr);
	$tc=$tlect["totallect"]; 

   if($tc=="")
      $totalclass="Not Lecture Done "; 
    else
      $totalclass=$tc;
  
$sql="SELECT rollno FROM attend as a ,conductedlect as c  where a.tcid =c.tcid and  class='$class'and mon='$month'  order by rollno ";  //total student 
	$result=mysqli_query($conn, $sql);
	$tstudent = mysqli_num_rows($result);
 */
 $tablename="Attend".$classname;
  
$sqlsub="select rollno,attend,subid from  $tablename ,conductedlect as c where $tablename.cdtlid =c.cdtlid and monno='$month' and class='$class' order by rollno,subid asc";

	$resub=mysqli_query($conn, $sqlsub);
       $r=0;
	while($ro=$resub->fetch_array())
        {
        $rol[$r]= $ro[0];
        $at[$r]=$ro[1];
        $si[$r++]=$ro[2]; 
       }
/*$w=0;
while($w<$r)
{
  echo" ".$rol[$w];
  for($i=0;$i<$totalsub;$i++)
  { 
    if($sid[$i]==$si[$w])
       { 
        echo" ".$at[$w];
        echo" ".$sid[$i];
          $w++;
      }
      else
    echo"--|";

   }
echo"<br>";
}
*/

?>
<table align="center" width="85%" border="1">
<tr>
  <td  align="center" ><h2> Attendance  Report  </h2--></td>
  </tr>
</table>

<table  align="center" width="85%" border="1">    
  <tr>
    <td>&nbsp&nbsp Faculty : <?php echo $coursename; ?></td>
    <td>&nbsp&nbsp Subject : <?php  echo $subj; ?></td>
    </tr>
  <tr>
    <td>&nbsp&nbsp Class : <?php echo $classname; ?></td>
    <td>&nbsp&nbsp Month :  &nbsp <?php echo $mntr; ?></td>
  </tr>
</table>

<table align="center" width="85%" border="1" cellspacing="1" cellpadding="0">
 <tr>
   <td align="center" ><strong>Roll No</strong></td>
<!--td align="center"><strong>Name of Student</strong></td-->
<?php
 for($p=0; $p<$thsub; $p++)
   {
    echo"<td align='center'>";
    echo "subject".($p+1);// substr($sub[$p],0,3);
    //echo"<br>".substr($sub[$p],-2);
     echo"</td>";
   }
?>

   <!--td align="center"><strong>Attended <br>Lecture</strong></td-->

   <td align="center"><strong>Attended <br>Percentage</strong></td>

<?php
	$w=0;
   while($w<$r)
        { 
	   $atl=0;
           $astl=0; $z=$w;$td=0;
?>
  <tr>
     <td align="center">
     <input   type="hidden"  /> <?php echo $rol[$w]; ?> </td>
     <!--td align="center">  
     <input id="name"   name="name"    type="hidden"  size="10" />
      </td-->
<?php
       for($i=0;$i<$totalsub;$i++)
         { 
           if($sid[$i]==$si[$w] && $rol[$z]==$rol[$w])
            { 
    	
?>
     <td  align="center"><?php echo$at[$w]."<br>".$sub[$i];?></td>
<?php
	$atl=$atl + $at[$w];
        $astl=$astl+$tl[$i]; 
  $w++; $td++;
 	    }
   
    }//for
	
 $pr=($atl/$astl) *100;
	 $prc=number_format($pr, 2);
for($tt=$td;$tt<$thsub;$tt++)
   {
    echo"<td>--</td>";
   }

?>

   <!--td align="center">
   <input type="hidden" /><?php echo $atl; ?></td-->
   <td align="center">
   <input  type="hidden" /><?php echo $prc; ?></td>
   </tr>
<?php
     }
?>
</table>
&nbsp
<table align="center" width="85%" border="1" cellspacing="1" cellpadding="0">
 <tr><td align="center" >Conducted Lecturers</td></tr>
</table> 


<table align="center" width="85%" border="1" cellspacing="1" cellpadding="0">
 <!--tr>
   <td align="center" >Subject </td><td align="center" >Lecture </td>
   <td align="center" >Subject </td><td align="center" >Lecture </td>
   <td align="center" >Subject </td><td align="center" >Lecture </td>
   <td align="center" >Subject </td><td align="center" >Lecture </td>
   <td align="center" >Subject </td><td align="center" >Lecture </td>
</tr-->

<?php
for($i=0;$i<$totalsub;)
 {
echo"<tr>";
  for($j=0;$j<5;$j++)
   {
    echo "<td  align='center'>".$sub[$i]."</td> <td  align='center'>".$tl[$i++]."</td>"; 
   }
}
echo "</tr>";
}  //function
?>
</table>
</body>
</html>

