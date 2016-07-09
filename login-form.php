<?php
    session_start();
	 if(isset($_SESSION['user_name'])!="")
    {
		  header("Location: index.php");
    }
    $loginErr1=$loginErr2="";
    
    if(isset($_POST['login']))
    {
		  $email = test_input($_POST['email']);
	      $pass = test_input($_POST['pass']);
		  $pass=md5($pass);
        
    		$data=array("email"=>$email,"password"=>$pass);
			$url = "http://196.205.93.181:22355/api/user/login/get_user.php";    

		  $curl = curl_init($url);
		  curl_setopt($curl, CURLOPT_HEADER, false);
		  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		  curl_setopt($curl, CURLOPT_POST, true);
		  curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

		  $json_response = curl_exec($curl);
		  curl_close($curl);

        $json_response = json_decode($json_response, true);
                
        if($json_response['status']=="wrong email"  )
		  {	
				$loginErr1="wrong email";
	     }  
        elseif ($json_response['status']=="wrong_pass")  
	     {
				$loginErr2="wrong pass";
	     }
    	  elseif ($json_response['status']=="true"  )
    	  {
				$_SESSION["user_id"] = $json_response['user_id'];
				$_SESSION["user_name"] = $json_response['user_name'];
				$_SESSION["photo"] = $json_response['photo'];
				header("Location: index.php");
		  }
}
function test_input($data) 
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>

    <!-- STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">

    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="css/styles.css">
    
</head>

<body style="background-color:#C0C0C0">
    <div class="container">
        <div class="row text-center " style="padding-top:100px;">
            <div class="col-md-12">
                <img alt="LOGO" src="images/logo.png" />
            </div>
        </div>
        <div class="row ">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

                <div class="panel-body">
                    <form method="post">
                        <hr />
                        <div class="form-group input-group">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" name="email" placeholder="Your Email" required />
                            <span class="error"> <?php echo $loginErr1 ;?></span>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                            <input type="password" class="form-control" name="pass" placeholder="Your Password" required />
                            <span class="error"><?php echo $loginErr2;?></span>
                        </div>

                        <button id="loginButton" type="submit" name="login" class="btn btn-info ">Sign In</button>
                        <hr /> Not register ? <a href="reg-form.php">Sign Up Here</a>
                    </form>
                </div>

            </div>


        </div>
    </div>
</body>

</html>
