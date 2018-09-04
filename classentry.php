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

?>
<header>
<h2>  Class Entry Form  </h2>
</header>

<?php
include("conn.php");

$sb="select * from course";
$sbr=$conn->query($sb);
//$sbarr=array();
if($sbr->num_rows >0)
  {
 $tc=0;
   while($srow=mysqli_fetch_assoc($sbr))
     {
        $cour[$tc++]=$srow['coursename'];
     }
   }
?>


<form name="form1" method="post" action="classinsert.php">
<table>
<tr>
<td>
    <label for="coursename">Faculty / Program Name</label>
    <label for="select2"></label>
 </td>


<td>   <select name="crid">
 
<?php
    for($i=0;$i<$tc;$i++)
    {
 ?>      <option value="<?php echo $i+1 ;?>" > <?php echo $cour[$i]; ?> </option>
<?php
   }
 ?>
</select>
</td>
</tr>
<tr>
<td>  <label for="classname">Class Name</label>  </td>
<td>  <input type="text" name="classname" id="classname"  / > </td>
</tr>
<tr>
<td> <label for="classname">Starting Roll No  </label>  </td>
<td>  <input type="text" name="roll" id="roll"  / > </td>
</tr>


<tr>
<td> <label for="classname">No of Theory Subject  </label>  </td>
<td>  <input type="text" name="thsub" id="thsub"  / > </td>
</tr>
<tr>
<td> <label for="classname">No of Practical Subject  </label>  </td>
<td>  <input type="text" name="prsub" id="prsub"  / > </td>
</tr>




 <tr><td>&nbsp</td>
<td> <input type="submit" name="button" id="button" value="Submit">    </td>
</form>


<?php

$cls="select * from class";//where coursc
$qr=$conn->query($cls);
$i=1;
echo"<table border=1>
<tr><td aline=center>Sr. No.</td><td>Class</td><td>Roll No</td></tr>";
   while($r=mysqli_fetch_assoc($qr))
     {
       echo"<tr> <td>".$i++."</td>";
       echo"<td>".$r['classname']."</td>";
       echo"<td>".$r['rollno']."</td></tr>";

     }
echo"</table>";
?>







