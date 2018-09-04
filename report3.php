<?php
// semister 
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
 $smonth=$_POST['smonth'];
 $emonth=$_POST['emonth'];
 $class= $_POST['cls'];
 $subject =$_POST['sub'];

if($smonth==0)
    $smonth=1;
if($emonth==0)
    $emonth=11;




if( $class ==0 )
     {
 echo '<script language="javascript">';
  echo 'alert("Plese Select Class")';  //not showing an alert box.
  echo '</script>';
  echo "<script>setTimeout(\"location.href = 'http:reportSel3.php';\",0);</script>";
    }
/*
if($subject!=0 and $month!=0)
   {
     include "submon2.php";
    submon($month,$class,$subject); // Subject, Month
    }
 */
  if($subject!=0 )//and $smonth ==0)
     {
       include "suballmon3.php";
     suballmon($smonth,$emonth,$class,$subject); // Subject  ,all Month
     }
/*
 if(($subject==0) and ($smonth ==$emonth))
     {
       include "allsubmon2.php";
     allsubmon($smonth,$class,$subject); // All Subject  , Month
     }
*/
else
if(($subject==0 )and ($smonth !=$emonth ))
     {
       include "allsuballmon3.php";
     allsuballmon($smonth,$emonth,$class,$subject); // allSubject  ,all Month
     }
else
{
echo '<script language="javascript">';
  echo 'alert("Please Select Other Option")';  //not showing an alert box.
  echo '</script>';
  echo "<script>setTimeout(\"location.href = 'http:reportSel3.php';\",0);</script>";

}


?>

