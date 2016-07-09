<?php  

    session_start();
     if(!isset($_SESSION['user_id']))
    {
        header("Location: index.php");
        exit;
    }

    $user_id = $_SESSION['user_id'] ;
    $roomsArrayText = $devicesArrayText =$block_id = $room_id =$dName=$Room_ID =$room_name=$Block_ID=$Block_Name =$deviceDurationsTextFromMapping='""';
    $GLOBALS['device_id'] = '""';

    $url = "http://196.205.93.181:22355/api/hardware/get_all_blocks.php";    
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
    $blocksArrayText = '"' . $output . '"';

    if (isset($_GET['deviceIdFromMapping'])) 
    {
        # Device Info

        $deviceIdFromMapping =$_GET['deviceIdFromMapping'];
        $url = "http://196.205.93.181:22355/api/hardware/get_device_info.php";    
        $url = $url."?device_id=".$deviceIdFromMapping;    
        // create curl resource 
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, $url); 
        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        // $output contains the output string 
        $out1 = curl_exec($ch); 
        // close curl resource to free up system resources 
        curl_close($ch);
        $out1 = json_decode($out1,true);
        $dName=$out1['device_name'];
        $dName='"'.$dName .'"';
        $node_id=$out1['node_id'];  

        //  All Durations
        $url = "http://196.205.93.181:22355/api/schedule/get_all_durations.php";    
        $url = $url."?device_id=".$deviceIdFromMapping;
        // create curl resource 
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, $url); 
        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        // $output contains the output string 
        $out2 = curl_exec($ch); 
        // close curl resource to free up system resources 
        curl_close($ch);
        $out2 = str_replace("\"", "'" , $out2);
        $out2 = str_replace("\n", "" , $out2);
        $out2 = '"' . $out2 . '"';
        $deviceDurationsTextFromMapping = $out2;

        // Node Info
        $url = "http://196.205.93.181:22355/api/hardware/get_node_info.php";    
        $url = $url."?node_id=".$node_id;
        // create curl resource 
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, $url); 
        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        // $output contains the output string 
        $out3 = curl_exec($ch); 
        // close curl resource to free up system resources 
        curl_close($ch);

        $out3 = json_decode($out3,true);
        $Room_ID = $out3['room_id'];
       
        //  Room Info
        $url = "http://196.205.93.181:22355/api/hardware/get_room_info.php";    
        $url = $url."?room_id=".$Room_ID; 
        // create curl resource 
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, $url); 
        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        // $output contains the output string 
        $out4 = curl_exec($ch); 
        // close curl resource to free up system resources 
        curl_close($ch);
        $out4 = json_decode($out4,true);
        $room_name= $out4['room_name'];
        $room_name= '"'. $room_name .'"';
        $Block_ID = $out4['block_id'];

        //  Block Info
        $url = "http://196.205.93.181:22355/api/hardware/get_block_info.php";    
        $url = $url."?block_id=".$Block_ID;
        // create curl resource 
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, $url); 
        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        // $output contains the output string 
        $out5 = curl_exec($ch); 
        // close curl resource to free up system resources 
        curl_close($ch);
       
        $out5 = json_decode($out5,true);

        $Block_Name=$out5['block_name'];
        $Block_Name= '"'.$Block_Name.'"';
    }
    else
    {
        $deviceIdFromMapping = '""';
    }


    if(isset($_GET['sumbit']))
    {
        if ($_GET['sumbit'] =="SubmitNow" ) {
            # code...
        }
        if (isset($_GET['blockId2']))
        {
            # code...
            $block_id=$_GET['blockId2'];

            $url = "http://196.205.93.181:22355/api/hardware/get_rooms_block.php";    
            $url = $url."?user_id=".$user_id."&block_id=".$block_id;
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
            $roomsArrayText = '"' . $output . '"';
        }
        if ($_GET['roomId2'] != "" ) 
        {
            # code...
            $room_id=$_GET['roomId2'] ;
            $url = "http://196.205.93.181:22355/api/hardware/get_devices_room.php";    
            $url = $url . "?user_id=" . $user_id . "&room_id=" . $room_id ;
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
            $devicesArrayText = '"' . $output . '"';
        }
        if ($_GET['deviceId2'] != "" ) 
        {
            # code...
            $device_id=$_GET['deviceId2'];
            $_SESSION["device_id"]=$_GET['deviceId2'];
            echo $_SESSION["device_id"] ;
        }


        if ($_GET['showDurations']=='true') 
        {
            # code...
            $url = "http://196.205.93.181:22355/api/schedule/get_all_durations.php";    
            $url = $url ."&device_id=" . $device_id ;
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
            $DurationsText = '"' . $output . '"';
        }
    }
    if (isset($_GET['submit']) && isset($device_id) )
    {
        if ($_GET['submit']==="save_schedule") 
        {
            # code...
            echo $_SESSION["device_id"] ;
            $start_time = "0000-00-00 ".$_GET['start-time'].":00";
            $end_time  = "0000-00-00 " .$_GET['end-time'].":00";
            $data=array("device_id"=>$_SESSION["device_id"] ,"day"=>$_GET['days'],"start_time"=>$start_time,"end_time"=>$end_time,"repetition"=> $_GET['repetition'])   ;

            $jsonData=urlencode(json_encode($data));
            $url="http://196.205.93.181:22355/api/schedule/set_schedule.php";

            $ch=curl_init($url);  curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"POST");   
            curl_setopt($ch,CURLOPT_POSTFIELDS,array("data"=>$jsonData));  
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
            $result=curl_exec($ch);
            curl_close($ch);
        }
    }
    if (isset($_GET['showDurations'])) 
    {
        # code...
        if ($_GET['showDurations']=="true") 
        {
            # code...
            $url = "http://196.205.93.181:22355/api/schedule/get_all_durations.php";    
            $url = $url."?device_id=".$_SESSION["device_id"];
            // create curl resource 
            $ch = curl_init(); 
            // set url 
            curl_setopt($ch, CURLOPT_URL, $url); 
            //return the transfer as a string 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            // $output contains the output string 
            $out2 = curl_exec($ch); 
            // close curl resource to free up system resources 
            curl_close($ch);
            $out2 = str_replace("\"", "'" , $out2);
            $out2 = str_replace("\n", "" , $out2);
            $out2 = '"' . $out2 . '"';
            $deviceDurationsTextFromMapping = $out2;
        }
    }

?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Power Schedule</title>

    <!--STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/basic.css" rel="stylesheet">

    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="css/styles.css">



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
            <div id="page-inner">
                <!--/.ROW-->
                <div class="row">
                    <form action="" method="">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    POWER SCHEDULE
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div id="selectBlockDiv">
                                            <label>Select Block:-</label>
                                            <select id="blockSelect" class="form-control" name="blockId">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div id="selectRoomDiv">
                                            <label>Select Room:-</label>
                                            <select id="roomSelect" class="form-control" name="roomId">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div id="selectDeviceDiv">
                                            <label>Select Device:-</label>
                                            <select id="deviceSelect" class="form-control" name="deviceId">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div id="daysSelect" class="form-group">
                                        <label>Select Days:</label>
                                        <div class="checkboxInline">
                                            <label>
                                                <input type="checkbox" value="Sat" name="days[]">Satday
                                            </label>
                                        </div>
                                        <div class="checkboxInline">
                                            <label>
                                                <input type="checkbox" value="Sun" name="days[]">Sunday
                                            </label>
                                        </div>
                                        <div class="checkboxInline">
                                            <label>
                                                <input type="checkbox" value="Mon" name="days[]">Monday
                                            </label>
                                        </div>
                                        <div class="checkboxInline">
                                            <label>
                                                <input type="checkbox" value="Tue" name="days[]">Tueday
                                            </label>
                                        </div>
                                        <div class="checkboxInline">
                                            <label>
                                                <input type="checkbox" value="Wed" name="days[]">Wednesday
                                            </label>
                                        </div>
                                        <div class="checkboxInline">
                                            <label>
                                                <input type="checkbox" value="Thu" name="days[]">Thursday
                                            </label>
                                        </div>
                                        <div class="checkboxInline">
                                            <label>
                                                <input type="checkbox" value="Fri" name="days[]">Friday
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label>Repetition :-</label>
                                        <select id="repetitionSelect" class="form-control" name="repetition">
                                            <option value=""></option>
                                            <option value="once">once</option>
                                            <option value="weekly">weekly</option>
                                            <option value="this month">this month</option>
                                            <option value="this year">this year</option>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label>Select Duration :-</label>
                                        <div>
                                            <label>
                                                Start :
                                                <input id="startTimeInput" type="time" name="start-time">
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                End :
                                                <input id="endTimeInput" type="time" name="end-time">
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <input type="submit" value="save_schedule" name="submit" />
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <button id="showRightPanelButton" class="btn btn-lg btn-primary" style='width:180px; height:50px' >Show All Durations</button>
                        <div id="rightPanel" class="panel panel-default">
                            <div class="panel-heading">
                                Saved schedules goes here
                            </div>
                            <div id="mainDivAfterSave" class="panel-body">
                                <table id="rightPanelTable" style="width:100%">
                                    <tr id="headerRow">
                                        <th>
                                            Device
                                        </th>
                                        <th>
                                            Duration
                                        </th>
                                        <th>
                                            Repetition
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <form id="form1" method="GET" action="power-schedule.php">
                        <input id="showDurations" type="text" name="showDurations" value="false">
                        <input id="blockId2" type="text" name="blockId2">
                        <input id="roomId2" type="text" name="roomId2" >
                        <input id="deviceId2" type="text" name="deviceId2" >
                        <input id="submit1" type="submit" name="sumbit" value="SubmitNow">
                    </form>


                </div>
            </div>
        </div>
    </div>
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- a SCRIPT for all pages -->
    <script type="text/javascript" src="javascript\allPages.js"></script>
    
    
    <!-- power-schedule.php main SCRIPT -->
<script type="text/javascript" >
$(document).ready(function() {
    // hide the right panel, and show it when the user click the right button
    $("#rightPanel").hide();

    // hide the form elements
    $('#form1').hide();

    // get values from PHP

    var deviceIdFromMapping = <?php echo $deviceIdFromMapping ; ?>;
    var deviceNameFromMapping = <?php echo $dName ; ?>;
    var deviceDurationsTextFromMapping = <?php echo $deviceDurationsTextFromMapping; ?>;
    var roomIdFromMapping = <?php echo $Room_ID ?>;
    var roomNameFromMapping = <?php echo  $room_name ?>;
    var blockIdFromMapping = <?php echo $Block_ID ?>;
    var blockNameFromMapping = <?php echo $Block_Name; ?>;

    // get current user Id
    var userId =  <?php echo $user_id ; ?> ;
    // always get the blocks belong to userId
    var blocksText = <?php echo $blocksArrayText ; ?>;
    // if block is not selected put "" in roomsText
    var roomsText = <?php echo $roomsArrayText ; ?>;
    // if room is not selected put "" in devicesText
    var devicesText = <?php echo $devicesArrayText ; ?>;

    // if block is not selected put "" in blockId
    var blockId = <?php echo $block_id ?>;
    // if room is not selected put "" in roomId
    var roomId = <?php echo $room_id; ?>;
    // if device is not selected put "" in deviceId
    var deviceId = <?php echo $device_id ; ?>;


    // get blocks belong to the current user
    var blocksArray = getBlocks(blocksText);


    // Disable all fields except select Block.
    $("select").attr("disabled", "disabled");
    $("input").attr("disabled", "disabled");
    $("#blockSelect").removeAttr("disabled");


    // add options to block select tag. value => id, text => name
    for (var i = 0; i < blocksArray.length; i++) {
        $("#blockSelect").append($('<option>', { value: blocksArray[i].id, text: blocksArray[i].name }));
    }


    if (blockId != "") { // a block is selected
        // Disable all fields except select Block.
        $("select").attr("disabled", "disabled");
        $("input").attr("disabled", "disabled");
        $("#blockSelect").removeAttr("disabled");
        // choose the selected block
        $('#blockSelect option[value=' + blockId + ']').prop('selected', true);
        // remove the previous options to add new ones
        $("#roomSelect option").remove();
        $("#deviceSelect option").remove();
        // add the first(empty) option
        $('#roomSelect').append($('<option>', { value: "", text: "" }));
        // enable rooms select tag
        $("#roomSelect").removeAttr("disabled");

        // get rooms belong to the selected block
        var roomsArray = getRooms(roomsText);
        // add options to room select tag. value => id, text => name
        for (var i = 0; i < roomsArray.length; i++) {
            $("#roomSelect").append($('<option>', { value: roomsArray[i].id, text: roomsArray[i].name }));
        }

    }
    if (roomId != "") { // a room is selected

        // Disable all fields except select Block and room.
        $("select").attr("disabled", "disabled");
        $("input").attr("disabled", "disabled");
        $("#blockSelect").removeAttr("disabled");
        $("#roomSelect").removeAttr("disabled");
        // choose the selected block and room
        $('#blockSelect option[value=' + blockId + ']').prop('selected', true);
        $('#roomSelect option[value=' + roomId + ']').prop('selected', true);
        // remove the previous options to add new ones
        $("#deviceSelect option").remove();
        // add the first(empty) option
        $('#deviceSelect').append($('<option>', { value: "", text: "" }));
        // enable devices select tag
        $("#deviceSelect").removeAttr("disabled");

        var devicesArray = getDevices(devicesText);

        // add options to devices select tag. value => id, text => name
        for (var i = 0; i < devicesArray.length; i++) {
            $("#deviceSelect").append($('<option>', { value: devicesArray[i].id, text: devicesArray[i].name }));
        }

    //marwan
    }
    if (deviceId != "") { // a device is selected
        // choose the selected block , room and device
        $('#blockSelect option[value=' + blockId + ']').prop('selected', true);
        $('#roomSelect option[value=' + roomId + ']').prop('selected', true);
        $('#deviceSelect option[value=' + deviceId + ']').prop('selected', true);
        // enable all elements of the form.
        $("select").removeAttr("disabled");
        $("input").removeAttr("disabled");
    }

    var savedDurationsText = "";
    // if showRightPanelButton is not clicked, savedDurationsText = "", do not call showDurations

    if (savedDurationsText != "") {
        $("#rightPanel").show();
        var durationsArray = getSavedDurations(savedDurationsText);
        showDurations(durationsArray);
    }


    function getSavedDurations(savedDurationsText) 
    {
        
        /*
        i may change this function to transform the text coming 
        from the API into array of json like this example.
        but it won't take the user_id it would take the durationsText
        from the API
        */
        /*
        gets all saved Durations of power schedules from database.
        Input:-
        userId: the Id of the current user.
        Return:-
        durationsArray: array of Jsons with this format.
        durationsArray = [{
            id: duration_id,
            startTime: start time of this duration,
            endTime: end time of this duration,
            repetition: repetition of this duration,
            days : days of this duration,
            createDate: date at which this duration is created,
            deviceId: Id of the related Device,
            deviceName: name of the related Device,
            roomId: Id of the related Room,
            roomName: name of the related Room,
            blockId: Id of the related Block,
            blockName: name of the related Block
        },]
        */

        while (savedDurationsText.indexOf("'") != -1) {
            savedDurationsText = savedDurationsText.replace("'", '"');
        }
        var savedDurationsObj = JSON.parse(savedDurationsText);
        var durationsArray = [];
        for (var i = 0; i < savedDurationsObj.duration_id.length; i++) {
            durationsArray.push({
                id: parseInt(savedDurationsObj.duration_id[i]),
                startTime: savedDurationsObj.durations_start_time[i],
                endTime: savedDurationsObj.durations_end_time[i],
                repetition: savedDurationsObj.durations_repetition[i],
                days: savedDurationsObj.durations_days[i],
                createDate: savedDurationsObj.durations_create_date[i],
                deviceId: savedDurationsObj.device_id[i],
                deviceName: savedDurationsObj.device_name[i],
                roomId: savedDurationsObj.room_id[i],
                roomName: savedDurationsObj.room_name[i],
                blockId: savedDurationsObj.block_id[i],
                blockName: savedDurationsObj.block_name[i],
            });
        }

        // parsing durations_days array coming From the API
        // ['Sun,Mon,Tue'] => ['Sun', 'Mon', 'Tue']
        for (var i = 0; i < durationsArray.length; i++) {
            var parseText = durationsArray[i].days[0];
            var days = [];
            var index = 0;
            var lastCommaFlag = 1;
            while (lastCommaFlag) {
                if (parseText.indexOf(",", index) == -1) {   //the last day in the string
                    lastCommaFlag = 0;
                    day = parseText.slice(index);
                    days.push(day);
                }
                else {
                    day = parseText.slice(index, parseText.indexOf(",", index));
                    days.push(day);
                    index = parseText.indexOf(",", index) + 1;
                }
            }   // end while
            durationsArray[i].days = days;
        }

        return durationsArray;

    }



    function showDurations(durationsArray) {
        /*
        Show durations to the right panel body whose id is "mainDivAfterSave".
        call it when the showRightPanelButton is clicked
        */

        for (var i = 0; i < durationsArray.length; i++) {
            // create new row that represents a duration.
            var newRow = document.createElement('tr');
            newRow.id = 'row#' + i; // the id of the row with the corresponding duration index

            // add the newRow to the right panel table
            document.getElementById('rightPanelTable').appendChild(newRow);

            // create new columns.
            var new1stCol = document.createElement('td');
            var new2ndCol = document.createElement('td');
            var new3rdCol = document.createElement('td');

            // show values on the new columns
            new1stCol.innerText = durationsArray[i].deviceName;
            // ignore date part of start and end time
            new2ndCol.innerText = durationsArray[i].startTime.slice(11) + "-" + durationsArray[i].endTime.slice(11);
            new3rdCol.innerText = durationsArray[i].repetition;

            // add the new columns to the newRow 
            document.getElementById(newRow.id).appendChild(new1stCol);
            document.getElementById(newRow.id).appendChild(new2ndCol);
            document.getElementById(newRow.id).appendChild(new3rdCol);
        }
    }


    function getBlocks(blocksText) {
        /*
        get Id and Name of each block belongs to the user by parsing blocksText.
        Input:-
        blocksText: the text to parse.
        Return:-
        blocksArray: array of Jsons , each element contains the id and the name of a block,
        [{id: ---, name: ---},]
        
        blocksText format:-
        { blocks_ids : [ “id0”, “id1”, “id2”, …] , 
        blocks_names : [ “name0”, “name1”, “name2”, …]}
        */
        while(blocksText.indexOf("'") != -1){
                    blocksText = blocksText.replace("'", '"');
            }
        var blocksArrayObj = JSON.parse(blocksText);
        var blocksArray = [];
        for (var i = 0; i < blocksArrayObj.blocks_ids.length; i++){
            blocksArray.push({id: parseInt(blocksArrayObj.blocks_ids[i]), name: blocksArrayObj.blocks_names[i]});
        }
        
        return blocksArray;

    }

    function getRooms(roomsText) {
        /*
        get Id and Name of each room belongs to the selected block by parsing roomsText.
        Input:-
        roomsText: the text to parse.
        Return:-
        roomsArray: array of Jsons , each element contains the id and the name of a room,
        [{id: ---, name: ---},]
        
        roomsText format:-
        {"rooms_ids":[“id0”, “id1”, “id2”, …],
        "rooms_names":[ “name0”, “name1”, “name2”, …]}
        */
        
        while(roomsText.indexOf("'") != -1){
                    roomsText = roomsText.replace("'", '"');
            }
        var roomsArrayObj = JSON.parse(roomsText);
        var roomsArray = [];
        for (var i = 0; i < roomsArrayObj.rooms_ids.length; i++){
            roomsArray.push({id: parseInt(roomsArrayObj.rooms_ids[i]), name: roomsArrayObj.rooms_names[i]});
        }
        

        return roomsArray;

    }


    function getDevices(devicesText) {
        /*
        get Id and Name of each devvice belongs to the selected room by parsing devicesText.
        Input:-
        devicesText: the text to parse.
        Return:-
        deviceArray: array of Jsons , each element contains the id and the name of a device,
        [{id: ---, name: ---},]
        
        devicesText format:-
        {"devices_ids":[“id0”, “id1”, “id2”, …],
        "devices_names":[ “name0”, “name1”, “name2”, …]}
        */

        while(devicesText.indexOf("'") != -1){
                    devicesText = devicesText.replace("'", '"');
            }
            
        var devicesArrayObj = JSON.parse(devicesText);
        var devicesArray = [];
        for (var i = 0; i < devicesArrayObj.devices_ids.length; i++){
            devicesArray.push({id: parseInt(devicesArrayObj.devices_ids[i]), name: devicesArrayObj.devices_names[i]});
        }

        return devicesArray;

    }


    /************************ handle click events *********************/

    $("#showRightPanelButton").click(function() {
        // submit form sending true to showDurations input.
        // change input value
        $("#showDurations").val("true");
        // submit the form by a click event
        $("#form1 input").removeAttr("disabled");
        $("#submit1").click();

    });

    // click on a certain duration from the right panel table to show its values in the left form.
    $("tr").click(function() {
        // get the duration index from the id of the clicked row.
        var index = $(this).attr('id').slice(4);
        // enable all elements of the form.
        $("select").removeAttr("disabled");
        $("input").removeAttr("disabled");

        /* show the values in the left form. */
        // select the Block.
        $('#blockSelect').find('option[value=' + durationsArray[index].blockId + ']').prop('selected', true);
        // remove options from room and device select tag
        $("#roomSelect option").remove();
        $("#deviceSelect option").remove();
        // create option with the value => id and text => name for room and device select
        $("#roomSelect").append($('<option>', { value: durationsArray[index].roomId, text: durationsArray[index].roomName }));
        $("#deviceSelect").append($('<option>', { value: durationsArray[index].deviceId, text: durationsArray[index].deviceName }));
        // select the created room and device option.
        $('#roomSelect').find('option[value=' + durationsArray[index].roomId + ']').prop('selected', true);
        $('#deviceSelect').find('option[value=' + durationsArray[index].deviceId + ']').prop('selected', true);
        // select the days, uncheck all fields then check the desired ones
        $('#daysSelect input').prop('checked', false);
        for (var i = 0; i < durationsArray[index].days.length; i++) {
            $('#daysSelect').find('input[value=' + durationsArray[index].days[i] + ']').prop('checked', true);
        }
        // select repetition option of the clicked Duration
        $('#repetitionSelect').find('option[value=' + durationsArray[index].repetition + ']').prop('selected', true);
        // set the start and end time of the clicked Duration
        $("#startTimeInput").val(durationsArray[index].startTime);
        $("#endTimeInput").val(durationsArray[index].endTime);

    });

    /************** handle change in bolck, room, device select tags ***************/

    $("#blockSelect").change(function() {

        // check if the first(empty) option is selected
        if ($('#blockSelect').val() == "") {
            // Disable all fields except select Block.
            $("select").attr("disabled", "disabled");
            $("input").attr("disabled", "disabled");
            $("#blockSelect").removeAttr("disabled");
            return
        }
        else {
            blockId = $('#blockSelect').val();
            // submit form, sending blockId
            // change input value
            $("#showDurations").val("false");
            $("#blockId2").val(blockId);
            // submit the form by a click event
            $("#form1 input").removeAttr("disabled");
            $("#submit1").click();
        }
    });

    $("#roomSelect").change(function() {
        // check if the first(empty) option is selected
        if ($('#roomSelect').val() == "") {
            // Disable all fields except select Block and room.
            $("select").attr("disabled", "disabled");
            $("input").attr("disabled", "disabled");
            $("#blockSelect").removeAttr("disabled");
            $("#roomSelect").removeAttr("disabled");
            return
        }
        else {
            roomId = $('#roomSelect').val();
            // submit form, sending blockId, roomId
            // change input value
            $("#showDurations").val("false");
            $("#blockId2").val(blockId);
            $("#roomId2").val(roomId);
            // submit the form by a click event
            $("#form1 input").removeAttr("disabled");
            $("#submit1").click();

        }
    });

    $("#deviceSelect").change(function() {
        // check if the first(empty) option is selected
        if ($('#deviceSelect').val() == "") {
            // Disable all fields except select Block, room and device.
            $("select").attr("disabled", "disabled");
            $("input").attr("disabled", "disabled");
            $("#blockSelect").removeAttr("disabled");
            $("#roomSelect").removeAttr("disabled");
            $("#deviceSelect").removeAttr("disabled");
            return
        }
        else {
            deviceId = $('#deviceSelect').val();
            // submit form, sending blockId, roomId
            // change input value
            $("#showDurations").val("false");
            $("#blockId2").val(blockId);
            $("#roomId2").val(roomId);
            $("#deviceId2").val(deviceId);
            // submit the form by a click event
            $("#form1 input").removeAttr("disabled");
            $("#submit1").click();

        }
    });

});
    </script>

    <!-- OTHER SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
</body>

</html>