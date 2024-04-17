<?php
    
    $user = $email = $pass = $phone = $city = '';

   $nameError = '';
   $emailError = '';
   $passError = '';
   $phonError = '';
   $cityError = '';

    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "identity";
 
    $conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
   
    $id = '';
   if($_SERVER['REQUEST_METHOD'] == 'GET'){
    //get the data
    if(!isset($_GET['update'])){
        header("location:data.php");
        exit;
    }

    $id = $_GET['update'];
    //show the data on edit page
    $sel ="SELECT * FROM final_state WHERE ID = '$id'";
    $run = $conn->query($sel);
    $row = $run->fetch_assoc();
    if(!$row){
        header("location:data.php");
        exit;
    }
    $usnam = $row['Username'];
    $eml = $row['Email'];
    $pword = $row['Pass_word'];
    $pnum  = $row['Phone_Number'];
    $city = $row['City'];


   }
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //to post the data
    $id = $_POST['id'];
    $usnam = $_POST['Username'];
    $eml = $_POST['Email'];
    $pword = $_POST['Password'];
    $pnum = $_POST['Phone_Number'];
    $city = $_POST['City'];

    //before update to validate
      function check(){

        global $usnam, $eml, $pword, $pnum, $city, $nameError, $emailError, $passError, $phonError, $cityError;

        if(empty($usnam)){
            $nameError = 'username is required';
          }
          else{
            $usnam = trim($usnam);
            $usnam = htmlspecialchars($usnam);
            if(!preg_match("/^[a-zA-Z0-9_-]{4,16}$/",$usnam)){
                $nameError = "username is minimum 4 characters";
            }
          }
          
          if(empty($eml)){
            $emailError = "Email is required";
          }
          else{
            $eml = trim($eml);
            $eml = htmlspecialchars($eml);
            if(!preg_match("^[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*$^",$eml)){
                $emailError = "Invalid Email";
            }
          }
          if(empty($pword)){
            $passError = "password is required";
          }
          else{
            $pword = trim($pword);
            $pword = stripslashes($pword);
            $pword = htmlspecialchars($pword);
            if(strlen($pword) < 8){
                $passError = "Your password must be contain at Least 8 characters!";
            }
          }
          if(empty($pnum)){
            $phonError = "Phone Number is Required";
          }
          else if(strlen($pnum) !== 10 ){
            $phonError = "Mobile Number must 10 characters";
          }
          if(empty($city)){
            $cityError = "Enter Your City";
          }

          if(empty($nameError) && empty($emailError) && empty($passError) && empty($phonError) && empty($cityError)){
            return true;
          }
          else{
            return false;
          }
      }

      if(check(true)){
        
        $upd = "UPDATE final_state 
               SET Username ='$usnam',Email ='$eml',Pass_word ='$pword',Phone_Number ='$pnum',City ='$city' 
               WHERE ID = '$id'";
        $result = $conn->query($upd);
        if(!$result){
          echo 'connection error : '.$conn->error;
          exit;

        }   
        else{
          echo '<script> alert("updated successfully") </script>';
          header("location:data.php");
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
        <form  method='post'>
            <h4>Update the Data</h4>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="input-group">
                <label for="user">Username</label>
                <input type="text" name="Username" placeholder="Enter Your Username" value="<?php echo $usnam; ?>">
                <small><?php echo $nameError; ?></small>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="text" name="Email" placeholder="Enter Your Email" value="<?php echo $eml; ?>">
                <small><?php echo $emailError; ?></small>
            </div>
            <div class="input-group">
                <label for="pass">Password</label>
                <input type="password" name="Password" placeholder="Type Password" value="<?php echo $pword; ?>">
                <small><?php echo $passError; ?></small>
            </div>
            <div class="input-group">
                <label for="number">Phone Number</label>
                <input type="text" name="Phone_Number" placeholder="Enter Your Number" value="<?php echo $pnum; ?>">
                <small><?php echo $phonError; ?></small>
            </div>
            <div class="input-group">
                <label for="city">City</label>
                <input type="text" name="City" placeholder="Enter your City" value="<?php echo $city; ?>">
                <small><?php echo $cityError; ?></small> 
            </div>
            <div class="input-group">
                <input type="submit" name='submit' value='Update'>
            </div>
        </form>
    </div>
</body>
</html>