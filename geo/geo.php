<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['address']) && isset($_POST['locality']) && isset($_POST['country'])  && isset($_POST['ImageName']) && isset($_POST['EmpDate'])) {
    if ($db->dbConnect()) {
        if ($db->geo("mark", $_POST['latitude'], $_POST['longitude'], $_POST['address'], $_POST['locality'], $_POST['country'], $_POST['ImageName'], $_POST['EmpDate'])) {
            echo "Attendance Marked";
        } else echo "Failed to Mark the Attendance";	 
    } else echo "Error: Database connection";
} else echo "All fields are required";

?>
