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
  <h2>All Subject</h2>
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
<div class="class_div" id="class_div" >Faculty / Program  :
 <select name="class" class="required-entry" id="class" onchange="javascript: dynamicdrop(this.options[this.selectedIndex].value);">
  <option  value="0"> Select Faculty</option>
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
  <div class="sub_div" id="sub_div" > &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Class &nbsp : 
  <script type="text/javascript" language="JavaScript">
   document.write('<select name="sub" id="sub" ><option  value=""> Select Class &nbsp&nbsp</option> </select>')
</script>
<noscript>
   <select name="sub" id="sub" >
  <option  value=""></option> 
</noscript>

</div>
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
 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<input type="submit" name="submit" id="button" value="Submit">
    </p>
</form>


<?php 

  if(isset($_POST['submit']))
  {
   $class = $_POST['sub'];

$q="select subname from subject where clid='$class' order by subid asc ";
$qr=$conn->query($q);
$i=1;


echo"<table border=1>
<tr><td aline=center>Sr. No.</td><td>Subject</td>";
   while($r=mysqli_fetch_assoc($qr))
     {
       echo"<tr> <td>".$i++."</td>";
       echo"<td>".$r['subname']."</td></tr>";

     }
echo"</table>";

  }


	
?>

