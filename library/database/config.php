<?php
    #   this part of code is responsible for the connection with the DataBase

    #DB Servername
    $db_servername = "localhost";

    #DB Username
    $db_username = "ims_iitce";

    #DB Password
    $db_password = "ims_iitce";

    #DB Name
    $db_name = "ims_iitce";

    #   establishing connection with the database
    $conn = mysqli_connect($db_servername, $db_username, $db_password, $db_name);

    #check if connection is established or not
    if ($conn) {
        # connection established successfully
    } else {
        # error while establishing connection
    }
    
    #----------------------------------------------------------------------------#
    #   this list involves all the existing tables in the database
    $users = "users";
    $menu = "menu";
    $streams = "streams";
    $fee_head = "fee_head";
    $courses = "courses";
    $course_fee = "course_fee";
    $departments = "departments";
    $designation = "designation";
    $staffmaster = "staff_master";
    $batchmaster = "batch_master";
    $enquiry = "enquiry";
?>