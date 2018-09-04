<?php
include("conn.php");
include("header.html");

 $postedData = $_POST;

 $cdid=$_POST['cdid'];
 $tablename=$_POST['tbl'];

// prepare an insert statement
//$sql = "insert into $tablename (rollno,attend,cdtlid) values (?, ?, ?)";  
$sql="update $tablename set attend= ? where rollno= ? and cdtlid=? "; 
$statement = $conn->prepare($sql);

// bind integer, integer, double to the parameters in insert statement
// corresponding to the question marks
$no = 0;
$at = 0;

$statement->bind_param('iii',$at,$no,$cdid);

// loop through received data and only insert those that have valid values
$partsReceived = count($postedData['rno']);
for ($i = 0; $i < $partsReceived; $i++)
 {
    // update bind parameters
  $no = $postedData['rno'][$i];
    $at = $postedData['atten'][$i];

    // execute statement and move on to the next one
 try {
      $statement->execute();
      //echo "inserted";
      } catch (Exception $e) 
      {
        echo    'Error ' . $e->getMessage() . '</p>';
       }

      if($i==($partsReceived -1))
      {
  echo '<script language="javascript">';
  echo 'alert("Attendance Updated Successfully")';  //not showing an alert box.
  echo '</script>';
  echo "<script>setTimeout(\"location.href = 'http:attendenceentryup.php';\",0);</script>";
     }
 }
?>
