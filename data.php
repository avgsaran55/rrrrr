<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
    <style>
        *{
            padding: 0;
            margin:0;
            font-family: 'poppin',sans-serif;
            box-sizing: border-box;
        }
        .container{
            width:100%;
            margin:20px;
            max-width: 1200px;
            min-width: 710px;
        }
        h3{
            color:dodgerblue;
            padding: 10px 0;
        }
        table{
            width:100%;
            border-collapse:collapse;
        }
        thead tr th{
            text-align:left;
            border: 2px solid black;
        }tbody tr td{
            border: 2px solid #ddd;
        }
        a{
            float:right;
            padding: 10px;
            color:#ddd;
            background-color:green;
            text-decoration: none;
        }
        .blue{
            background-color: blue;
        }
        .red{
            background-color: red;
        }
        button{
            border:none;
            margin-top: 5px;
        }
        @media only screen and (max-width:800px){
            .container{
            margin:5px;
            width:100%;

            }
            h3{
              font-size: 15px;
            }
           thead tr th{
            text-align:center;
              font-size: 10px;
              border-bottom: 1px solid black;
           }
           tbody tr td{
               font-size: 10px;
               border-bottom: 1px solid #ddd;
           }
           a{
            padding: 5px;
            font-size:10px;
        }
        button{
            border:none;
            margin-top: 3px;
        }
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Your information</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Phone Number</th>
                    <th>City</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $host = "localhost";
                $dbusername = "root";
                $dbpassword = "";
                $dbname = "identity";
             
                $conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
                $sel = "SELECT*FROM final_state";
                $sql = mysqli_query($conn, $sel);
                
                //$id = 1;
                while($run=mysqli_fetch_array($sql)){

                    $id = $run['ID'];
                    $usnam = $run['Username'];
                    $eml = $run['Email'];
                    $pword = $run['Pass_word'];
                    $pnum  = $run['Phone_Number'];
                    $city = $run['City'];
            
                
                ?>

                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $usnam; ?></td>
                    <td><?php echo $eml; ?></td>
                    <td><?php echo $pword; ?></td>
                    <td><?php echo $pnum; ?></td>
                    <td><?php echo $city; ?></td>
                        <td>
                        <button><a class="blue" href="update.php?update=<?php echo $id; ?>">Update</a></button>
                        <button><a class="red" href="delete.php?delete=<?php echo $id; ?>">Delete</a></button>
                        </td>
                </tr>
                <?php } ?>
            </tbody>
             
        </table>
        <br>
        <br>
        <h4><a  href="index.php">LOGIN NEW</a></h4>
    </div>
</body>
</html>