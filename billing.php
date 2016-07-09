<?php
session_start();

if(!isset($_SESSION['user_name']))
{
    header("Location: login-form.php");
}

    $user_id = $_SESSION['user_id'] ;
    $url = "localhost/api/bills/get_current_usage.php";    
    $url = $url."?user_id=".$user_id;
        
    // create curl resource 
    $ch = curl_init(); 
    // set url 
    curl_setopt($ch, CURLOPT_URL, $url); 
    //return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    // $output contains the output string 
    $out = curl_exec($ch); 
    // close curl resource to free up system resources 
    curl_close($ch);


    if (isset($_GET['submit'])) 
    {

        if ($_GET['submit']=='Save')
        {
           $month = $_GET['month'];
           $new_limit= $_GET['fee'];
           
            $url = "localhost/api/bills/set_limit.php";    
            $url = $url."?user_id=".$user_id."&month=".$month."&new_limit=".$new_limit;
            
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
            $out = json_decode($out,true);
            $totalPowerConsumption=$out['user_total_consumption'];
            
        }
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
            <form id="frm" method="GET" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']); ?>">
            <section class="selectFM">
                <h3>Select Month </h3>
                <select name= "month"  required>
                    <option></option>
                    <option value="January" >January</option>
                    <option value="February" >February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
                <br>
                <h3>Select Fee ($)</h3>
                <input id="fee" name="fee" type="text" required >
                <input id="saveButton" class="btn btn-lg btn-primary" type="submit" name="submit" value="Save" >   
            
        </form>
   
<p></p>
 


        </article>
    </main>
    <!-- SCRIPTS -->

    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    
    <!-- a SCRIPT for all pages -->
    <script type="text/javascript" src="javascript\allPages.js"></script>
     <script type="text/javascript">
        var totalPowerConsumption = <?php echo $totalPowerConsumption ; ?> ;
        var BillReach=function(totalPowerConsumption,time){
                var billCost=5; //the bill cost as Kw/h        
                var energy =  totalPowerConsumption  /time;    
                var billReach=parseInt(energy/billCost,10);          
                $("#billCost").prepend(billReach);
                       
               var consPrecentage=parseInt(100-(((50-billReach)/50)*100),10);
                $("#cons").prepend(consPrecentage);    
                }
            BillReach(55555,12);
     </script>
</body>

</html>
