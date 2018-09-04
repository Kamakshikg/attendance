<?php
include("header.html");

session_start();
/*
if($_SESSION["type"]=="admin")
	{
	include("adminmenu.php");
	}
	else
	{	
	include("teachermenu.php");
	}
*/
?>

<!DOCTYPE html>

<html>

<head>
<script  src= "movecurup.js">
</script>

<script type='text/javascript'>
        $(document).ready(function(){
            $('#form input').keydown(function(e){
             if(e.keyCode==13){       

                if($(':input:eq(' + ($(':input').index(this) + 2) + ')').attr('type')=='submit'){// check for submit button and submit form on enter press
                        return true;
                }

                $(':input:eq(' + ($(':input').index(this) + 2) + ')').focus();

               return false;
             }

            });
        });
</script>


</head>

<body>





<?php
include("conn.php");


 $class= $_POST['cls'];
 $subject =$_POST['sub'];
 $month=$_POST['month'];
 
if($month==0 or $subject==0)
{
 

  echo '<script language="javascript">';
  echo 'alert("Select Month, Subject and Total Lecture Properly")';  //not showing an alert box.
  echo '</script>';
  echo "<script>setTimeout(\"location.href = 'http:attendenceentry.php';\",0);</script>";
//sleep(1);
//header("location:attendeddy.php");
}
else
  {
   
$ck=mysqli_query($conn,"select cdtlid,totallect from conductedlect where monno='$month'  and class='$class' and subid='$subject'");
$rckk=mysqli_fetch_assoc($ck);
    $cdid=$rckk['cdtlid'];
    $totalclass=$rckk['totallect'];
$rck= mysqli_num_rows($ck);
    if($rck==1)
       {
 
   
$ct=mysqli_query($conn,"select coursename ,classname,subname from course,class,subject  where course.crid=class.crid and class.clid=subject.clid and subid= '$subject'");
$cnr=mysqli_fetch_assoc($ct);
$coursename=$cnr['coursename'];
$classname=$cnr['classname'];
$subname=$cnr['subname'];

$tablename="Attend".$classname;

$sql="SELECT rollno ,attend FROM ".$tablename." where cdtlid='$cdid' order by rollno";
$result=mysqli_query($conn, $sql);
$tstudent = mysqli_num_rows($result);

$mnt=mysqli_query($conn,"select monthname from month where monno='$month'");
	$mntq=mysqli_fetch_assoc($mnt);
	$mont=$mntq['monthname'];

?>

<table width="50%"  align="center" border="1">
  <tr>
    <td>Course : <?php echo $coursename;  ?></td>
    <td>Total Classes : <?php echo $totalclass; ?></td>
  </tr>
  <tr>
    <td>Class : <?php echo $classname; ?></td>
    <td>Total Students : <?php echo $tstudent; ?> </td>
  </tr>
  <tr>
    <td>Subject : <?php  echo $subname; ?></td>
    <td>Month : <?php echo $mont; ?></td>
  </tr>
</table>

<form name="form" method="post" action="attendanceinsertup.php"  id="form">
<tr>
<td>
<table width="50%" border="1" cellspacing="1" cellpadding="0" align="center">

<tr>
<td align="center"><strong>Roll No</strong></td>
<!--td align="center"><strong>Name of Student</strong></td-->
<td align="center"><strong>Attended Lectures</strong></td>
</tr>

<?php
while($rows=mysqli_fetch_assoc($result))
{
?>

<tr>
<td align="center">
<input id="rno"    name="rno[]"   type="hidden" size="10"  value="<?php echo $rows['rollno']; ?>"  />
<?php echo $rows['rollno']; ?>
</td>
<!--td align="center">
<input id="name"   name="name[]"    type="hidden"  size="10"      readonly  />--
</td-->

<td align="center">
<input id="atten"   name="atten[]"   type="number" min="0"  max="<?php echo $totalclass; ?>"  value="<?php echo $rows['attend']; ?>"   maxlength="2"   onfocus="this.select()"      autofocus    />
</td>
</tr>

<?php
}
?>
<input name="cdid" type="hidden" size="10" value="<?php echo $cdid; ?>"/>
<input name="tbl" type="hidden" size="10" value="<?php echo $tablename; ?>"/>
<tr>
<td colspan="4" align="center"><input   id="submit"      type="submit" name="submission" value="Update"     ></td>
</tr>
</table>
</td>
</tr>
</form>
</body>
</html>
<?php
     }//if ck
 else
 {
 ?>
        <table align="center" width="85%" border="1">
	<tr>
  	<td  align="center" > <h2>Class and Month's Attendance Not Already Added <br><a href="attendenceentry.php"><span> Go Back</span></a> </h2></td>
  	</tr>
	</table>

<?php
   }

 }//else month

?>
