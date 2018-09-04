<html>
<body>
<?php
//   subject All month  semister
function suballmon($smonth,$emonth,$class,$subject)
{
 include("conn.php");
 //$mont="ALL Month";


$ct=mysqli_query($conn,"select coursename ,classname,subname from course,class,subject  where course.crid=class.crid and class.clid=subject.clid and subid= '$subject'");
$cnr=mysqli_fetch_assoc($ct);
$coursename=$cnr['coursename'];
$classname=$cnr['classname'];
$sub=$cnr['subname'];

/*
$sql1="SELECT sum(totallect) as totallect from conductedlect where subid='$subject'" ;
	$tlr=mysqli_query($conn,$sql1);
	$tlect=mysqli_fetch_assoc($tlr);
	$tc=$tlect["totallect"]; 

   if($tc=="")
      $totalclass="Not Lecture Done "; 
    else
      $totalclass=$tc;
 
*/
$tablename="Attend".$classname; 

$sql="SELECT rollno FROM $tablename,conductedlect as c  where $tablename.cdtlid =c.cdtlid and   subid='$subject' group by rollno ";  //total student 
	$result=mysqli_query($conn, $sql);
	$tstudent = mysqli_num_rows($result);
//      while($rw=mysqli_fetch_assoc($result))
 //          $roll[]=$rw['rollno'];

$mname="select monthname,totallect,c.monno  from month as m , conductedlect as c where m.monno=c.monno and subid ='$subject'  and m.monid between  '$smonth' and '$emonth'  order by monid";
	$mnt=mysqli_query($conn,$mname);
         $totalmonth=0;
	while($mntq=mysqli_fetch_assoc($mnt))
 	  {
           $tl[$totalmonth]=$mntq['totallect'];
           $mno[$totalmonth]=$mntq['monno'];
           $mn[$totalmonth++]=$mntq['monthname'];
          } 
          
$sqlsub="SELECT rollno,attend as atte,c.monno   FROM $tablename ,conductedlect as c ,month as m where $tablename.cdtlid =c.cdtlid and c.monno=m.monno and m.monid between  '$smonth' and '$emonth'    and c.subid='$subject'  order by rollno,monid  asc"; // 
	$resub=mysqli_query($conn, $sqlsub);
       $m=0;  
	while($ro=mysqli_fetch_assoc($resub))
	 {
             

	    $rol[$m]=$ro['rollno'];
            $at[$m]=$ro['atte'];
            $mon[$m++]=$ro['monno']; 
	    
	 }

/*echo "mon".$m;
$w=0;
while($w<$m)
{
  echo" ".$rol[$w];
  for($i=0;$i<$totalmonth;$i++)
  { 
   $ta=0;
   echo"  ".$mon[$i]."->";
    if($mno[$i]==$mon[$w])
       { 
        // $ta=$ta+
 echo" ".$at[$w];
//echo " ".$mon[$w];
       // echo" ".$sid[$i];
          $w++;
      }
      else
        { echo"--";
           //$w++;
         }

   }
echo"<br>";
}


*/

?>
<table align="center" width="85%" border="1">
<tr>
  <td  align="center" > <h2> Attendance Report  </h2></td>
  </tr>
</table>

<table  align="center" width="85%" border="1">    
  <tr>
    <td>&nbsp&nbsp Faculty : <?php echo $coursename; ?></td>
    <td>&nbsp&nbsp Class : <?php echo $classname; ?></td>
  </tr>
  <tr>
    <td>&nbsp&nbsp Subject : <?php  echo $sub; ?></td>
   <td>&nbsp&nbsp Total Students : <?php echo $tstudent; ?> </td>
  </tr>
</table>

<table align="center" width="85%" border="1" cellspacing="1" cellpadding="0">
 <tr>
   <td align="center" ><strong>Roll No</strong></td>
<!--td align="center"><strong>Name of Student</strong></td-->
<?php
  for($p=0; $p< $totalmonth; $p++)
       {
    echo"<td align='center'>$mn[$p]<br>$tl[$p]</td>";
      }
?>

   <td align="center"><strong>Attended <br>Lecture</strong></td>

   <td align="center"><strong>Attended <br>Percentage</strong></td>

<?php
	$w=0; 	
   while($w<$m)
        { 
        $atl=0; 
        $ct=0; 
         
?>
  <tr>
     <td align="center">
     <input  type="hidden"  /> <?php echo $rol[$w]; ?> </td>
     <!--td align="center">  
     <input id="name"   name="name"    type="hidden"  size="10" />
      </td-->
<?php
  	for($i=0;$i<$totalmonth; $i++)
    	  {
           if($mno[$i]==$mon[$w])
          {   
?> 
         <td  align="center"><?php echo$at[$w];?></td>
<?php
	  $atl=$atl + $at[$w];
          $ct=$ct + $tl[$i];
      $w++;
 	  }
      else
          {
?>
             <td  align="center"><?php echo"--";?></td>
<?php
         }
  }

	 $pr=($atl/$ct) *100;
	 $prc=number_format($pr, 2);
?>

   <td align="center">
   <input type="hidden" /><?php echo $atl;echo"/".$ct; ?></td>
   <td align="center">
   <input  type="hidden" /><?php echo $prc; ?></td>
   </tr>
<?php
     }
?>
</table>
<?php
}  //function
?>
</body>
</html>

