$(document).ready(function(){
    
    
        //$('[data-toggle="tooltip"]').tooltip();
    
    var level = 0;  // indicate in which level the user is (block=0, room=1, device=2)
    // TODO , get user Id from database.
    var userId = 0;
    
    var blockId, roomId, deviceId = 0;  // to be used when clicking on back button.
    
    // hide back button when level = 0
    $("#moveBackButton").css("visibility", "hidden");
    
    // set canvas and its properties
    var canvas = document.getElementById('mapping_canvas'),
    canvasLeft = $("#mapping_canvas").offset().left,
    canvasTop = $("#mapping_canvas").offset().top,
    contentTop = $("#content").offset().top,
    ctx = canvas.getContext('2d');
    // set the canvas size
    var contentHeight = $( "#content" ).height();
    var heightOf10Names = $( "#content" ).height()-( canvasTop-contentTop);
    canvas.width = $( "#content" ).width();
    canvas.height = heightOf10Names;
    
    // Determine the center of the canvas
    var canvasWidth = $( "#mapping_canvas" ).width();
    var canvasHeight = $( "#mapping_canvas" ).height();
    var center = { x : canvasWidth/2, y : canvasHeight/2};
    
    function toRadians(angle) {
        /* converts angle from degrees to radians */
        return angle * (Math.PI / 180);
    }
    
    function setCirclesPosition(circlesNumber){
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
        for (var i = 0; i <= Math.floor(circlesNumber/10); i++){
            mainCirclesPosition.push( { x: center.x, y: center.y+i*heightOf10Names, r: 75} );
        }
        
        // calculate x,y coordinate of each circle
        var length, theta, x, y, dx, dy = 0
        for (var i = 0; i < circlesNumber; i++){
            // distance between main circle and this circle
            if( i%2 )
                length = 220;
            else
                length = 170;
            // angle of line between main circle and this circle
            theta =  toRadians( (i%10)*(360/10) ) ;
            
            // x,y coordinate of this circle
            dx = length*Math.cos(theta);
            dy = length*Math.sin(theta);
            x = center.x + dx;
            y = center.y + dy;
            
            // add this circle to the array of circles
            smallCirclesPosition.push( {x: x, y: y+Math.floor(i/10)*heightOf10Names, r: 50} );
        }
        
        return { mainCircles: mainCirclesPosition, smallCircles: smallCirclesPosition };
    }

    function drawCircles(circlesPosition){
        /* draw the desired number of circles and the main circle */
        
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
    
    function drawLines(circlesPosition){
        /*
        draw lines between the main circles and small circles
        connected to them and lines between the main circles.
        */
        
        //draw lines between the main circles and small circles connected to them.
        circlesPosition.smallCircles.forEach(function(circle, index) {
            ctx.beginPath();
            ctx.moveTo(circlesPosition.mainCircles[Math.floor(index/10)].x, circlesPosition.mainCircles[Math.floor(index/10)].y); // from the main circle
            ctx.lineTo(circle.x, circle.y);
            ctx.stroke();
        });
        // draw lines between the main circles.
        for (var i = 0; i < circlesPosition.mainCircles.length-1; i++) {
            ctx.beginPath();
            ctx.moveTo(circlesPosition.mainCircles[i].x, circlesPosition.mainCircles[i].y); // from the main circle
            ctx.lineTo(circlesPosition.mainCircles[i+1].x, circlesPosition.mainCircles[i+1].y);
            ctx.stroke();
        }
    }
    
    
    function nameCircles(namesArray, clickedCircleName, circlesPosition){
        /*
        show the name of each (room or device) on a circle.
        Input:-
        namesArray : array of Strings, represents the name of each (room or device)
        circlesPosition : array of Jsons, with the position and radius of each circle
        */
        var text = "";  // the text to be written on each circle.
        ctx.font = "16px Arial";
        ctx.fillStyle = 'black';
        // draw main circles' names.
        circlesPosition.mainCircles.forEach(function(circle, index) {
            //if name is too long, take the first 6 letters and add "..."
                if(clickedCircleName.name.length > 6)
                    text = clickedCircleName.name.slice(0, 6) + "...";
                else
                    text = clickedCircleName.name;
                // draw Circle's name at the center of the circle.
                var textWidth = ctx.measureText(text).width;
                ctx.fillText(text, circle.x-textWidth/2 ,circle.y);
        });
        // draw small circles' names.
        circlesPosition.smallCircles.forEach(function(circle, index) {
            //if name is too long, take the first 6 letters and add ...
                if(namesArray[index].name.length > 6)
                    text = namesArray[index].name.slice(0, 6) + "...";
                else
                    text = namesArray[index].name;
                // draw Circle's name at the center of the circle.
                var textWidth = ctx.measureText(text).width;
                ctx.fillText(text, circle.x-textWidth/2 ,circle.y);
        });
        
        
    }
    

    function getNamesArray(level, clickedCircleName){
        /*
        get names inside the desired place.
        Input:-
        level : the level in which the user is (block=0, room=1, device=2)
        clickedCircleName : name of the clicked circle.
        Return:-
        namesArray : array of Jsons, each Json Object has the name and id
        of each (block, room or device) that belongs to the clickedCircleName
        { id: "id", name: "name"}.
        */
        
        // TODO : get IDs and names that belong to the clicked circle.
        
        if (level == 0){
        // block level, get block names of the current user.    
            
        }
        else if (level == 1){
        // room level, get room names of the current block(clickedCircleName).    
            
        }
        else if (level == 2){
        // device level, get device names of the current room(clickedCircleName).        
            
        }
        
        return namesArray;
    }

    function drawCanvas(level, clickedCircleName){
        /*
        draw the canvas ( Lines, Circles, Names ) of
        (blocks, rooms or devices) that belongs to the clickedCircleName
        Input:-
        level : the level in which the user is (block=0, room=1, device=2)
        clickedCircleName : name of the clicked circle.
        */
        
        // get the array of names.
        // TODO : uncomment next line after implementing getNamesArray function.
        //namesArray = getNamesArray(level, clickedCircleName);
        
        // TODO : comment the next line after implementing getNamesArray function.
        namesArray = [
            {id: 1, name:"a"},
            {id:2, name:"ab"},
            {id:3, name:"abcdef"},
            {id:4, name:"abcdefghijklmnopqrstuvwxyz"},
            {id:5, name:"a"},
            {id:6, name:"ab"},
            {id:7, name:"abcdef"},
            {id:8, name:"abcdefghijklmnop"},
            {id:9, name:"a"},
            {id:10, name:"ab"},
            {id:11, name:"abcdef"},
            {id:12, name:"abcdefghijklmnop"},
        ];
    
        // set the position of the circles.
        circlesPosition = setCirclesPosition(namesArray.length);
        // set the height of the canvas (increase height for each 10 names) and modify content height
        canvas.height = (Math.floor(namesArray.length/10)+1)*heightOf10Names;
        $("#content").height( $( "#mapping_canvas" ).height() + 100 );
        // draw the canvas following this precedence ( Lines => Circles => Names )
        drawLines(circlesPosition);
        drawCircles(circlesPosition);
        nameCircles(namesArray, clickedCircleName, circlesPosition);
        
        
        
    }
    
    function createDeviceInfoDiv(){
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
        $("#showDeviceInfo").append("<form method='GET' action='power-schedule1.html'><input id='updateScheduleButton' type='submit' name='device_id' value='Update Schedule'></form>");
        $("#updateScheduleButton").css("background-color", "rgb(203, 203, 203)");
        $("#updateScheduleButton").css("position", "absolute");
        $("#updateScheduleButton").css("z-index", "1");
        $("#updateScheduleButton").css("left", "120px");
        $("#updateScheduleButton").css("bottom", "20px");
        $("#updateScheduleButton").css("height", "40px");
        // hide Device Info Div
        $("#showDeviceInfo").hide();
    }
    
    function getAndShowDeviceInfo(clickedCircleName){
        /*
        get the device's Information from database, and show it
        at the bottom left corner of screen.
        Input:-
        clickedCircleName : id and name of the device.
        */
        
        /*
        TODO :  get device's Information from database. where:-
        OperatingTime = device operating time,
        Devicestate = device state
        */
        
        var Devicestate = "ON";
        var OperatingTime = "02:30 hours";
        
        // show device's Information at the bottom left corner of screen.
        // device name paragraph
        $("#deviceName").text("Device name: " + clickedCircleName.name);
        // device operating time paragraph
        $("#deviceOperatingTime").text("Operating Time: " + OperatingTime);
        // change device state button
        if (Devicestate == "ON")
            var switchStateButtonText = "Switch OFF" ;
        else
            var switchStateButtonText = "Switch ON";
        $("#changeStateButton").text(switchStateButtonText);
        /******************** changeStateButton **************/
        // TODO : change the State of the clicked device.
        $("#changeStateButton").click(function(){
            
        });
        /******************** Update Power Schedule button**************/
        // update schedule button, on click send device_id to power schedule page
        // TODO : get the schedule of the clicked device and show it in power schedule page
        $("#updateScheduleButton").click(function(){
            $("#updateScheduleButton").val(clickedCircleName.id);
       });    
        
        
        // show the hidden div
        $("#showDeviceInfo").show();

        
    }

    // test setCirclesPosition function
    /*
    var canvasWidth = $( "#mapping_canvas" ).width();
    var canvasHeight = $( "#mapping_canvas" ).height();
    var center = { x : canvasWidth/2, y : canvasHeight/2};

    alert("xc= " + center.x + ";yc= " + center.y);
    circlesarr = setCirclesPosition(6);
    for (var h = 0; h < circlesarr.length; h++){
        alert( "x= " + circlesarr[h].x + "; y= " + circlesarr[h].y + "; r= " + circlesarr[h].r);
    }
    */
    
    // test drawLines, drawCircles, nameCircles functions
    /*
    var namesArray = ["a","ab","abcdef","abcdefghijklmnop","a","ab","abcdef","abcdefghijklmnop","a","ab","abcdef","abcdefghijklmnop"];
    var circlesPosition = setCirclesPosition(namesArray.length);
    canvas.height = (Math.floor(namesArray.length/10)+1)*( contentHeight-( canvasTop-contentTop) );
    $("#content").height( $( "#mapping_canvas" ).height() + 100 );
    drawLines(circlesPosition);
    drawCircles(circlesPosition);
    nameCircles(namesArray, "clickedCircleName", circlesPosition);
    */
    
    /*
    var createCanvas2 = "<canvas id='mapping_canvas2'></canvas>";
    $("#content").append(createCanvas2);
    var canvas2 = document.getElementById('mapping_canvas2'),
    canvas2Left = $("#mapping_canvas2").offset().left,
    canvas2Top = $("#mapping_canvas2").offset().top,
    contentTop = $("#content").offset().top,
    ctx2 = canvas2.getContext('2d');
    // set the canvas size
    canvas2.width = $( "#content" ).width();
    canvas2.height = $( "#content" ).height()-( canvasTop-contentTop);
    var createCanvas3 = "<canvas id='mapping_canvas3'></canvas>";
    $("#content").append(createCanvas3);
    var canvas3 = document.getElementById('mapping_canvas3'),
    canvas3Left = $("#mapping_canvas3").offset().left,
    canvas3Top = $("#mapping_canvas3").offset().top,
    contentTop = $("#content").offset().top,
    ctx3 = canvas3.getContext('2d');
    // set the canvas size
    canvas3.width = $( "#content" ).width();
    canvas3.height = $( "#content" ).height()-( canvasTop-contentTop);
    circlesPosition.forEach(function(circle) {
            ctx2.beginPath();
            ctx2.arc(circle.x, circle.y, circle.r, 0, 2 * Math.PI);
            ctx2.fillStyle = 'green';
            ctx2.fill();
        });
    circlesPosition.forEach(function(circle) {
            ctx3.beginPath();
            ctx3.arc(circle.x, circle.y, circle.r, 0, 2 * Math.PI);
            ctx3.fillStyle = 'green';
            ctx3.fill();
        });
    $("#content").height( $( "#mapping_canvas3" ).height() + $( "#mapping_canvas2" ).height() + $( "#mapping_canvas" ).height() + 100 );
    */
    
    var namesArray;
    var circlesPosition;
    drawCanvas(level, {id:1, name:"main"});
    createDeviceInfoDiv();
    
    
    /*********** Mouse Click Event Handling *************/ 
    
    /******************** back button**************/
    $("#moveBackButton").click(function(){
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
        if (level == 0)
             $("#moveBackButton").css("visibility", "hidden");
        ctx.clearRect(0, 0, canvas.width, canvas.height);   // clear the canvas
        // update position, show where exactly we are 
        var sliceTo = $("#devicesMappingText").text().lastIndexOf("=");
        $("#devicesMappingText").text( $("#devicesMappingText").text().slice(0, sliceTo) );
        // clear old values of circlesPosition to redraw again
        circlesPosition.mainCircles = []; 
        circlesPosition.smallCircles = [];  
        // redraw the canvas
        var sliceFrom =  $("#devicesMappingText").text().lastIndexOf(">")+1;
        var gotoName = "";
        if (level == 0)
            gotoName = "main";
        else
            gotoName = $("#devicesMappingText").text().slice(sliceFrom);
        var clickedCircleName = {id: currentId, name: gotoName};
        drawCanvas(level, clickedCircleName);        
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
            
            var distance = Math.sqrt( Math.pow(x-circle.x, 2) + Math.pow(y-circle.y, 2) );
            
            // if a small circle is pressed
            if ( distance < circle.r) {
                if (level == 0)
                    blockId = namesArray[index].id;
                if (level == 1)
                    roomId = namesArray[index].id;
                if (level == 2)
                    deviceId = namesArray[index].id;
                
                clickedCircleName = namesArray[index];   // name and id of the circle.
                // move to the next level
                if (level < 2){
                    // go to next level
                    level++;
                    $("#moveBackButton").css("visibility", "visible");
                    ctx.clearRect(0, 0, canvas.width, canvas.height);   // clear the canvas
                    // update position, show where exactly we are 
                    $("#devicesMappingText").text( $("#devicesMappingText").text() + "=>" + namesArray[index].name);
                    
                    // clear old values of circlesPosition to redraw again
                    circlesPosition.mainCircles = []; 
                    circlesPosition.smallCircles = [];  
                    // redraw the canvas  
                    drawCanvas(level, clickedCircleName);
                }
                else if (level == 2)   // device is clicked Get and Show device's information
                    getAndShowDeviceInfo(clickedCircleName);
                return false;   // break loop
            }
            else
                return true;    // continue looping
                
        });

    }, false);
    
    //////////////////////////////////////////  End  Mouse Click Event Handling
    
    /*********** Mouse Over Event Handling *************/ 
    
    /*********** Mouse Over Canvas *************/ 
    
    // show the whole name of the circle on which the mouse is.
    $("#mapping_canvas").mousemove(function(event){
        // get the position of the click (x,y) relative to the canvas.
        var x = event.pageX - canvasLeft,
        y = event.pageY - canvasTop;
        
        // show tooltip when the mouse is on a circle.
        //$('[data-toggle="tooltip"]').tooltip();
        // clear tooltip when the mouse is not on a circle.
        $("#mapping_canvas").attr('title', '');
        
        // loop over each circle determining which circle the mouse is over.
        circlesPosition.smallCircles.every(function(circle, index) {
            
            var distance = Math.sqrt( Math.pow(x-circle.x, 2) + Math.pow(y-circle.y, 2) );
            
            // if the mouse is on a small circle
            if ( distance < circle.r) {
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


