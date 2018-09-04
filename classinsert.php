<?php
include("conn.php");
include("header.html");

$tbl="CREATE TABLE IF NOT EXISTS class(clid int NOT NULL AUTO_INCREMENT,classname varchar(20) NOT NULL, rollno int,crid int, thsub int ,practsub int, PRIMARY KEY (clid)) AUTO_INCREMENT=1";
$conn->query($tbl);


  $crid=$_POST['crid'];
  $classname=$_POST['classname'];
  $roll=$_POST['roll'];
  $thsub=$_POST['thsub'];
  $prc=$_POST['prsub']; 


$sql="INSERT INTO class(classname,rollno,crid,thsub,practsub)
VALUES ('$classname','$roll','$crid','$thsub','$prc')";

if(!$conn->query($sql))
  {
  die('Error: ' . mysqli_error());
  }
else
{
 echo '<script language="javascript">';
  echo 'alert("Inserted Successfully")';  //not showing an alert box.
  echo '</script>';
  echo "<script>setTimeout(\"location.href = 'http:classentry.php';\",0);</script>";


/*

?>
<script>    
 if(!alert("Inserted ")) window.location.href = 'http://192.168.10.112/attfinalpass/classentry.php';
</script>
<?php
*/
 }
?>
