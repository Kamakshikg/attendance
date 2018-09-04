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

 $month=$_POST['month'];
 $class= $_POST['cls'];
 $subject =$_POST['sub'];

if( $class ==0 )
     {
  echo '<script language="javascript">';
  echo 'alert("Plese Select Class")';  //not showing an alert box.
  echo '</script>';
  echo "<script>setTimeout(\"location.href = 'http:reportSel.php';\",0);</script>";
    }
if($subject!=0 and $month!=0)
   {
     include "submon2.php";
    submon($month,$class,$subject); // Subject, Month
    }
 
  if($subject!=0 and $month ==0)
     {
       include "suballmon.php";
     suballmon($month,$class,$subject); // Subject  ,all Month
     }
 
 if($subject==0 and $month !=0)
     {
       include "allsubmon.php";
     allsubmon($month,$class,$subject); // All Subject  , Month
     }


if($subject==0 and $month ==0)
     {
        include "allsuballmon.php";
       //include "allsuballmon.php";
     allsuballmon($month,$class,$subject); // allSubject  ,all Month
     }


?>

