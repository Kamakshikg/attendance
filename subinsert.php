<?php
include("conn.php");
include("header.html");

$tbl="CREATE TABLE IF NOT EXISTS subject(subid int NOT NULL AUTO_INCREMENT,subname varchar(20) NOT NULL,clid int, PRIMARY KEY (subid))AUTO_INCREMENT=1";
$conn->query($tbl);

  //$crid=$_POST['crid'];
  $classid=$_POST['cls'];
  $sub=$_POST['sub'];





$sql="INSERT INTO subject(subname,clid)
VALUES ('$sub','$classid')";

if(!$conn->query($sql))
  {
  die('Error: ' . mysqli_error());
  }
else
{


echo '<script language="javascript">';
  echo 'alert("Inserted Successfully")';  //not showing an alert box.
  echo '</script>';
  echo "<script>setTimeout(\"location.href = 'http:subentry.php';\",0);</script>";
/*
?>
<script>    
 if(!alert("Inserted ")) window.location.href = 'http://192.168.10.112/attfinalpass/subentry.php';
</script>
<?php
*/
}
?>
