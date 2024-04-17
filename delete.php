<?php
    
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "identity";
             
    $conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

    $delete = $_GET['delete'];
    $del = "DELETE FROM final_state WHERE ID = '$delete'";
    $sql = $conn->query($del);
    if($sql){
        header("location: data.php");
    }
    else{
        echo 'something error :'.$conn->error;
    }
?>