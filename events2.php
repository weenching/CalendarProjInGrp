<?php
   session_start();

   $currDateStr = $_POST["d"];
   $dateArr = date_parse($currDateStr);
   $sessionDateName = str_pad($dateArr['day'],2,'0',STR_PAD_LEFT).'/'.str_pad($dateArr['month'],2,'0',STR_PAD_LEFT).'/'.$dateArr['year'].'EventArr';

   if ($_POST['displayEvent']) {
      displayEventList();
   } else if ($_POST['detailEvent']) {
      displayEventDetail($_POST['event']);
   } else {
      if ($_POST['submitEvent']) {
         $ar = array(); 
         $ar['title'] = $_POST['eventTitle'];
         $ar['sTime'] = $_POST['eventSTime'];
         $ar['eTime'] = $_POST['eventETime'];
         $ar['loc'] = $_POST['eventLoc'];
         $ar['descr'] = $_POST['eventDescr'];
         //echo $_POST['eventTitle']." ".$_POST['eventSTime']." ".$_POST['eventETime']." ".$_POST['eventLoc']." ".$_POST['eventDescr'];
         if(empty($_SESSION[$sessionDateName])) {
            $_SESSION[$sessionDateName]=array();
         }   
         array_push($_SESSION[$sessionDateName],$ar);

         echo "session=".$sessionDateName."<br/>";
         print_r($_SESSION[$sessionDateName]);
      } else if ($_POST['editEvent']) {
         $selectedEvent = $_POST['index'];
         $ar = array(); 
         $ar['title'] = $_POST['eventTitle'];
         $ar['sTime'] = $_POST['eventSTime'];
         $ar['eTime'] = $_POST['eventETime'];
         $ar['loc'] = $_POST['eventLoc'];
         $ar['descr'] = $_POST['eventDescr'];
         $_SESSION[$sessionDateName][$selectedEvent] = $ar;
      } else if (($_POST['moveUp']) || ($_POST['moveDown']) || ($_POST['moveDate'])) {
         $selectedEvent = $_POST['index'];
         $tempEvent = $_SESSION[$sessionDateName][$selectedEvent];
         echo "tempEvent: ";         
         print_r($tempEvent);
         if($_POST['moveUp']) {
            if ($selectedEvent != 0) {
               $_SESSION[$sessionDateName][$selectedEvent] = $_SESSION[$sessionDateName][$selectedEvent-1];
               $_SESSION[$sessionDateName][$selectedEvent-1] = $tempEvent;
            }
         } else if($_POST['moveDown']) {
            if ($selectedEvent < (count($_SESSION[$sessionDateName])-1)) {
               $_SESSION[$sessionDateName][$selectedEvent] = $_SESSION[$sessionDateName][$selectedEvent+1];
               $_SESSION[$sessionDateName][$selectedEvent+1] = $tempEvent;
            }
         } else if($_POST['moveDate']) {
            $targetDateName = $_POST['targetDate'].'EventArr';
            echo "targetDate".$targetDateName."<br/>";
            if(empty($_SESSION[$targetDateName])) {
               $_SESSION[$targetDateName]=array();            
            }
            array_push($_SESSION[$targetDateName],$tempEvent);
            if (count($_SESSION[$sessionDateName]) != 1) {
               array_splice($_SESSION[$sessionDateName], $selectedEvent, 1); //changes index, but wun remove(or clean) the array completely if it is the only element 
            } else {
               unset($_SESSION[$sessionDateName]); //wun chg the index, will hav problem to re-arrange. suitable for removing last element
            }
         }
      } else if ($_POST['back']) {
         backFunction();
      } else {
         echo "false";
      }
   }
   function displayEventDetail($event) {
      global $sessionDateName;
      $ar = $_SESSION[$sessionDateName][$event];
      $split = "&&&";
      $resultString = $ar['title'].$split.$ar['sTime'].$split.$ar['eTime'].$split.$ar['loc'].$split.$ar['descr'];
      echo $resultString;
   }
   function displayEventList() {
      global $sessionDateName;
      $eventsID = 0;
      foreach ($_SESSION[$sessionDateName] as $keys) {
         echo '<input type="radio" id="eventRadio'.$eventsID.'" name="events" value="'.$eventsID.'"><label><span><span></span></span>'.$keys['title'].'</label><br/>';
         $eventsID += 1;
      }
      //echo '&&$event2.php->totalEvents='.$eventsID; //check the weird radio solution
   }
   function backFunction() {
      echo $_SESSION['calendarPage'];
   }
?>
