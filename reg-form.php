<?php
    // Start the session
    session_start();
    if(isset($_SESSION['user'])!="")
    {
        header("Location: login-form.php");
    }
    
    
    // define variables and set to empty values
    $nameErr  = $emailErr = $typeErr= $mobErr =$passErr=$regErr="";
    $name  = $email = $type= $mob = $pass="";
    ///////////////////////////////////
    if (isset($_POST['submit'])) 
    {   
        $name=   test($_POST['name']);
        $email=  test($_POST['email']);
        $type=   test($_POST['type']);
        
        $name = test_input($name);
        $email= test_input($email);
        $type = test_input($type);
        
        /////////////////// name test
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
        {
            $nameErr = "Only letters and white space allowed";
        }
        
        //////////////////////     mail
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $emailErr = "Invalid email format";
        }
        
        // email exist or not

        $url = "localhost/api/user/register/check_mail.php";    
        $url = $url."?email=".$email;
        
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
        

        
        if ( strlen($output) != 4 )
        {
            $emailErr .=" Sorry Email ID already taken";
        }

        ////////////////////////////     type
        // check if name only contains letters and whitespace
        

        $selected_choice = $type;
    
        
        /////////////////////      mob 
        if (empty($_POST["mob"])) 
        {
            $mob = "";
        } 
        else 
        {
            $mob = test_input($_POST["mob"]);
            if ( !ctype_digit ( $mob ))
            {
                $mobErr = "Invalid Number";
            }
        }
        ///////////////////////    pass
        
            $pass = test_input($_POST["pass"]);
            // check if name only contains letters and whitespace
            if( strlen($pass) < 8 ) 
            {
              $passErr .= "Password too short! ";
            }
            if( !preg_match("#[0-9]+#", $pass) ) 
            {
              $passErr .= "Password must include at least one number! ";
            }
            if( !preg_match("#[a-z]+#", $pass) ) 
            {
              $passErr .= "Password must include at least one letter! ";
            }            
            if( !preg_match("#[A-Z]+#", $pass) ) 
            {
                $passErr .= "Password must include at least one CAPS!";
            }
            else
                $pass=   md5($_POST['pass']);
        if (!$nameErr  && !$emailErr && !$mobErr && !$passErr && !$typeErr) 
        {

            $url = "localhost/api/user/register/import_user.php";    
            $con =array("user_name"=>$name, "email"=>$email, "password"=>$pass, "type"=>$type, "photo"=>"","phone_num"=>$mob);
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $con);

            $res = curl_exec($curl);
            curl_close($curl);
            
            if( strlen($res) != 6 )
            {
                $regErr ='Something Wrong, Please Try again later ';
            }
            else  
            {
                header("Location: login-form.php"); 
            }

        }

        
  }

function test_input($data) 
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
function test($value)
{
    $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
    $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

    return str_replace($search, $replace, $value);
}
?>

<!DOCTYPE html>
<html>



<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <!--STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="css/styles.css">


    <style>
        .error {color: #FF0000;}
    </style>

</head>

<body style="background-color:#C0C0C0">
    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
        <div id="signUpPanel" class="panel panel-primary">
            <div class="panel-heading">
                SINGUP
            </div>
            <div class="panel-body">
                <form method="post" >

                    <p><span class="error">  * required field.</span>
                    <span class="error">  <?php echo $regErr;?></span>
                    </p>

                    <div class="form-group">
                        <label>Name:</label>
                        <span class="error">  * <?php echo $nameErr;?></span>
                        <input class="form-control" name="name" value="<?php echo $name;?>" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <label>E-mail: </label>
                        <span class="error">  * <?php echo $emailErr;?></span>
                        <input class="form-control" name="email" value="<?php echo $email;?>" placeholder="Your E-mail" required>
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <span class="error">  * <?php echo $passErr;?></span>
                        <input class="form-control" type="password" name="pass" value="" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label>Phone:</label>
                        <span class="error">  * <?php echo $mobErr;?></span>
                        <input class="form-control" type="text" name="mob" value="<?php echo $mob;?>" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group">
                        <label>Type:</label>
                        <select name="type" class="form-control" required>
                            <option value=""></option>
                            <option value="Industrial"  <?php if($type == "Industrial"){ print "selected='selected'"; } ?> >Industrial</option>
                            <option value="Commercial"  <?php if($type == "Commercial"){ print "selected='selected'"; } ?> >Commercial</option>
                            <option value="Domestic"    <?php if($type == "Domestic"){ print "selected='selected'"; } ?> >Domestic</option>
                        </select>
                    </div>


                    <input id="signUpButton" class="btn btn-primary" type="submit" name="submit" value="Sign Up">

                </form>
            </div>
        </div>
    </div>
</body>

</html>
