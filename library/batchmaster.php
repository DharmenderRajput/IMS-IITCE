<?php

    #creating new batch
    function createbatch($data){

        include ("../library/database/config.php");

        $name = $data['batchname'];
        $sdate = $data['sdate'];
        $edate = $data['edate'];
        $course = $data['course'];
        $faculty = $data['faculty'];

        // getting institution value to attach with the record   
        $inst_name = $_SESSION['institution'];

        $sql = "INSERT INTO $batchmaster (name, sdate, edate, course, faculty, institution) VALUES ('$name', '$sdate', '$edate', $course, $faculty, '$inst_name')";
        $query = mysqli_query($conn, $sql);
        
        if($query){
            return true;
        }else{
            echo mysqli_error($conn);
            return false;
        }

    }

    function fetchbatch(){

        include ("../library/database/config.php");

        // getting institution value to attach with the record   
        $inst_name = $_SESSION['institution'];
        
        $sql = "SELECT * FROM $batchmaster WHERE institution = '$inst_name'";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){

                    $sdate = $row["sdate"];
                    $sdate = date("d-m-Y", strtotime($sdate));

                    $edate = $row["edate"];
                    $edate = date("d-m-Y", strtotime($edate));

                    // fetching course name
                    $sql1 = "SELECT * FROM $courses WHERE id = ".$row["course"]."";
                    $query1 = mysqli_query($conn, $sql1);
                    if ($query1) {
                        $res = mysqli_fetch_assoc($query1);
                        $course = $res['crs_aname'];
                    }
                    // fetching faculty name
                    $sql2 = "SELECT * FROM $staffmaster WHERE id = ".$row["faculty"]."";
                    $query2 = mysqli_query($conn, $sql2);
                    if ($query2) {
                        $res = mysqli_fetch_assoc($query2);
                        $faculty = $res['name'];
                    }

                    echo '
                        <tr>
                            <td>'.$row["name"].'</td>
                            <td>'.$sdate.' - '.$edate.'</td>
                            <td>'.$course.'</td>
                            <td>'.$faculty.'</td>
                        </tr>
                    ';
                }
            }else{
                echo "
                <tr>
                    <th colspan='4'>No Data Found</th>
                </tr>
            "; 
            }
        }else{
            echo "
                <tr>
                    <th>Error In Fetching Data</th>
                </tr>
            ";
        }

    }

?>