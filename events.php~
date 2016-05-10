<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" href="css/theme.css">
      <link rel="stylesheet" href="css/radio-css.css">
      <style>
         .textArea {
            resize: none;
            overflow-y: scroll;
         }
      </style>
   </head>
   <body onload="loadPage()">
      <?php include 'header.php';?>
      <?php
         session_start();
         //session_unset();
         //session_destroy();

         $currDateStr = $_GET["d"];
         $dateArr = date_parse($currDateStr);
         $sessionDateName = str_pad($dateArr['day'],2,'0',STR_PAD_LEFT).'/'.str_pad($dateArr['month'],2,'0',STR_PAD_LEFT).'/'.$dateArr['year'].'EventArr';
         echo "Events on ";
         echo $dateArr['day'].' '.date('F', mktime(0,0,0, $dateArr['month'])).' '.$dateArr['year'].'<br/>';
      ?>
      
      <form id="form1" action="events.php?d=<?php echo $currDateStr;?>" method="POST">
         <div id="eventDisplay">
            <?php
               $eventsID = 0;
               foreach ($_SESSION[$sessionDateName] as $keys) {
                  echo '<input type="radio" id="eventRadio'.$eventsID.'" name="events" value="'.$eventsID.'"><label><span><span></span></span>'.$keys['title'].'</label><br/>';
                  $eventsID += 1;
               }
            ?>            
         </div>        
         <button type="button" id="moveUp" name="moveUp">Move Up</button>
         <button type="button" id="moveDown" name="moveDown">Move Down</button><br/>
         <button type="button" id ="moveDate" name="moveDate">Move to Other</button>
         <input type="text" id="targetDate" name="targetDate" placeholder="dd/mm/yyyy"><br/>
         <button type="button" id="editEvent" name="editEvent">Edit Event</button>
         <div id="eventInputs">
            <label for="eventTitle">Title</label>
            <input type="text" id="eventTitle" name="eventTitle"><br/>
            <label for="eventSTime">Start Time</label>
            <input type="text" id="eventSTime" name="eventSTime">
            <label for="eventETime">End Time</label>
            <input type="text" id="eventETime" name="eventETime"><br/>
            <label for="eventLoc">Location</label>
            <input type="text" id="eventLoc" name="eventLoc"><br/>
            <label for="eventDescr">Description</label>
            <textarea class="textArea" id="eventDescr" name="eventDescr" row="5" cols="40"></textarea><br/>
         </div>
         <button type="button" id="back" name="back">Back</button>
         <button type="button" id="addEvent" name="addEvent">Add Events</button>
         <button type="button" id="submitEvent" name="submitEvent">Submit</button>
      </form>
      <?php include 'footer.php';?>

      <script>
         function loadPage() {
            //Either   function(){validateForm()};   or   validateForm;   both works (for functions only, maybe shortcut?)
            //document.getElementById("form1").onsubmit = validateForm;
            document.getElementById("back").onclick = function(){backPage()};
            document.getElementById("addEvent").onclick = function(){addEvents(1)};
            document.getElementById("submitEvent").onclick = function(){checkEvent("submitEvent")};
            document.getElementById("editEvent").onclick = function(){checkEvent("editEvent")};
            document.getElementById("moveUp").onclick = function(){manageEvent("moveUp")};
            document.getElementById("moveDown").onclick = function(){manageEvent("moveDown")};
            document.getElementById("moveDate").onclick = function(){manageEvent("moveDate")};
            
            addEvents(0);
            //eventList(); //not needed since included the PHP in the HTML instead of using javascript to load
            manageEventsDisplay();
            addOnClickEvent();
         }
         function manipulatePlaceHolder(number) {
            if (number == 0) {
               document.getElementById("eventTitle").placeholder = "";
               document.getElementById("eventSTime").placeholder = "";
               document.getElementById("eventETime").placeholder = "";
               document.getElementById("eventLoc").placeholder = "";
               document.getElementById("eventDescr").placeholder = "";
            } else {
               document.getElementById("eventTitle").placeholder = "Title";
               document.getElementById("eventSTime").placeholder = "hh:mm";
               document.getElementById("eventETime").placeholder = "hh:mm";
               document.getElementById("eventLoc").placeholder = "Location";
               document.getElementById("eventDescr").placeholder = "Description";
            }
         }
         function manageEventsDisplay() {
            //alert("Events="+document.getElementsByName("events").length);
            var radio = document.getElementsByName("events").length;
            if (radio == 0) {
               document.getElementById("moveUp").disabled = true;
               document.getElementById("moveDown").disabled = true;
               document.getElementById("moveDate").disabled = true;
               document.getElementById("editEvent").disabled = true;
            } else if (radio == 1) {
               document.getElementById("moveUp").disabled = true;
               document.getElementById("moveDown").disabled = true; 
               document.getElementById("moveDate").disabled = false; 
               document.getElementById("editEvent").disabled = false;             
            } else {
               document.getElementById("moveUp").disabled = false;
               document.getElementById("moveDown").disabled = false;
               document.getElementById("moveDate").disabled = false;
               document.getElementById("editEvent").disabled = false;
            }
         }
         function addOnClickEvent() {
            var radio = document.getElementsByName("events").length;
            //alert("radio="+radio);   //to check the solution...
            //alert("welcome");
            for (var x = 0; x < radio; x++) { //temporary solution for the last index, add = sign...
            //But will also have problem if added =, since For loop will not end successfully.
               document.getElementById("eventRadio"+x).onclick = function(){checkEventDetails()};
            }
            alert("welcome");   
         }
         function checkEventDetails() {
            var radios = document.getElementsByName("events");
            for (var i=0; i<radios.length; i++) {
               if(radios[i].checked) {
                  eventDetails(i);
               }
            }
         }
         function addEvents(number) {
            if (number == 0) {
               document.getElementById("submitEvent").style.visibility = "hidden";
               document.getElementById("eventInputs").style.visibility = "hidden";
               document.getElementById("addEvent").disabled = false;
               
            } else {
               document.getElementById("form1").reset();
               document.getElementById("submitEvent").style.visibility = "visible";
               document.getElementById("eventInputs").style.visibility = "visible";
               //document.getElementById("addEvent").disabled = true;
               manipulatePlaceHolder(1);
            }
         }
         function backPage() {
            loadDoc("back");
            //history.go(-1); //unable to work if no history
         }
         function checkEvent(button) {
            //alert("checkEvent:" + button);
            var correctEvent = true;
            var eventTitle = document.getElementById("eventTitle").value;
            var eventSTime = document.getElementById("eventSTime").value;
            var eventETime = document.getElementById("eventETime").value;
            var eventLoc = document.getElementById("eventLoc").value;
            var eventDescr = document.getElementById("eventDescr").value;
            //alert("eventSTime" + formatTime(eventSTime));
            //alert("eventETime" + formatTime(eventETime));
            if (eventTitle == '') {
               alert("Please Insert Title");
               correctEvent = false;
            } else if ((eventSTime != '') && (formatTime(eventSTime)===false)) {
               alert("Wrong Start Time");
               correctEvent = false;
            } else if ((eventETime != '') && (formatTime(eventETime)===false)) {
               alert("Wrong End Time");
               correctEvent = false;
            }
            if (correctEvent == true) {
               loadDoc(button);
            } else {
               alert("Unable to save event. Please check details.");
            }
         }
         function formatTime(time) {
            var result = false;
            var m;
//REGEX ISSUE
            var regex = /^([01]?[0-9]|2[0-3]):?([0-5][0-9])$/;
            //var regex = /^\s*([01]?\d|2[0-3]):?([0-5]\d)\s*$/;
            if ((m = time.match(regex))) {
               result = true;
               //result = (m[1].length === 2 ? "" : "0") + m[1] + ":" + m[2];
            }
            return result;
         }
         function loadDoc(button) {
            var xhttp;
            if (window.XMLHttpRequest) {
               xhttp = new XMLHttpRequest();
            } else {
               xhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xhttp.onreadystatechange = function() {
               if (xhttp.readyState == 4 && xhttp.status == 200) {
                  if ((button == "submitEvent") || (button == "editEvent")){
                     addEvents(0);                 
                     eventList();
                     addOnClickEvent(); 
                     manageEventsDisplay();
                  }
                  else if (button == "back") {
                     window.location.href = xhttp.responseText;
                  }
               }
            };

            xhttp.open("POST", "events2.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var link = window.location.href;
            var queryIndex = link.indexOf("?d=")+1;
            var queryString = link.substr(queryIndex);
            var sendString = queryString + "&" + button + "=1";
            if ((button == "submitEvent") || (button == "editEvent")){
               var eventTitle = document.getElementById("eventTitle").value;
               var eventSTime = document.getElementById("eventSTime").value;
               var eventETime = document.getElementById("eventETime").value;
               var eventLoc = document.getElementById("eventLoc").value;
               var eventDescr = document.getElementById("eventDescr").value;
               sendString += "&eventTitle="+eventTitle;
               sendString += "&eventSTime="+eventSTime;
               sendString += "&eventETime="+eventETime;
               sendString += "&eventLoc="+eventLoc;
               sendString += "&eventDescr="+eventDescr;
               if (button == "editEvent") {
                  var index = -1;
                  var radios = document.getElementsByName("events");
                  for (var i=0; i<radios.length; i++) {
                     if(radios[i].checked) {
                        index = i;
                     }  
                  }
                  sendString += "&index="+index;
               }
            }
            //alert("sendString: " + sendString);
            xhttp.send(sendString);
         }
         function eventList() {
            var xhttp;
            if (window.XMLHttpRequest) {
               xhttp = new XMLHttpRequest();
            } else {
               xhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xhttp.onreadystatechange = function() {
               if (xhttp.readyState == 4 && xhttp.status == 200) {
                  document.getElementById("eventDisplay").innerHTML = xhttp.responseText;
               }
            };

            xhttp.open("POST", "events2.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var link = window.location.href;
            var queryIndex = link.indexOf("?d=")+1;
            var queryString = link.substr(queryIndex);
            var sendString = queryString + "&displayEvent=1";
            xhttp.send(sendString);
         }
         function eventDetails(number) {
            var xhttp;
            if (window.XMLHttpRequest) {
               xhttp = new XMLHttpRequest();
            } else {
               xhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xhttp.onreadystatechange = function() {
               if (xhttp.readyState == 4 && xhttp.status == 200) {
                  var arr = xhttp.responseText.split("&&&");
                  document.getElementById("eventInputs").style.visibility = "visible";
                  manipulatePlaceHolder(0);
                  document.getElementById("eventTitle").value = arr[0];
                  document.getElementById("eventSTime").value = arr[1];
                  document.getElementById("eventETime").value = arr[2];
                  document.getElementById("eventLoc").value = arr[3];
                  document.getElementById("eventDescr").value = arr[4];
              }
            };

            xhttp.open("POST", "events2.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var link = window.location.href;
            var queryIndex = link.indexOf("?d=")+1;
            var queryString = link.substr(queryIndex);
            var sendString = queryString + "&detailEvent=1&event=" +number;
            xhttp.send(sendString);
         }
         function manageEvent(button) {
            var radios = document.getElementsByName("events");
            var index = -1;
            for (var i=0; i<radios.length; i++) {
               if(radios[i].checked) {
                  index = i;
               }
            }
            if (index == -1) {
               alert("Please select an event");
            } else {
               if (button == "moveDate") {
                  var result = document.getElementById("targetDate").value;
                  var regex = /^(\d{2})\/(\d{2})\/(\d{4})$/;
                  var m;
                  //var regex = /^\s*([01]?\d|2[0-3]):?([0-5]\d)\s*$/;
                  if ((m = result.match(regex))) {
                     manageEventAJAX(button, index);
                  }
               } else {
                  manageEventAJAX(button, index);
               }
            }
         }
         function manageEventAJAX(buttonClicked, radioIndex) {
            var xhttp;
            if (window.XMLHttpRequest) {
               xhttp = new XMLHttpRequest();
            } else {
               xhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xhttp.onreadystatechange = function() {
               if (xhttp.readyState == 4 && xhttp.status == 200) {
                  addEvents(0);                 
                  eventList();
                  addOnClickEvent(); 
                  manageEventsDisplay();
               }
            };

            xhttp.open("POST", "events2.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var link = window.location.href;
            var queryIndex = link.indexOf("?d=")+1;
            var queryString = link.substr(queryIndex);
            var sendString = queryString + "&" + buttonClicked + "=1&index=" + radioIndex;
            if (buttonClicked == "moveDate") {
               var targetDate = document.getElementById("targetDate").value;
               sendString += "&targetDate="+targetDate;
            }
            xhttp.send(sendString);
         }
      </script>
   </body>
</html>

