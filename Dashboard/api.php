<?php 
 
 define('DB_HOST', 'localhost');
 define('DB_USER', 'root');
 define('DB_PASS', '');
 define('DB_NAME', 'loginhrms');
 
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }
 
 $stmt = $conn->prepare("SELECT name, hospital_name, status FROM details;");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($name, $hospital_name, $status);
 
 $details = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['name'] = $name; 
 $temp['hospital_name'] = $hospital_name; 
 $temp['status'] = $status; 
 array_push($details, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($details);

?>