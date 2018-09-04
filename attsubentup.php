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
      include("index.php");



?>



<section id="page">
<header id="pageheader" class="normalheader">
<!--h2 class="sitedescription">
Dashboard.  </h2-->
</header>

<section id="contents">

<article class="post">
  <header class="postheader">
  <h2>Student  Add  Update  Delete </h2>
<?php
include("conn.php");

//session_start(); // dont forget it!  

  if(isset($_POST['submit']))
  {
$class= $_POST['cls'];
 $subject =$_POST['sub'];
 $month=$_POST['month'];
if($month==0 or $subject==0)
{
 

  echo '<script language="javascript">';
  echo 'alert("Select Month, Subject and Total Lecture Properly")';  //not showing an alert box.
  echo '</script>';
  echo "<script>setTimeout(\"location.href = 'http:attsubentup.php';\",0);</script>";
//sleep(1);
//header("location:attendeddy.php");
}    
else
{
$_SESSION['class'] = $_POST['cls'];
$_SESSION['sub'] = $_POST['sub'];
$_SESSION['month'] = $_POST['month'];

  header("Location:attensubup.php");
  }

}



$crs="select * from course";//where coursc
$crsq=$conn->query($crs);


$cls="select * from class";//where coursc
$clsq=$conn->query($cls);
 while($srw=mysqli_fetch_assoc($clsq))
     {
        $rowclss[]=$srw;
     }



$sb="select * from subject";
$sbr=$conn->query($sb);
//$sbarr=array();
if($sbr->num_rows >0)
  {
   while($srow=mysqli_fetch_assoc($sbr))
     {
        $rowsub[]=$srow;
     }
   }
?>


<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"><!--"attensubup.php"-->

<p>
<div class="course_div" id="course_div" >Course  :
 <select name="course" class="required-entry" id="course" onchange="javascript: dynamiccourse(this.options[this.selectedIndex].value);">
  <option  value="0"> Select Course</option>
    <?php if($crsq->num_rows >0)
      {
       while($crs=mysqli_fetch_assoc($crsq))
           {  ?>
          <option value="<?php echo $crs['crid'];?>"> <?php echo $crs['coursename']; ?> </option>
<?php      }
       }
?>
</select>
</div>

</p>


<!--p>
<div class="class_div" id="class_div" >Class  :
 <select name="class" class="required-entry" id="class" onchange="javascript: dynamicdrop(this.options[this.selectedIndex].value);">
  <option  value="0"> Select Class</option>
    <?php if($clsq->num_rows >0)
      {
       while($cls=mysqli_fetch_assoc($clsq))
           {  ?>
          <option value="<?php echo $cls['clid'];?>"> <?php echo $cls['classname']; ?> </option>
<?php      }
       }
?>
</select>
</div>

</p-->

<p>
  <div class="cls_div" id="cls_div" >Class : 
  <script type="text/javascript" language="JavaScript">
   document.write('<select name="cls" id="cls"  onchange="javascript: dynamicdrop(this.options[this.selectedIndex].value);" ><option  value=""> Select Class</option> </select>')
  </script>
   <noscript>
   <select name="cls" id="cls" >
  <option  value=""></option> 
  </noscript>

 </div>
</p>

<p>
  <div class="sub_div" id="sub_div" >Subject : 
  <script type="text/javascript" language="JavaScript">
   document.write('<select name="sub" id="sub"  ><option  value=""> Select Subject</option> </select>')
  </script>
   <noscript>
   <select name="sub" id="sub" >
  <option  value=""></option> 
  </noscript>

 </div>
</p>

<p>
    <label for="subject">Month</label>
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

 <!--p>
    <label for="totalclass">Roll no</label>
    <input type="text" name="rlno" id="rlno"   / >
  </p-->



<script type="text/javascript" language="javascript">

var clss = <?php echo json_encode($rowclss);?>;
var subjs = <?php echo json_encode($rowsub);?>;




function dynamiccourse(crlist)
  {

//document.write(crlist);
    document.getElementById("cls").length=0;
    document.getElementById("cls").options[0]=new Option(" Select Class","");
   if(crlist)
       {
      var j=1;
       var len=clss.length;

  for( var i=0; i<len; i++)
   {
    if(clss[i].crid==crlist)
       {
        document.getElementById("cls").options[j]=new Option(clss[i].classname,clss[i].clid);
       j=j+1;
       }
     }
    }
  return true;
  }






function dynamicdrop(list)
  {

//document.write(list);
    document.getElementById("sub").length=0;
    document.getElementById("sub").options[0]=new Option(" Select Subject","");
   if(list)
       {
      var j=1;
       var len=subjs.length;

  for( var i=0; i<len; i++)
   {
    if(subjs[i].clid==list)
       {
        document.getElementById("sub").options[j]=new Option(subjs[i].subname,subjs[i].subid);
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

  </header>
  <section class="entry"></section>
</article>

<article class="post">
  <header class="postheader"></header>
  <section class="entry"></section>
</article>



</section>


<?php 
	/*if($_SESSION["type"]=="admin")
	{
	include("adminmenu.php");
	}
	else
	{	
	include("lecturemenu.php");
	}
include("footer.php");

*/
?>
