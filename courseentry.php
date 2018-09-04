<?php
session_start();

if($_SESSION["type"]=="admin")
	{
	include("adminmenu.php");
	}
	else
	{	
	include("index.php");
	}

include("conn.php");

$tbl="CREATE TABLE IF NOT EXISTS course(crid int NOT NULL AUTO_INCREMENT,coursename varchar(20) NOT NULL, PRIMARY KEY (crid)) AUTO_INCREMENT=1";
$conn->query($tbl);

?>

  <header>
  <h2>Faculty / Program entry</h2>
  </header>

<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <p>
Faculty / Program Name:
 <input type="text" name="cour" id="cour" >
  </p>

  <p>
 <input type="submit" name="submit" id="button" value="Submit">
    </p>
</form>


<?php 

 if(isset($_POST['submit']))
  {
    $cr=$_POST['cour'];
    $cri="insert into course(coursename)values ('$cr')";

    if($conn->query($cri))
       echo"course added";
     else
      echo"error in course adding"; 
  }

$cls="select * from course";//where coursc
$qr=$conn->query($cls);
$i=1;
echo"<table border=1>
<tr><td aline=center>Sr. No.</td><td>Faculty / Program</td></tr>";
   while($r=mysqli_fetch_assoc($qr))
     {
       echo"<tr> <td>".$i++."</td>";
       echo"<td>".$r['coursename']."</td></tr>";

     }
echo"</table>";


?>

