<?php

   $user = $email = $pass = $phone = $city = '';

   $nameError = '';
   $emailError = '';
   $passError = '';
   $phonError = '';
   $cityError = '';

   $errorMessg = '';

   if($_SERVER["REQUEST_METHOD"] == "POST"){
    
      $user = $_POST['Username'];
     
      $email = $_POST['Email'];
      $pass = $_POST['Password'];
      $phone = $_POST['Phone_Number'];
      $city = $_POST['City'];
      
       
      if(empty($user)){
            
        $nameError = "username is required";
      }
      else{
        $user = trim($user);
        $user = htmlspecialchars($user);
        if(!preg_match("/^[a-zA-Z0-9_-]{4,16}$/",$user)){
            $nameError = "username is minimum 4 characters";
        }
        
      }
      if(empty($email)){
        $emailError = "Email is required";
      }
      else{
        $email = trim($email);
        $email = htmlspecialchars($email);
        if(!preg_match("^[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*$^",$email)){
            $emailError = "Invalid Email";
        }
      }
      if(empty($pass)){
        $passError = "password is required";
      }
      else{
        $pass = trim($pass);
        $pass = stripslashes($pass);
        $pass = htmlspecialchars($pass);
        if(strlen($pass) < 8){
            $passError = "Your password must be contain at Least 8 characters!";
        }
      }
      if(empty($phone)){
        $phonError = "Phone Number is Required";
      }
      else if(strlen($phone) < 10 || strlen($phone) > 10){
        $phonError = "Mobile Number must 10 characters";
      }
      if(empty($city)){
        $cityError = "Enter Your City";
      }

              
      if(!empty($user) && !empty($email) && !empty($pass) && !empty($phone) && !empty($city)){
        
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "identity";

        $conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

        $insert = "INSERT INTO final_state(Username, Email, Pass_word, Phone_Number, City)
                 VALUES ('$user','$email','$pass','$phone','$city') ";
        $row = mysqli_query($conn, $insert);        
        if(!$row){
            $errorMessg = 'connection error : ' .$conn->error;
            exit;
        } 
        else{
            $user = '';
            $email = '';
            $pass = '';
            $phone = '';
            $city = '';

            echo '<script> alert("Inerted Successfully") </script>';
            header("location: data.php");
            exit;
        }          
      } 

     
             
   }
  
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>
    <style>
        *{
            padding: 0;
            margin: 0;
            font-family: 'poppin',sans-serif;
            box-sizing: border-box;
        }
        .container{
            margin:20px;
            width: 100%;
            min-width:200px;
            max-width: 250px;
            position: relative;
        }
        h4{
            padding: 15px;
            color:tomato;
            text-align: center;
        }
        form{
            width: 200px;
            position: absolute;
            left: 25px;
        }
        .input-group{
            display: flex;
            flex-direction: column;
            padding: 5px 0;
        }
        input{
            height: 25px;
            padding: 5px;
        }
        .input-group [type="submit"]{
            width: 100px;
            background-color: purple;
            color:white;
            border: 0;
            outline: 0;
            border-radius: 3px;
            position: absolute;
            left:50px;
        }
        small{
            color:red;
        }

        @media only screen and (max-width:800px){
            .container{
               margin:10px 5px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <h4>Login</h4>
            <div class="input-group">
                <small><?php echo $errorMessg; ?></small>
            </div>
            <div class="input-group">
                <label for="user">Username</label>
                <input type="text" name="Username" placeholder="Enter Your Username" value="<?php echo $user; ?>" >
                <small><?php echo $nameError; ?></small>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="text" name="Email" placeholder="Enter Your Email" value="<?php echo $email; ?>">
                <small><?php echo $emailError; ?></small>
            </div>
            <div class="input-group">
                <label for="pass">Password</label>
                <input type="password" name="Password" placeholder="Type Password" value="<?php echo $pass; ?>">
                <small><?php echo $passError; ?></small>
            </div>
            <div class="input-group">
                <label for="number">Phone Number</label>
                <input type="text" name="Phone_Number" placeholder="Enter Your Number" value="<?php echo $phone; ?>">
                <small><?php echo $phonError; ?></small>
            </div>
            <div class="input-group">
                <label for="city">City</label>
                <input type="text" name="City" placeholder="Enter your City" value="<?php echo $city; ?>">
                <small><?php echo $cityError; ?></small>
            </div>
            <div class="input-group">
                <input type="submit" name="submit" value='Register'>
            </div>
        </form>
    </div>
</body>
</html>