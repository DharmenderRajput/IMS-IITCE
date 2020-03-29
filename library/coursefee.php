<?php
    #below this point all functions are defined for AJAX Calls
    if (isset($_POST['function'])) {
        $fun = $_POST['function'];
        // echo "<script>alert('".$_POST['function']."');</script>";

        if ($fun == "feeheads") {
            # fetch all avilable feefeads for the selected course
            if (isset($_POST['course'])) {
                $course = $_POST['course'];

                #include DB Connection file
                include ("../library/database/config.php");

                $sql = "SELECT * FROM $fee_head";
                $query = mysqli_query($conn, $sql);
                if ($query) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        $feehead_id = $row['id'];
                        $feehead_name = $row['fee_head_name'];
                        $query2 = mysqli_query($conn, "SELECT fee_head FROM $course_fee WHERE fee_head = $feehead_id AND course = $course");
                        if($query2){
                            #check if fee head is already alloted
                            if(!mysqli_num_rows($query2) > 0){
                                #fee-head is available
                                echo '
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <input type="checkbox" value="'.$feehead_id.'" class="fee_head" aria-label="...">
                                        </span>
                                        <p class="form-control-static"> '.$feehead_name.'</p>
                                    </div>
                                ';
                            }
                        }
                    }
                    echo '
                    <br>
                    <button href="" class="btn btn-warning" type="button" onclick="addFeeHead('.$course.')" >ADD</button>
                    ';
                }
            }
        }

        if ($fun == "display") {
            # fetch all alloted feefeads for the selected course
            if (isset($_POST['course'])) {
                $course = $_POST['course'];

                #include DB Connection file
                include ("../library/database/config.php");

                $sql = "SELECT * FROM $course_fee WHERE course = $course";
                $query = mysqli_query($conn, $sql);
                if ($query) {
                    if (!mysqli_num_rows($query) > 0) {
                        # no data found
                        echo '
                            <tbody>
                                <tr>
                                    <th colspan="2">FEE-HEADS</th>
                                </tr>
                                <tr class="info">
                                    <th>Select</th>
                                    <th>Fee-Head</th>
                                </tr>
                                <tr>
                                    <td colspan="2">NO DATA FOUND</td>
                                </tr>
                            </tbody>
                        ';
                    }else{
                        // data found so display it
                        echo '
                            <tbody>
                                <tr>
                                    <th colspan="2">FEE-HEADS</th>
                                </tr>
                                <tr class="info">
                                    <th>Select</th>
                                    <th>Fee-Head</th>
                                </tr>
                        ';
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo '
                            <tr>
                                <th><input type="checkbox" class="" value="'.$row['id'].'"></th>
                                <th>'.$row['fee_head'].'</th>
                            </tr>
                            ';
                        }
                        echo '        
                            </tbody>
                        ';
                    }
                }
            }
        }

        if ($fun == "add") {
            # fetch all alloted feefeads for the selected course
            if (isset($_POST['course'])) {
                $course = $_POST['course'];

                #include DB Connection file
                include ("../library/database/config.php");

                // print_r($_POST['data']);
                $data = $_POST['data'];
                foreach($data as $feehead){
                    $sql = "INSERT INTO $course_fee(course, fee_head) VALUES ($course, $feehead)";
                    $query = mysqli_query($conn, $sql);
                    if ($query) {
                        echo "ok";
                    }
                }
            }
        }
    }
?>