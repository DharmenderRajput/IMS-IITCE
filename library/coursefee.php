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
                        $query2 = mysqli_query($conn, "SELECT fee_head FROM $course_fee WHERE fee_head = $feehead_id");
                        if($query2){
                            #check if fee head is already alloted
                            if(!mysqli_num_rows($query2) > 0){
                                #fee-head is available
                                echo '
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <input type="checkbox" value="'.$feehead_id.'" name="fee_head[]" aria-label="...">
                                        </span>
                                        <p class="form-control-static"> '.$feehead_name.'</p>
                                    </div>
                                ';
                            }
                        }
                    }
                    echo '
                    <br>
                    <button class="btn btn-warning" type="submit" name="new">ADD</button>
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
                                    <th>Course</th>
                                    <th>Fee-Head</th>
                                </tr>
                                <tr>
                                    <td colspan="2">NO DATA FOUND</td>
                                </tr>
                            </tbody>
                        ';
                    }
                }
            }
        }
    }
?>