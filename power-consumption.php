<?php
session_start();

if(!isset($_SESSION['user_name']))
{
    header("Location: login-form.php");
}

?>
<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="css/styles.css">

    <script src="javascript/canvasjs.min.js"></script>
	<style type="text/css">
    table
    {
        position: relative;
        margin-left : 300;
        margin-top : 300;
    }
    </style>
	
	<title>Power Consumption</title>
</head>
<body>
    <div id="container">
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
		<div id="content">
       	<div class="title">
			   <h1 >Power Consumption</h1>
       	</div>
		<div id="PowerCons" style="width: 30%; height: 400px;display :inline;" >
			<div id="PowerConsDetail" >
				<h2><span id="cons"> </span> %</h2>
				<div id="more"><a href="billing.html">Update Bill Limits </a><p style="display:inline;">|</p><a href="power-schedule1.html"> Update Power Schedule</a></div>
			</div>
            <div>
<br><br><br><br> <table border="1">
                <tr><td>Total Consumption</td></tr>
                <tr><td>
<?php
$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, 'localhost/api/readings/get_user_total_consumption.php?user_id=5');
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);

$content = curl_exec($ch);
$content = json_decode($content, true);
echo $content['total_consumtion'];
?></td>
		</tr>
                </table>
            </div>
			</div>  
		<div id="chartContainer" style="height: 400px; width: 70%;"></div>
		
		</div>
		</div>
		<!-- SCRIPTS -->
		<script>
	//geting the total power consumption of each room 
            var input = []; // initialise an empty array
            var temp = '';
            do {                
                if (temp === "" || temp === null) {
                    break;
                } else {
                    input.push(temp);  // push the value of power consuption of each room 
                }
            } while (1)
        //calculate the sum of room's power consumption 
                var i,j,sum=0;
                for (i=0;i<input.length;i++){
                    sum+=input[i];
                }
                var totalpower;
                var y=[];
                for (j=0;j<input.length;j++){
                    y.push({
                            y: (input[i]/sum)*totalpower ,
                            indexLabel: "{roomName}: {y}%", 
                            sortable: true,
                            resizeable: true
                        });
                }
            
		</script>
		<!-- JQUERY SCRIPTS -->
		<script src="assets/js/jquery-1.10.2.js"></script>
		<!-- a SCRIPT for all pages -->
		<script type="text/javascript" src="javascript\allPages.js"></script>
		
</body>
</html>
