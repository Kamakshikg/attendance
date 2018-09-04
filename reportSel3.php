<?php
//semister 
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
<section id="page">
<header id="pageheader" class="normalheader">
<!--h2 class="sitedescription">
Dashboard.  </h2-->
</header>

<section id="contents">

<article class="post">
  <header class="postheader">
  <h2>Attendance Report for Semester </h2>
     Please Select  starting and ending months of semester
<?php
include("conn.php");

$crs="select * from course";//where coursc
$crsq=$conn->query($crs);


$cls="select * from class order by classname";//where coursc
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


<form name="form1" method="post" action="report3.php">

<p>
<div class="course_div" id="course_div" >Faculty :
 <select name="course" class="required-entry" id="course" onchange="javascript: dynamiccourse(this.options[this.selectedIndex].value);">
  <option  value="0"> Select Faculty</option>
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
  <div class="cls_div" id="cls_div" >Class &nbsp&nbsp&nbsp: 
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
   document.write('<select name="sub" id="sub"  ><option  value=""> All Subject</option> </select>')
  </script>
   <noscript>
   <select name="sub" id="sub" >
  <option  value=""></option> 
  </noscript>

 </div>
</p>

<!--p>
    <label for="subject">Month &nbsp:</label>
    <label for="select2"></label>

    <select name="month">
 <option value="0">All Month </option>
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
  </p-->

<p>
    <label for="subject">Start Month &nbsp:</label>
    <label for="select2"></label>

    <select name="smonth">
   <option value="0">All Month </option>
      <option value="1">June</option>
      <option value="2">July</option>
      <option value="3">August</option>
      <option value="4">September</option>
      <option value="5">October</option>
      <option value="6">November</option>
      <option value="7">December</option>
      <option value="8">January</option>     
      <option value="9">February</option>
      <option value="10">March</option>
      <option value="11">April</option>



</select>
  </p>

<p>
    <label for="subject"> End Month &nbsp:</label>
    <label for="select2"></label>

    <select name="emonth">
 <option value="0">All Month </option>
      <option value="1">June</option>
      <option value="2">July</option>
      <option value="3">August</option>
      <option value="4">September</option>
      <option value="5">October</option>
      <option value="6">November</option>
      <option value="7">December</option>
      <option value="8">January</option>     
      <option value="9">February</option>
      <option value="10">March</option>
      <option value="11">April</option>



</select>
  </p>

 
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
    document.getElementById("sub").options[0]=new Option(" All Subject","");
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
 <input type="submit" name="button" id="button" value="Submit">
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
