<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/theme.css">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/boostrap.min.js"></script>
      <style>
         table#calendar {
            width: auto;
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
         }
         table#calendar th, table#calendar td {
            border: 1px solid black;
         }
         table#calendar td#today div#a1{
            width: 85%;
            height: 90%;
            border: 2px solid red;
            border-radius: 50px;
         }
         table#calendar td:hover, table#calendar td#today:hover, table#calendar td.events:hover {
            background-color: #999999;
         }
         table#calendar td.events {
            /*text-decoration: underline;*/
            background-color: #BBBBBB;
         }
         table#calendar a:hover, table#calendar a:link, table#calendar a:active, table#calendar a:visited {
            text-decoration:none;
         }
         table#calendar a {
            height: 100%;
            width: 100%;
            display: block;
         }
         table#calendar div {
            width: 100%;
            height: 100%;
         }
      </style>
   </head>
   <body class="TACenter">
   <div class="container">
      <?php include 'header.php';?>
      <?php
         session_start();
         $currMonth = $_GET["m"];
         $currTime = time();
         if ($currMonth == Null) {
            $currMonth = date("n", $currTime);
            $_SESSION['year'] = date("Y", $currTime);
            $_SESSION['refreshYearChgingP'] = false;
            $_SESSION['refreshYearChgingN'] = false;
         } else {
            $command = $_GET["nav"];
            if ($command != Null) {
               if ($command == 'n') {
                  $_SESSION['refreshYearChgingP'] = false;
                  $currMonth = $currMonth+1;
                  $currMonth = $currMonth % 13;
                  if ($currMonth == 0) {
                        $currMonth = 1;
                     if ($_SESSION['refreshYearChgingN'] == false) {
                        $_SESSION['year'] += 1;
                        $_SESSION['refreshYearChgingN'] = true;
                     }
                  } else {
                     $_SESSION['refreshYearChgingN'] = false;
                  }
               } else if ($command == 'p') {
                  $_SESSION['refreshYearChgingN'] = false;
                  $currMonth = $currMonth-1;
                  if ($currMonth == 0) {
                        $currMonth = 12;
                     if ($_SESSION['refreshYearChgingP'] == false) {
                        $_SESSION['year'] -= 1;
                        $_SESSION['refreshYearChgingP'] = true;
                     }
                  } else {
                     $_SESSION['refreshYearChgingP'] = false;
                  }
               }
            } else {
               $_SESSION['year'] = date("Y", $currTime);
            }
         }
         $currYear = $_SESSION['year'];
         $navLink = 'index.php?m='.$currMonth;
         echo '<a href="'.$navLink.'&nav=p"><span class="glyphicon glyphicon-chevron-left"></span></a>';
         echo ' '.strtoupper(date('F', mktime(0,0,0, $currMonth))).' '.$currYear.' ';
         echo '<a href="'.$navLink.'&nav=n"><span class="glyphicon glyphicon-chevron-right"></span></a>';
         echo "<br/><br/>";
         $numDays = date('t', mktime(0,0,0, $currMonth,1, $currYear));
//       $numDays = cal_days_in_month(CAL_GREGORIAN, $currMonth, $currYear); //Or use also can
         $firstDayInMonth = date('w', mktime(0,0,0,$currMonth, 1, $currYear));
         $numOfWeeks = ceil(($numDays+$firstDayInMonth)/7);
         echo '<table id="calendar">';
         $dayNames = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
         for ($x=0; $x<7; $x++) {
            echo "<th>".$dayNames[$x]."</th>";
         }
         $calDate = 1;
         $currDay = date("j", $currTime);
         for ($y=0; $y<$numOfWeeks; $y++) {
            echo "<tr>";
            for ($z=0;$z<7;$z++) {
               $today = false;
               $sessionArray = str_pad($calDate,2,'0',STR_PAD_LEFT).'/'.str_pad($currMonth,2,'0',STR_PAD_LEFT).'/'.$currYear.'EventArr';
               echo "<td";
               if (($currMonth == date("n", $currTime)) && ($calDate == $currDay) && ($currYear == date("Y", $currTime))){
                  echo ' id="today"';
                  $today = true;
               }
               if ((!empty($_SESSION[$sessionArray])) && ($firstDayInMonth == 0)) {
                  echo ' class="events" title="You have Events" ';
               }
               echo ">";
               if ($calDate <= $numDays) {
                  if ($firstDayInMonth > 0) {
                        $firstDayInMonth -= 1;
                  } else { 
                     $eventLink = 'events.php?d='.$calDate.strtoupper(date('M', mktime(0,0,0, $currMonth))).$currYear;
                     echo '<div><a href="'.$eventLink.'">';
                     if ($today) { echo '<div id="a1"><div id="a2">';}                  
                     echo $calDate;
                     if ($today) { echo '</div></div';}                  
                     echo '</a></div>';
                     $calDate += 1;
                  }
               }
               echo "</td>";
            }
            echo "</tr>";
         }
         echo "</table>";

         $page = $_SERVER["REQUEST_URI"];
         $page = str_replace("/lab5/", "", $page);
         $_SESSION['calendarPage'] = $page;
      ?>
      <?php include 'footer.php';?>
      </div>
   </body>
</html>

