<?php
session_start();

if(!isset($_SESSION['user_name']))
{
    header("Location: login-form.php");
}

?>
<!doctype html>
<html>

<head>
    <title>Billing</title>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
</head>

<body>
    <div id="menu">
        <div id="menulist">
            <a href="index.php" title="Home Page">
                <img id="home" src="images\home.png" class="pad" height="50" width="50" />
            </a>
            <a href="power-consumption.php" title="Power Consumption">
                <img src="images\powercons.png" class="pad" height="50" width="50" />
            </a>
            <a href="mapping.php">
                <img src="images\mapping.png" class="pad" height="50" width="50" />
            </a>
            <a href="power-schedule.php" title="Power Schedule">
                <img src="images\powersch.png" class="pad" height="50" width="50" />
            </a>

            <a href="billing.php" title="Billing">
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
    <main>
        <article id="content">
            <section class="title">
                <h1 class="Orange"> Billing </h1>
            </section>
            <section class="totalCost">
                <h3>Your bill has reached:  <span id="billCost"></span> $</h3>
                
                <br>
            </section>
<form id="frm" >
            <section class="selectFM">
                <h3>Select Month </h3>
                <select>
                    <option>Month, Year...</option>
                    <option>june</option>
                </select>
                <br>
                <br>
                <h3>Select Fee ($)</h3>
                <input id="fee" type="text" value="50">
                
            </section>
            <section class="additional">
                <button id="updateButton" class="btn btn-lg btn-primary" type="button" >Update current Schedule</button>
                <button id="saveButton" class="btn btn-lg btn-primary" type="submit" >Save</button>
                <button type="reset" id="clearAllButton"  class="btn btn-lg btn-primary" value="Clear All">Clear All</button>
                
                
            </section>
</form>
   
<p></p>
 


        </article>
    </main>
    <!-- SCRIPTS -->

    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    
    <!-- a SCRIPT for all pages -->
    <script type="text/javascript" src="javascript\allPages.js"></script>
</body>

</html>