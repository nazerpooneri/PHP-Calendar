<?php include("header-info.php"); ?>
<body>
<style type="text/css">
.ds-calendar tr td{
  font-size: 1.3em;
}
.ds-calendar .calendar-title+tr{
background-color: #F0F0F0;
}
</style>
<?php include 'header.php'?><!--header-->
<section class="dashbaord-bg">
	<div class="dashboard-cnt">
    	<div class="row">
            <div class="calendar-box">
<?php

//This gets today's date

if(isset($_REQUEST['nxt'])){$next_month  =   $_REQUEST['nxt'];}
if(isset($_REQUEST['prv'])){$next_month  =   $_REQUEST['prv'];}//else{ $next_month  = ''; }



$date   =   time ()+($next_month * 24 * 60 * 60);
 //This puts the day, month, and year in seperate variables

$day    = date('d', $date) ;
$month  = date('m', $date) ;
$year   = date('Y', $date) ;

 //Here we generate the first day of the month
  $first_day = mktime(0,0,0,$month, 1, $year) ;
 //This gets us the month name
 $title = date('F', $first_day) ;

 //Here we find out what day of the week the first day of the month falls on 
 $day_of_week = date('D', $first_day) ;

 //Once we know what day of the week it falls on, we know how many blank days occure before it. If the first day of the week is a Sunday then it would be zero
 switch($day_of_week){

 case "Sun": $blank = 0; break;

 case "Mon": $blank = 1; break; 

 case "Tue": $blank = 2; break; 

 case "Wed": $blank = 3; break;

 case "Thu": $blank = 4; break; 

 case "Fri": $blank = 5; break; 

 case "Sat": $blank = 6; break;
 }
 //We then determine how many days are in the current month
$days_in_month = cal_days_in_month(0, $month, $year) ;

$this_month     = date("Y-m-01");// current date
$nxtmonth       = strtotime('+1 month' , strtotime ( $this_month ));
$nxtmonth       = date('m', $nxtmonth) ;

$days_in_nxtmonth = cal_days_in_month(0, $nxtmonth, date('Y')) ;
$anext_month     =   $next_month+$days_in_nxtmonth;
$aprv_month      =   $next_month-$days_in_month;
/***********************************/
 //Here we start building the table heads
 echo "<table align = 'center' id='page-wrap' width='90%' class='fluid ds-calendar'>";
 echo "<tr class='calendar-title'><th colspan=7><a href='calendar.php?prv=$aprv_month' class='calendar-prev'>&nbsp;</a> $title $year <a href='calendar.php?nxt=$anext_month' class='calendar-next'>&nbsp;</a></th></tr>";
 echo "<tr height='50'><td width=42>S</td><td width=42>M</td><td
width=42>T</td><td width=42>W</td><td width=42>T</td><td
width=42>F</td><td width=42>S</td></tr>";

 //This counts the days in the week, up to 7
 $day_count = 1;

 echo "<tr height='70' >";
 //first we take care of those blank days
 while ( $blank > 0 )
 {
 echo "<td></td>";
 $blank = $blank-1;
 $day_count++;
 } 

 //sets the first day of the month to 1
 $day_num = 1;
 //count up the days, untill we've done all of them in the month

 while ( $day_num <= $days_in_month )
 {
 $i=1;

 echo "<td> $day_num</td>";
 $day_num++;
 $day_count++;
 //Make sure we start a new row every week
 if ($day_count > 7)
 { echo "</tr><tr height='70'>";
 $day_count = 1;
 }
 }
 //Finaly we finish out the table with some blank details if needed
 while ( $day_count >1 && $day_count <=7 )
 {
 echo "<td> </td>";
 $day_count++;
 }
 echo "</tr></table>";

?>          </div>
        </div>
    </div>
</section>
<?php include("footer.php"); ?>
</body>
</html>
