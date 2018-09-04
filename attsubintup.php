<?php
include("conn.php");
include("header.html");


$rno=$_POST['rno'];
$att=$_POST['atten'];
$cdid=$_POST['cdid'];
$sub=$_POST['sub'];
$cls=$_POST['class'];
$tablename=$_POST['tbl'];


if(isset($_POST['add']))
{
$sql=" insert into $tablename values ('$rno', '$att','$cdid') ";
if ($conn->query($sql))
  {

  echo '<script language="javascript">';
  echo 'alert("Attendance Add Successfully")';  //not showing an alert box.
  echo '</script>';
  echo "<script>setTimeout(\"location.href = 'http:attensubup.php';\",0);</script>";
  }
}

/*
if(isset($_POST['update']))
{
$sql="update $tablename set attend= '$att' where rollno='$rno'  and cdtlid='$cdid' ";
if ($conn->query($sql))
  {
 echo '<script language="javascript">';
  echo 'alert("Attendance  Update Successfully")';  //not showing an alert box.
  echo '</script>';
  echo "<script>setTimeout(\"location.href = 'http:attensubup.php';\",0);</script>";
 
}
}
*/

if(isset($_POST['del']))
{

echo $sql="delete from  $tablename  where rollno=$rno  and cdtlid=$cdid ";
if($conn->query($sql))
  {
 echo '<script language="javascript">';
  echo 'alert(" Delete Successfully")';  //not showing an alert box.
  echo '</script>';
  echo "<script>setTimeout(\"location.href = 'http:attensubup.php';\",0);</script>";
 }

}

//delete all month for rollno
if(isset($_POST['delsub']))
  {
echo $sql= "delete  from $tablename  where rollno=$rno and cdtlid in ( select cdtlid from conductedlect  where class=$cls and subid=$sub)"; 
if($conn->query($sql))
     {
  echo'<script language="javascript">';
   echo'alert("All months attendance deleted")';
   echo'</script>';
   echo"<script>setTimeout(\"location.href='http:attensubup.php';\",0); </script>";
    }

 }




if(isset($_POST['delall']))
{
$sql="delete from  $tablename  where cdtlid='$cdid' ";
$sql1="delete from  conductedlect  where cdtlid='$cdid' ";

if (($conn->query($sql)) &&($conn->query($sql1)))
  {
 echo '<script language="javascript">';
  echo 'alert("  Months record Deleted Successfully")';  //not showing an alert box.
  echo '</script>';
  echo "<script>setTimeout(\"location.href = 'http:attsubentup.php';\",0);</script>";
 
}
}


?>
