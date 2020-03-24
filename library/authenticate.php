<?php
    include_once("./database/config.php");

    #   reciving and santising the post data from the login form
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    if ($username != null && $password != null) {
        # fields are not empty proceed

        $sql = "SELECT * FROM $users WHERE User_name = '$username' AND User_password ='".md5($password)."'";
        $query = mysqli_query($conn, $sql);
        
        #check if query is executed or not
        if($query){

            #check if any record is found or npt
            if($count = mysqli_num_rows($query) > 0){

                session_start();

                #record found setting cookie for further authentication
                // setcookie("user_name", $username);
                $_SESSION['user_name'] = $username;

                #fetching more data to set essential criterias
                $data = mysqli_fetch_assoc($query);
                $user_authority = $data['User_authority'];
                // setcookie("user_access", $user_authority);
                $_SESSION['user_access'] = $user_authority;

                #redirecting to the dashboard
                header("location:../views/dashboard.php");

            }else{
                #no record found 
                #redirecting back to login page
                header("location:../");
            }

        }
    } else {
        # fields are empty redirect back to login page
        header("location:../");
    }
    

?>