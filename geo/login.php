<?php
require "DataBase.php";
$db = new DataBase();
$us = $_POST['username'];
$pas = $_POST['password'];
if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($db->dbConnect()) {
        if ($db->logIn("users", $_POST['username'], $_POST['password'])) {
            echo "Login Success";
        } else echo "Username or Password is Incorrect";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>