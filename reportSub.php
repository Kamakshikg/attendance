<?php
session_start();

if($_SESSION["type"]=="admin")
	{
	include("adminmenu.php");
	}
    elseif($_SESSION["type"]=="lecturer")
	{	
	include("teachermenu.php");
	}
	else
	{	
	include("index.php");
	}

?>

  <header>
  <h2>Check report not submited </h2>
  </header>

<?php
include("conn.php");


$cls="select * from course";//where coursc
$clsq=$conn->query($cls);

$sb="select * from class";
$sbr=$conn->query($sb);
$sbarr=array();
if($sbr->num_rows >0)
  {
   while($srow=mysqli_fetch_assoc($sbr))
     {
        $rowsub[]=$srow;
     }
   }
?>


<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<p>
<div class="class_div" id="class_div" >Course  :
 <select name="class" class="required-entry" id="class" onchange="javascript: dynamicdrop(this.options[this.selectedIndex].value);">
  <option  value="0"> Select Course</option>
    <?php if($clsq->num_rows >0)
      {
       while($cls=mysqli_fetch_assoc($clsq))
           {  ?>
          <option value="<?php echo $cls['crid'];?>"> <?php echo $cls['coursename']; ?> </option>
<?php      }
       }
?>
</select>
</div>

</p>
<p>
  <div class="sub_div" id="sub_div" >Class   &nbsp&nbsp : 
  <script type="text/javascript" language="JavaScript">
   document.write('<select name="sub" id="sub" ><option  value=""> Select Class &nbsp&nbsp</option> </select>')
</script>
<noscript>
   <select name="sub" id="sub" >
  <option  value=""></option> 
</noscript>

</div>
</p>
<p>
    <label for="subject">Month &nbsp :</label>
    <label for="select2"></label>

    <select name="month">
 <option value="0">Select Month </option>
      <option value="6">June</option>
      <option value="7">July</option>
      <option value="8">August</option>
      <option value="9">September</option>
      <option value="10">October</option>
      <option value="11">November</option>
      <option value="12">December</option>
      <option value="1">January</option>     
      <option value="2">February</option>
      <option value="3">March</option>
      <option value="4">April</option>



</select>
  </p>




<script type="text/javascript" language="javascript">
var subjs = <?php echo json_encode($rowsub);?>;

function dynamicdrop(list)
  {

//document.write(list);
    document.getElementById("sub").length=0;
    document.getElementById("sub").options[0]=new Option(" Select Class","");
   if(list)
       {
      var j=1;
       var len=subjs.length;

  for( var i=0; i<len; i++)
   {
    if(subjs[i].crid==list)
       {
        document.getElementById("sub").options[j]=new Option(subjs[i].classname,subjs[i].clid);
       j=j+1;
       }
     }
    }
  return true;
  }
</script>


  <p>
 <input type="submit" name="submit" id="button" value="Submit">
    </p>
</form>


<?php 

  if(isset($_POST['submit']))
  {
   $class = $_POST['sub'];
   $month = $_POST['month'];
$cq="select classname from class where clid='$class'";
$cqr=$conn->query($cq);
$cr=mysqli_fetch_assoc($cqr);

$clas=$cr['classname'];
$q="select subname from subject where clid='$class' and subid   not in (select subid from conductedlect where class='$class' and monno='$month' order by subid asc)";
$qr=$conn->query($q);

$i=1;

echo"<table border=1>
<tr><td aline=center>".$clas."</td>
<tr><td aline=center> <b>Reports Not Submitted </td>";
echo"</table>";
echo"<table border=1>
<tr><td aline=center>Sr. No.</td><td>Subjects</td>";
  //echo"<tr";
   while($r=mysqli_fetch_assoc($qr))
     {
      echo"<tr><td>".$i++."</td>";
       echo"<td>".$r['subname']."</td>";
         echo"</tr>";
     }
echo"</table>";

  }


?>

