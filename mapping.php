<?php  

    session_start();
     if(!isset($_SESSION['user_id']))
    {
        header("Location: index.php");
        exit;
    }
    $user_id = $_SESSION['user_id'] ;
    $ArrayText="";
    $block_id=0;
    $block_name='"main"';
    $level=0;
    $S_id=0;
    $S_name='"main"';
    
    if(isset($_GET['level']))
    {
    

        if ($_GET['level']==0) 
        {
        $url = "localhost/api/hardware/get_all_blocks.php";    
        $url = $url."?user_id=".$user_id;
            
        // create curl resource 
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, $url); 
        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        // $output contains the output string 
        $output = curl_exec($ch); 
        // close curl resource to free up system resources 
        curl_close($ch);
            
        $output = str_replace("\"", "'" , $output);
        $output = str_replace("\n", "" , $output);
        $ArrayText = '"' . $output . '"';
        }
        
        if ($_GET['level']==1) 
        {
            # code...blockId
            $S_id=$_GET['blockId'];
            $S_name=$_GET['blockName'];
            $S_name='"'.$S_name.'"';

            $block_id=$_GET['blockId'];
            $block_name=$_GET['blockName'];
            $block_name='"'.$block_name.'"';
            $level = $_GET['level'];

            $url = "localhost/api/hardware/get_rooms_block.php";    
            $url = $url."?user_id=".$user_id."&block_id=".$S_id;

            // create curl resource 
            $ch = curl_init(); 
            // set url 
            curl_setopt($ch, CURLOPT_URL, $url); 
            //return the transfer as a string 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            // $output contains the output string 
            $output = curl_exec($ch); 
            // close curl resource to free up system resources 
            curl_close($ch);
            $output = str_replace("\"", "'" , $output);
            $output = str_replace("\n", "" , $output);
            $ArrayText = '"' . $output . '"';
           
        }
        elseif ($_GET['level']==2) 
        {
            # code...
            $level = $_GET['level'];
            $S_id=$_GET['roomId'];
            $S_name=$_GET['roomName'];
            $S_name='"'.$S_name.'"';

            $block_id=$_GET['block_id'];
            $block_name=$_GET['block_name'];
            $block_name='"'.$block_name.'"';

            $url = "localhost/api/hardware/get_devices_room.php";   
            $url = $url . "?user_id=" . $user_id . "&room_id=" . $S_id ;
            // create curl resource 
            $ch = curl_init(); 
            // set url 
            curl_setopt($ch, CURLOPT_URL, $url); 
            //return the transfer as a string 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            // $output contains the output string 
            $output = curl_exec($ch); 
            // close curl resource to free up system resources 
            curl_close($ch);
        
            $output = str_replace("\"", "'" , $output);
            $output = str_replace("\n", "" , $output);
            $ArrayText = '"' . $output . '"';
            if (isset($_GET['switchOnOff']))
            {
            $message = explode("_", $_GET['switchOnOff']);
            $deviceID = $message[0];
            $newstate = isset($message[1]) ? $message[1] : null;
            
            if ($newstate == 'off') 
            {
                # code...
                $messageForDevice= "device".$deviceID."0" ; //  askAlaa   
                $url = "localhost/api/message/send_message.php";    
                $url = $url."?device_id=".$deviceID."&message=".$messageForDevice;
                
                // create curl resource 
                $ch = curl_init(); 
                // set url 
                curl_setopt($ch, CURLOPT_URL, $url); 
                //return the transfer as a string 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                // $output contains the output string 
                $output = curl_exec($ch); 
                // close curl resource to free up system resources 
                curl_close($ch);
                

                $url = "localhost/api/hardware/set_device_state.php";    
                $url = $url."?device_id=".$deviceID."&state=".$newstate;
                
                // create curl resource 
                $ch = curl_init(); 
                // set url 
                curl_setopt($ch, CURLOPT_URL, $url); 
                //return the transfer as a string 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                // $output contains the output string 
                $output = curl_exec($ch); 
                // close curl resource to free up system resources 
                curl_close($ch);
         
            }
            elseif ($newstate == 'on') 
            {
                # code...
                $messageForDevice= "device".$deviceID."1" ; //  askAlaa   
                
                $url = "localhost/api/message/send_message.php";    
                $url = $url."?node_id=".$deviceID."&message=".$messageForDevice;
                
                // create curl resource 
                $ch = curl_init(); 
                // set url 
                curl_setopt($ch, CURLOPT_URL, $url); 
                //return the transfer as a string 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                // $output contains the output string 
                $output = curl_exec($ch); 
                // close curl resource to free up system resources 
                curl_close($ch);                


                $url = "localhost/api/hardware/set_device_state.php";    
                $url = $url."?device_id=".$deviceID."&state=".$newstate;
                
                // create curl resource 
                $ch = curl_init(); 
                // set url 
                curl_setopt($ch, CURLOPT_URL, $url); 
                //return the transfer as a string 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                // $output contains the output string 
                $output = curl_exec($ch); 
                // close curl resource to free up system resources 
                curl_close($ch);

            }

            }
        }


    }
    else
    {
        $url = "localhost/api/hardware/get_all_blocks.php";    
        $url = $url."?user_id=".$user_id;
            
        // create curl resource 
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, $url); 
        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        // $output contains the output string 
        $output = curl_exec($ch); 
        // close curl resource to free up system resources 
        curl_close($ch);
            
        $output = str_replace("\"", "'" , $output);
        $output = str_replace("\n", "" , $output);
        $ArrayText = '"' . $output . '"';
        
    }
     
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="css/styles.css">

    <title>Devices Mapping</title>
</head>


<body>
    <div id="container">

        <div id="menu">
            <div id="menulist">
                <a href="index.php">
                    <img id="home" src="images\home.png" class="pad" height="50" width="50" />
                </a>
                <a href="power-consumption.php">
                    <img src="images\powercons.png" class="pad" height="50" width="50" />
                </a>
                <a href="mapping.php">
                    <img src="images\mapping.png" class="pad" height="50" width="50" />
                </a>
                <a href="power-schedule.php">
                    <img src="images\powersch.png" class="pad" height="50" width="50" />
                </a>
                <a href="billing.php">
                    <img id="bill" src="images\billing.png" class="pad" height="50" width="50" />
                </a>
            </div>
        </div>
        
    <div id="header">
        
        <img id="profilepics" src="images/defaultpp.jpg" height="50" width="50"/>
            <span id="username">hi' <?php echo $_SESSION['user_name']; ?></span>
        <br>
        <button id="signOut" onclick="location.href='logout.php';" >Sign Out</button>
    </div>
        <div id="content">
            <div>
                <p id="devicesMappingText">Devices Mapping</p>
                <button id='moveBackButton' style='width:120px; height:30px'>Back</button>
            </div>
            <canvas id="mapping_canvas" height="100px" width="100px">
                Your browser needs to be updated.
            </canvas>
        </div>
        <form id="form1" method="GET" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']); ?>">
            <input id="input1" type="text" name="level">
            <input id="input2" type="text" name="someThingId">
            <input id="input3" type="text" name="someThingName">
            <input id="input4" type="text" name="block_id">
            <input id="input5" type="text" name="block_name">
            <input id="input6" type="text" name="switchOnOff">
            <input id="submit1" type="submit" name="sumbitButton" value="SubmitNow">
        </form>
    </div>
    
    <!-- SCRIPTS -->
    <!-- Jquery -->
    <script src="assets/js/jquery-1.10.2.js"></script>

    <!-- a SCRIPT for all pages -->
    <script type="text/javascript" src="javascript\allPages.js"></script>


    <!-- mapping.php main script -->
    <script type="text/javascript">
    $(document).ready(function() {

    // hiding the form elements
    $('#form1').hide();

    var level = <?php echo $level ; ?> ;  // indicate in which level the user is (block=0, room=1, device=2)

    // show/hide back button
    if (level == 0)
        $("#moveBackButton").css("visibility", "hidden");
    else
        $("#moveBackButton").css("visibility", "visible");
    
    // add user ID and name to clickedCircleName
    var clickedCircleName = { id: 0, name: "main" };
    clickedCircleName.id = <?php echo $S_id; ?>;
    clickedCircleName.name = <?php echo $S_name ; ?> ;
    // get user Id from database.
    var userId = <?php echo $user_id ;?>;

    var blockName = "" ;
    var blockId =  "" ;
    // get block name and blockId
    if (level != 0) {
        blockName = <?php echo $block_name; ?>;
        blockId = <?php echo $block_id ;?>;
    }

    var roomId, deviceId = 0;  // to be used when clicking on back button.

    // get IDs and names that belong to the clicked circle
    var textFromPHP =  <?php echo  $ArrayText ; ?> ;
    var namesArray = [];

    if (level == 0) {
        // block level, get block names of the current user  

        /*
        { blocks_ids : [ “id0”, “id1”, “id2”, …] , 
        blocks_names : [ “name0”, “name1”, “name2”, …]}
        */
        
        var blocksArrayText = textFromPHP;
        while(blocksArrayText.indexOf("'") != -1){
                blocksArrayText = blocksArrayText.replace("'", '"');
        }
        try {
                
            var blocksArrayObj = JSON.parse(blocksArrayText);
            for (var i = 0; i < blocksArrayObj.blocks_ids.length; i++){
                namesArray.push({id: parseInt(blocksArrayObj.blocks_ids[i]), name: blocksArrayObj.blocks_names[i]});
            }
        }
        catch(err) {
            $("#devicesMappingText").text = "ERROR";
        }

    }
    else if (level == 1) {
        // room level, get room names of the current block(clickedCircleName) 

        /*
        {"rooms_ids":[“id0”, “id1”, “id2”, …],
        "rooms_names":[ “name0”, “name1”, “name2”, …]}
        */
        
        var roomsArrayText = textFromPHP;
        while(roomsArrayText.indexOf("'") != -1){
                roomsArrayText = roomsArrayText.replace("'", '"');
            }
        try {
                
            var roomsArrayObj = JSON.parse(roomsArrayText);
            for (var i = 0; i < roomsArrayObj.rooms_ids.length; i++){
                namesArray.push({id: parseInt(roomsArrayObj.rooms_ids[i]), name: roomsArrayObj.rooms_names[i]});
            }
        }
        catch(err) {
            $("#devicesMappingText").text = "ERROR";
        }
        

    }
    else if (level == 2) {

        
        // device level, get device names of the current room(clickedCircleName). 

        var devicesArrayText = textFromPHP;
        while(devicesArrayText.indexOf("'") != -1){
                devicesArrayText = devicesArrayText.replace("'", '"');
            }
        try {
                
            var devicesArrayObj = JSON.parse(devicesArrayText);
            
            for (var i = 0; i < devicesArrayObj.devices_ids.length; i++){
                namesArray.push({id: parseInt(devicesArrayObj.devices_ids[i]), name: devicesArrayObj.devices_names[i]});
            }
        }
        catch(err) {
            $("#devicesMappingText").text = "ERROR";
        }

    }


    // update position, shows where exactly we are 
    if (level == 0) {
        $("#devicesMappingText").text("Devices Mapping");
    }
    else if (level == 1) {
        $("#devicesMappingText").text("Devices Mapping => " + clickedCircleName.name);
    }
    else if (level == 2) {
        $("#devicesMappingText").text("Devices Mapping => " + blockName + " => " + clickedCircleName.name);
    }






    // set canvas and its properties
    var canvas = document.getElementById('mapping_canvas'),
        canvasLeft = $("#mapping_canvas").offset().left,
        canvasTop = $("#mapping_canvas").offset().top,
        contentTop = $("#content").offset().top,
        ctx = canvas.getContext('2d');
    // set the canvas size
    var contentHeight = $("#content").height();
    var heightOf10Names = $("#content").height() - (canvasTop - contentTop);
    canvas.width = $("#content").width();
    canvas.height = heightOf10Names;

    // Determine the center of the canvas
    var canvasWidth = $("#mapping_canvas").width();
    var canvasHeight = $("#mapping_canvas").height();
    var center = { x: canvasWidth / 2, y: canvasHeight / 2 };

    function toRadians(angle) {
        /* converts angle from degrees to radians */
        return angle * (Math.PI / 180);
    }

    function setCirclesPosition(circlesNumber) {
        /*
        determine the Position of each Circle.
        Input:-
        circlesNumber : number of circles to be drawn
        Return:-
        Json { mainCircles: array of Jsons with the x,y,r values of main circles,
               smallCircles: array of Jsons with the x,y,r values of each circle }.
        */

        var mainCirclesPosition = [];
        var smallCirclesPosition = [];   // the array to be returned
        // add the main circle(s) to the array of main circles
        for (var i = 0; i <= Math.floor(circlesNumber / 10); i++) {
            mainCirclesPosition.push({ x: center.x, y: center.y + i * heightOf10Names, r: 75 });
        }

        // calculate x,y coordinate of each circle
        var length, theta, x, y, dx, dy = 0
        for (var i = 0; i < circlesNumber; i++) {
            // distance between main circle and this circle
            if (i % 2)
                length = 220;
            else
                length = 170;
            // angle of line between main circle and this circle
            theta = toRadians((i % 10) * (360 / 10));

            // x,y coordinate of this circle
            dx = length * Math.cos(theta);
            dy = length * Math.sin(theta);
            x = center.x + dx;
            y = center.y + dy;

            // add this circle to the array of circles
            smallCirclesPosition.push({ x: x, y: y + Math.floor(i / 10) * heightOf10Names, r: 50 });
        }

        return { mainCircles: mainCirclesPosition, smallCircles: smallCirclesPosition };
    }

    function drawCircles(circlesPosition) {
        // draw the desired number of circles and the main circle

        circlesPosition.mainCircles.forEach(function(circle) {
            ctx.beginPath();
            ctx.arc(circle.x, circle.y, circle.r, 0, 2 * Math.PI);
            ctx.fillStyle = 'rgb(89, 89, 89)';
            ctx.fill();
            ctx.lineWidth = 5;
            ctx.strokeStyle = 'rgb(156, 156, 156)';
            ctx.stroke();
        });
        circlesPosition.smallCircles.forEach(function(circle) {
            ctx.beginPath();
            ctx.arc(circle.x, circle.y, circle.r, 0, 2 * Math.PI);
            ctx.fillStyle = 'rgb(89, 89, 89)';
            ctx.fill();
            ctx.lineWidth = 3;
            ctx.strokeStyle = 'rgb(156, 156, 156)';
            ctx.stroke();
        });

    }

    function drawLines(circlesPosition) {
        /*
        draw lines between the main circles and small circles
        connected to them and lines between the main circles.
        */

        //draw lines between the main circles and small circles connected to them.
        circlesPosition.smallCircles.forEach(function(circle, index) {
            ctx.beginPath();
            ctx.moveTo(circlesPosition.mainCircles[Math.floor(index / 10)].x, circlesPosition.mainCircles[Math.floor(index / 10)].y); // from the main circle
            ctx.lineTo(circle.x, circle.y);
            ctx.stroke();
        });
        // draw lines between the main circles.
        for (var i = 0; i < circlesPosition.mainCircles.length - 1; i++) {
            ctx.beginPath();
            ctx.moveTo(circlesPosition.mainCircles[i].x, circlesPosition.mainCircles[i].y); // from the main circle
            ctx.lineTo(circlesPosition.mainCircles[i + 1].x, circlesPosition.mainCircles[i + 1].y);
            ctx.stroke();
        }
    }


    function nameCircles(namesArray, clickedCircleName, circlesPosition) {
        /*
        show the name of each (room or device) on a circle.
        Input:-
        namesArray : array of Strings, represents the name of each (room or device)
        clickedCircleName : id and name of each circle
        circlesPosition : array of Jsons, with the position and radius of each circle
        */
        var text = "";  // the text to be written on each circle.
        ctx.font = "16px Arial";
        ctx.fillStyle = 'black';
        // draw main circles' names.
        circlesPosition.mainCircles.forEach(function(circle, index) {
            //if name is too long, take the first 6 letters and add "..."
            if (clickedCircleName.name.length > 6)
                text = clickedCircleName.name.slice(0, 6) + "...";
            else
                text = clickedCircleName.name;
            // draw Circle's name at the center of the circle.
            var textWidth = ctx.measureText(text).width;
            ctx.fillText(text, circle.x - textWidth / 2, circle.y);
        });
        // draw small circles' names.
        circlesPosition.smallCircles.forEach(function(circle, index) {
            //if name is too long, take the first 6 letters and add ...
            if (namesArray[index].name.length > 6)
                text = namesArray[index].name.slice(0, 6) + "...";
            else
                text = namesArray[index].name;
            // draw Circle's name at the center of the circle.
            var textWidth = ctx.measureText(text).width;
            ctx.fillText(text, circle.x - textWidth / 2, circle.y);
        });


    }


    function drawCanvas(level, clickedCircleName) {
        /*
        draw the canvas ( Lines, Circles, Names ) of
        (blocks, rooms or devices) that belongs to the clickedCircleName
        Input:-
        level : the level in which the user is (block=0, room=1, device=2)
        clickedCircleName : name of the clicked circle.
        */

        // set the position of the circles.
        circlesPosition = setCirclesPosition(namesArray.length);
        // set the height of the canvas (increase height for each 10 names) and modify content height
        canvas.height = (Math.floor(namesArray.length / 10) + 1) * heightOf10Names;
        $("#content").height($("#mapping_canvas").height() + 100);
        // draw the canvas following this precedence ( Lines => Circles => Names )
        drawLines(circlesPosition);
        drawCircles(circlesPosition);
        nameCircles(namesArray, clickedCircleName, circlesPosition);



    }

    function createDeviceInfoDiv() {
        // create Device Information Div
        var createDiv = "<div id='showDeviceInfo' style='width:240px; height:180px'></div>";
        $("#content").append(createDiv);
        var deviceInfoDiv = document.getElementById('showDeviceInfo')
        // style div
        $("#showDeviceInfo").css("background-color", "rgb(172, 157, 126)");
        $("#showDeviceInfo").css("position", "fixed");
        $("#showDeviceInfo").css("z-index", "1");
        $("#showDeviceInfo").css("left", "100px");
        $("#showDeviceInfo").css("bottom", "20px");
        // create div elements
        // device name paragraph
        $("#showDeviceInfo").append("<p id='deviceName' style='width:240px; color:white'></p>");
        $("#deviceName").css("margin-left", "10px");
        // device operating time paragraph
        $("#showDeviceInfo").append("<p id='deviceOperatingTime' style='width:240px; color:white'></p>");
        $("#deviceOperatingTime").css("margin-left", "10px");
        // create device state button
        $("#showDeviceInfo").append("<button id='changeStateButton' style='width:120px; height:40px'></button>");
        $("#changeStateButton").css("background-color", "rgb(203, 203, 203)");
        $("#changeStateButton").css("position", "absolute");
        $("#changeStateButton").css("z-index", "1");
        $("#changeStateButton").css("left", "0");
        $("#changeStateButton").css("bottom", "20px");
        // update schedule button
        $("#showDeviceInfo").append("<form method='GET' action='power-schedule.php'><input id='updateScheduleButton' type='submit' name='deviceIdFromMapping' value='Update Schedule'></form>");
        $("#updateScheduleButton").css("background-color", "rgb(203, 203, 203)");
        $("#updateScheduleButton").css("position", "absolute");
        $("#updateScheduleButton").css("z-index", "1");
        $("#updateScheduleButton").css("left", "120px");
        $("#updateScheduleButton").css("bottom", "20px");
        $("#updateScheduleButton").css("height", "40px");
        // hide Device Info Div
        $("#showDeviceInfo").hide();
    }

    function getAndShowDeviceInfo(clickedCircleName) {
        /*
        get the device's Information from database, and show it
        at the bottom left corner of screen.
        Input:-
        clickedCircleName : id and name of the device.
        
        get device's Information from database. where:-
        operatingTime = the clicked device operating time
        deviceState = the clicked device state 
        */
        // find index of the clicked device in namesArray
        for ( var i = 0; i < namesArray.length; i++){
            if (clickedCircleName == namesArray[i]){
                var index = i;
                break;
            }
        }
        var deviceState = devicesArrayObj.state[index];
        var operatingTime = "02:30 hours";

        // show device's Information at the bottom left corner of screen.
        // device name paragraph
        $("#deviceName").text("Device name: " + clickedCircleName.name);
        // device operating time paragraph
        $("#deviceOperatingTime").text("Operating Time: " + operatingTime);
        // change device state button
        if (deviceState == "on")
            var switchStateButtonText = "Switch OFF";
        else if (deviceState == "off")
            var switchStateButtonText = "Switch ON";
        else {       // if the device is disconnected, write disconnected and disable the button
            var switchStateButtonText = "Disconnected"
            $("#changeStateButton").attr("disabled", "disabled");
        }
        $("#changeStateButton").text(switchStateButtonText);
        /******************** changeStateButton **************/
        // change the State of the clicked device
        $("#changeStateButton").click(function() {
            var url = window.location.href;     // Returns full URL
            // insert device_id and the toggling state to the url
            if (deviceState == "on")
                var toggleState = "off";
            else
                var toggleState = "on";
            var startIndex = url.search("switchOnOff");
            var addOnIndex = url.indexOf("=", startIndex) + 1;
            var endIndex = url.indexOf("&", startIndex);
            // remove last value of switchOnOff input
            url = [url.slice(0, addOnIndex), url.slice(endIndex)].join('');
            var insertString = clickedCircleName.id + "_" + toggleState;
            url = [url.slice(0, addOnIndex), insertString, url.slice(addOnIndex)].join('');
            // go to the same page put with the value of switchOnOff
            location.href = url;
        });
        /******************** Update Power Schedule button**************/
        // update schedule button, on click send device_id to power schedule page
        // get the schedule of the clicked device and show it in power schedule page
        $("#updateScheduleButton").click(function() {
            $("#updateScheduleButton").val(clickedCircleName.id);
       });

        // show the hidden div
        $("#showDeviceInfo").show();


    }

    // start drawing the canvas
    var circlesPosition;
    
    drawCanvas(level, clickedCircleName);
    createDeviceInfoDiv();


    /*********** Mouse Click Event Handling *************/

    /******************** back button**************/
    $("#moveBackButton").click(function() {
        // hide Device Info Div
        $("#showDeviceInfo").hide();

        // get Id of current level.
        var currentId = 0;
        if (level == 1)
            currentId = userId;
        if (level == 2)
            currentId = blockId;

        // go to previous level
        level--;
        ctx.clearRect(0, 0, canvas.width, canvas.height);   // clear the canvas
        
        // clear old values of circlesPosition to redraw again
        circlesPosition.mainCircles = [];
        circlesPosition.smallCircles = [];
        // redraw the canvas
        
        var gotoName = "";
        if (level == 0)
            gotoName = "main";
        else
            var sliceFrom = $("#devicesMappingText").text().indexOf(">") + 2;
            var sliceTo = $("#devicesMappingText").text().lastIndexOf("=") - 1;
            gotoName = $("#devicesMappingText").text().slice(sliceFrom, sliceTo);
        var clickedCircleName = { id: currentId, name: gotoName };
        alert(clickedCircleName.name);
        if (level == 0) {
            //change inputs name
            $('#input2').attr('name', 'userId');
            $('#input3').attr('name', 'userName');
            // change inputs value
            $("#input1").val(level);
            $("#input2").val(clickedCircleName.id);
            $("#input3").val(clickedCircleName.name);
            $("#input4").val("");
            $("#input5").val("");
            // submit the form by a click event
            $("#submit1").click();
        }
        else if (level == 1) {
            //change inputs name
            $('#input2').attr('name', 'blockId');
            $('#input3').attr('name', 'blockName');
            // change inputs value
            $("#input1").val(level);
            $("#input2").val(clickedCircleName.id);
            $("#input3").val(clickedCircleName.name);
            $("#input4").val(blockId);
            $("#input5").val(blockName);
            // submit the form by a click event
            $("#submit1").click();
        }
    });

    /******************** changeStateButton **************/
    // handled in getAndShowDeviceInfo function
    /******************** Update Power Schedule button**************/
    // handled in getAndShowDeviceInfo function

    /******************** Click on Canvas **************/

    // Add event listener for `click` events.
    canvas.addEventListener('click', function(event) {
        // get the position of the click (x,y) relative to the canvas.
        var x = event.pageX - canvasLeft,
            y = event.pageY - canvasTop;

        // loop over each circle determining which circle is clicked.
        circlesPosition.smallCircles.every(function(circle, index) {

            var distance = Math.sqrt(Math.pow(x - circle.x, 2) + Math.pow(y - circle.y, 2));

            // if a small circle is pressed
            if (distance < circle.r) {
                if (level == 0)
                    blockId = namesArray[index].id;
                if (level == 1)
                    roomId = namesArray[index].id;
                if (level == 2)
                    deviceId = namesArray[index].id;

                clickedCircleName = namesArray[index];   // name and id of the circle.
                // move to the next level
                if (level < 2) {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);   // clear the canvas
                    // clear old values of circlesPosition to redraw again
                    circlesPosition.mainCircles = [];
                    circlesPosition.smallCircles = [];
                    // redraw the canvas
                    if (level == 0) {
                        //change inputs name
                        $('#input2').attr('name', 'blockId');
                        $('#input3').attr('name', 'blockName');
                        // change inputs value
                        $("#input1").val(level + 1);
                        $("#input2").val(clickedCircleName.id);
                        $("#input3").val(clickedCircleName.name);
                        $("#input4").val(clickedCircleName.id);
                        $("#input5").val(clickedCircleName.name);
                        // submit the form by a click event
                        $("#submit1").click();
                    }
                    else if (level == 1) {
                        //change inputs name
                        $('#input2').attr('name', 'roomId');
                        $('#input3').attr('name', 'roomName');
                        // change inputs value
                        $("#input1").val(level + 1);
                        $("#input2").val(clickedCircleName.id);
                        $("#input3").val(clickedCircleName.name);
                        $("#input4").val(blockId);
                        $("#input5").val(blockName);
                        // submit the form by a click event
                        $("#submit1").click();
                    }
                }
                else if (level == 2)   // device is clicked Get and Show device's information
                    getAndShowDeviceInfo(clickedCircleName);
                return false;   // break loop
            }
            else
                return true;    // continue loop

        });

    }, false);

    //////////////////////////////////////////  end  Mouse Click Event Handling

    /*********** Mouse Over Event Handling *************/

    /*********** Mouse Over Canvas *************/

    // show the whole name of the circle on which the mouse is.
    $("#mapping_canvas").mousemove(function(event) {
        // get the position of the click (x,y) relative to the canvas.
        var x = event.pageX - canvasLeft,
            y = event.pageY - canvasTop;

        // clear tooltip when the mouse is not on a circle.
        $("#mapping_canvas").attr('title', '');

        // loop over each circle determining which circle the mouse is over.
        circlesPosition.smallCircles.every(function(circle, index) {

            var distance = Math.sqrt(Math.pow(x - circle.x, 2) + Math.pow(y - circle.y, 2));

            // if the mouse is on a small circle
            if (distance < circle.r) {
                clickedCircleName = namesArray[index];   // name and id of the circle.
                // show tooltip when the mouse is on a circle.
                $("#mapping_canvas").attr('title', clickedCircleName.name);
                return false;   // break loop
            }
            else
                return true;    // continue looping

        });
    });

});
</script>
    




</body>

</html>
