<?php
include("header.html");
?>

  <header>
  <h2> Update  Subject   </h2>
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


<form name="form1" method="post" action="subinsert.php">
<p>
<div class="class_div" id="class_div" >Course &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp   :
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
  <div class="sub_div" id="sub_div" >Class   &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp : 
  <script type="text/javascript" language="JavaScript">
   document.write('<select name="cls" id="cls" ><option  value=""> Select Class &nbsp&nbsp</option> </select>')
</script>
<noscript>
   <select name="cls" id="cls" >
  <option  value=""></option> 
</noscript>

</div>
</p>

 <p>
    <label for="classname">Roll No  </label>  
   <input type="text" name="sub" id="sub"  / > 
    </p>

 <p>
 <input type="submit" name="submit" id="button" value="Submit">
    </p>
</form>


<script type="text/javascript" language="javascript">
var subjs = <?php echo json_encode($rowsub);?>;

function dynamicdrop(list)
  {

//document.write(list);
    document.getElementById("cls").length=0;
    document.getElementById("cls").options[0]=new Option(" Select Class","");
   if(list)
       {
      var j=1;
       var len=subjs.length;

  for( var i=0; i<len; i++)
   {
    if(subjs[i].crid==list)
       {
        document.getElementById("cls").options[j]=new Option(subjs[i].classname,subjs[i].clid);
       j=j+1;
       }
     }
    }
  return true;
  }
</script>


 


