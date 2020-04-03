<?php
    
    #adding new employee
    function createstaff($data)
    {
        include ("../library/database/config.php");

        $name = $_POST['emp_name'];
        $dep = $_POST['dep_name'];
        $des = $_POST['des_name'];

        $sql = "INSERT INTO $staffmaster (name, dep, des) VALUES ('$name', $dep, $des)";
        $query = mysqli_query($conn, $sql);
        
        if($query){
            return true;
        }else{
            // echo mysqli_error($conn);
            return false;
        }
    }

    #fetching department list
    function fetch_dep ()
    {
        include ("../library/database/config.php");

        $sql = "SELECT * FROM $departments";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            # query executed successfully
            if(mysqli_num_rows($query) > 0){
                echo '
                    <option value="">Select Department</option>
                    <option value=""></option>
                ';
                while($row = mysqli_fetch_assoc($query)){
                    echo '
                        <option value="'.$row['id'].'">'.$row['name'].'</option>
                    ';
                }
            }else{
                echo '
                    <option>No Departments Found</option>
                ';
            }
            // return true;
        }else{
            return false;
        }
    }

    #fetching designation list
    function fetch_des ()
    {
        include ("../library/database/config.php");

        $sql = "SELECT * FROM $designation";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            # query executed successfully
            if(mysqli_num_rows($query) > 0){
                echo '
                    <option value="">Select Designation</option>
                    <option value=""></option>
                ';
                while($row = mysqli_fetch_assoc($query)){
                    echo '
                        <option value="'.$row['id'].'">'.$row['name'].'</option>
                    ';
                }
            }else{
                echo '
                    <option>No Departments Found</option>
                ';
            }
            // return true;
        }else{
            return false;
        }
    }

    function fetchstaff($code = 0){

        include ("../library/database/config.php");

        $sql = "SELECT * FROM $staffmaster";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {

                    $dep = $row['dep']; // department
                    $des = $row['des']; // designation
                    
                    $query_dep = mysqli_query($conn, "SELECT name FROM $departments WHERE id = $dep");
                    $query_des = mysqli_query($conn, "SELECT name FROM $designation WHERE id = $des");

                    if ($query_dep && $query_des) {
                        $res_dep = mysqli_fetch_assoc($query_dep);
                        $res_des = mysqli_fetch_assoc($query_des);

                        $dep = $res_dep['name'];
                        $des = $res_des['name'];
                    }
                    if ($code == 0) {
                        echo '
                            <tr>
                                <td>'.$row['name'].'</td>
                                <td>'.$dep.'</td>
                                <td>'.$des.'</td>
                                <td></td>
                            </tr>
                        ';
                    }else{
                        echo '
                            <option value="'.$row['id'].'">'.$row['name'].'</option>
                        ';
                    }
                    
                }
            }else{
                echo '
                    <tr>
                        <td colspan="4">No Data Found</td>
                    </tr>
                ';
            }
        }
    }

    // functions for all AJAX Calls
    if (isset($_POST['function'])) {

        $fun = $_POST['function'];

        #adding department
        if ($fun == "add_dep") {
            
            $dep_name = $_POST['name'];

            include ("../library/database/config.php");

            $sql = "INSERT INTO $departments (name) VALUES ('$dep_name')";
            $query = mysqli_query($conn, $sql);

            if ($query) {
                echo "Successfully!";
            }

        }

        #adding designation
        if ($fun == "add_des") {
            
            $des_name = $_POST['name'];

            include ("../library/database/config.php");

            $sql = "INSERT INTO $designation (name) VALUES ('$des_name')";
            $query = mysqli_query($conn, $sql);

            if ($query) {
                echo "Successfully!";
            }

        }

        if ($fun == "fetch_dep") {
            fetch_dep();
        }

        if ($fun == "fetch_des") {
            fetch_des();
        }


    }


?>