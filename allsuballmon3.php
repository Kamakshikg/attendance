<html>
<body>
<?php
//   All subject  ALL month    semister 
function allsuballmon($smonth,$emonth,$class,$subject)
{
 include("conn.php");

$subj="All Subject";
//$mntr="All Month";



$ct=mysqli_query($conn,"select coursename ,classname,thsub from course,class  where course.crid=class.crid and clid= '$class'");
$cnr=mysqli_fetch_assoc($ct);
$coursename=$cnr['coursename'];
$classname=$cnr['classname'];
$thsub=$cnr['thsub'];


$resclass="select s.subid,subname,sum(totallect) as totallect  from subject as s,conductedlect as c where s.subid=c.subid and  class='$class' group by subid ";
$resclass = mysqli_query($conn,$resclass);
       $totalsub=0;
	while($row2 = mysqli_fetch_assoc($resclass))
         {
        $sid[$totalsub]=$row2['subid'];  
  	$sub[$totalsub]=$row2['subname'];
        $tlect[$totalsub++]=$row2['totallect']; 
          }


/*
$rsclas="select s.subid,subname,totallect as totallect  from subject as s,conductedlect as c,month as m where s.subid=c.subid and c.monno=m.monno and  class='$class' order by subid,m.monid asc ";
$rscla = mysqli_query($conn,$rsclas);
       $tlsub=0;
	while($row1 = mysqli_fetch_assoc($rscla))
         {
          $msid[$tlsub]=$row1['subid'];  
  	    $msub[$tlsub]=$row1['subname'];
          $mlect[$tlsub++]=$row1['totallect']; 
          }
/*

$cn=mysqli_query($conn,"select classname from class where clid='$class'");
	$cnr=mysqli_fetch_assoc($cn);
	$classname=$cnr['classname'];


*/

$tablename="Attend".$classname;

$sql="SELECT rollno FROM $tablename ,conductedlect as c  where $tablename.cdtlid =c.cdtlid and  class='$class'  group by rollno ";  //total student 
	$result=mysqli_query($conn, $sql);
	$tstudent = mysqli_num_rows($result);

/*
 $sqlsub="select rollno,attend,totallect,subid from  $tablename ,conductedlect as c where $tablename.cdtlid =c.cdtlid  and class='$class' order by rollno,subid asc";
*/

$mname="select distinct(monthname) from month as m,conductedlect as c,$tablename  where  m.monno=c.monno and $tablename.cdtlid =c.cdtlid   and m.monid between '$smonth' and '$emonth' order by m.monid";
$rmnt=mysqli_query($conn, $mname);

 $sqlsub="select rollno,attend,totallect,subid from  $tablename ,conductedlect as c,month as m  where $tablename.cdtlid =c.cdtlid  and class='$class' and c.monno=m.monno and m.monid between  '$smonth' and '$emonth' order by rollno,subid asc";

	$resub=mysqli_query($conn, $sqlsub);
        $r=0;
	while($ro=$resub->fetch_array())
        {
        $rol[$r]= $ro['rollno'];
        $at[$r]=$ro['attend'];
        $si[$r]=$ro['subid']; 
        $mlect[$r++]=$ro['totallect'];
       }


/*
$w=0;  
while($w<$r)
{
  $z=$w;
  echo" ".$rol[$w];
  for($i=0;$i<$totalsub;$i++)
  { 
   $ta=0;
    $cta=0;
if($sid[$i]==$si[$w])
  {
   echo $sid[$i]."->";
    while($sid[$i]==$si[$w] &&$rol[$z]==$rol[$w] )
       { 

         $ta=$ta+$at[$w];
       // echo" ".$sid[$i];
          
      $cta=$cta+$mlect[$w++];
         }
      echo" ".$ta." ";
   }
     // else
    //echo"--|";

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
    <td>&nbsp&nbsp Faculty: <?php echo $coursename; ?></td>
    <td>&nbsp&nbsp </td>
  </tr>
  <tr>
    <td>&nbsp&nbsp Class : <?php echo $classname; ?></td>
    <td>&nbsp&nbsp Total Students : <?php echo $tstudent; ?> </td>
  </tr>
  <tr>
    <td>&nbsp&nbsp Subject : <?php  echo $subj; ?></td>
    <td>&nbsp&nbsp Month :  &nbsp <?php
// echo $mntr; 
while($rm = mysqli_fetch_assoc($rmnt))
      echo $rm['monthname'].", "; 

?></td>
  </tr>
</table>

<table align="center" width="85%"  border="1" cellspacing="1" cellpadding="1">
 <tr >
   <td align="center" ><strong>Roll <br>No</strong></td>
<!--td align="center"><strong>Name of Student</strong></td-->
<?php
  for($p=0; $p< $totalsub; $p++)
       {
    echo"<td align='center'>";
    echo $sub[$p];
                         echo"</td>";
      }
?>

   <!--td align="center"><strong>Attended <br>Lecture</strong></td-->

   <td align="center"><strong>Total<br>Percentage</strong></td>
</tr>

<?php
	$w=0;
   while($w<$r)
        {
        $astl=0;$z=$w;
?>
  <tr>
     <td align="center">
     <input   type="hidden"  /> <?php echo $rol[$w]; ?> </td>
     <!--td align="center">  
     <input id="name"   name="name"    type="hidden"  size="10" />
      </td-->
<?php
    $gta=0;
       for($i=0;$i<$totalsub;$i++)
         { 
         $ta=0; $cta=0;$cc=0;
  	   while($sid[$i]==$si[$w]  &&$rol[$z]==$rol[$w])
            { 
    	       $ta=$ta+$at[$w];
               $cta=$cta+$mlect[$w];
               $w++;
               $cc=1;
            }
        
        $gta=$gta+$ta;
        $astl=$astl+$cta; 

$sta=($ta/$cta) *100;
	 $psta=number_format($sta, 2);
if($cc==0)    //zero check
$psta='--';

?>
     <td  align="center"><?php echo$psta;?></td>
<?php
    
    } //for
    
	
 $pr=($gta/$astl) *100;
	 $prc=number_format($pr, 2);


?>

   <!--td align="center">
   <input type="hidden" /><?php echo $gta."/".$astl ; ?></td-->
   <td align="center">
   <input  type="hidden" /><?php echo $prc; ?></td>
   </tr>
<?php
     }//while
?>
</table>
<?php
}  //function
?>
</body>
</html>

