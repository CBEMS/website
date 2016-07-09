<?php
session_start();

if(!isset($_SESSION['user_name']))
{
	header("Location: login-form.php");
}
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <script >
    
    </script>
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
            <div id="homepage">
                <div id="profilePic">
                    <img src="images\night-sky-hd-wallpaper-2.jpg" width="900" height="300" />
                </div>
                <div id="notification">
                    <p>Notification</p>
                    <br/>
                    <br/>
                    <div id="getNotification"></div>
                </div>
                <div id="enviromentinfo">
                    <div id="temp">
                        <span style="display: block !important; width: 180px; text-align: center; font-family: sans-serif; font-size: 12px;"><a href="http://www.wunderground.com/cgi-bin/findweather/getForecast?query=zmw:00000.1.62393&bannertypeclick=wu_travel_landmarks1" title="Asyut, Egypt Weather Forecast" target="_blank"><img id="im" src="http://weathersticker.wunderground.com/weathersticker/cgi-bin/banner/ban/wxBanner?bannertype=wu_travel_landmarks1_metric&airportcode=HEAT&ForcedCity=Asyut&ForcedState=Egypt&wmo=62393&language=EN" alt="Find more about Weather in Asyut, EG" width="160" /></a><br></span>

                    </div>
                    <div id="status">
                        <span id="getStatus" class="orange">75% </span>
                        <img id="dollar" src="images/dollarsign.png" height="50" width="50" />
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <p class="orange">out of bill is reached!</p>
                        <a class="blue" href="">Update Power schedule</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- SCRIPTS -->
    
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- a SCRIPT for all pages -->
    <script type="text/javascript" src="javascript\allPages.js"></script>
    
    
</body>

</html>
