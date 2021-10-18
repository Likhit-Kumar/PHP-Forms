<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['image_name'])) {
    if ($db->dbConnect()) {
        if ($db->status("mark", $_POST['image_name'])) {
            echo "Fetched Status";
        } else echo "Failed to Fetch Status";	 
    } else echo "Error: Database connection";
} else echo "All fields are required";

?>
