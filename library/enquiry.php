<?php
    function newenquiry()
    {

        include ("../library/database/config.php");
        include_once("../library/staffmaster.php");

        // getting institution value 
        $inst_name = $_SESSION['institution'];

        // generating enquirey number
        $sql = "SELECT COUNT(id) AS records FROM $enquiry WHERE institution = '$inst_name'";
        $query = mysqli_query($conn, $sql);

        $enq_num;   // pre declaring variable for further usage

        if ($query) {
            $row = mysqli_fetch_assoc($query);
            $num = ++$row['records'];
            $enq_num = "ENQ".strtoupper($inst_name)."-".$num;
        }else{
            echo "Error Occured! while executing the query";
        }


        $date = date("d-m-Y");

        #form design
        echo'
            <form class="form-inline" method="POST">
                <table class="table table-responsive table-bordered">
                    <tr>
                        <td>
                            <div class="form-group">
                                <label for="exampleInputName2">Enquiry Number</label>
                                <input type="text" class="form-control" id="exampleInputName2" name="enq_no" value="'.$enq_num.'" readonly>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="exampleInputEmail2">Enquiry Date</label>
                                <input class="form-control" id="exampleInputEmail2" name="enq_date" placeholder="DD/MM/YYY" type="text" value="'.$date.'" readonly/>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="exampleInputName2">Name*</label>
                                <input type="text" class="form-control" id="exampleInputName2" name="enq_name" placeholder="Jane Doe" required>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="exampleInputName2">Gender</label>
                                <select class="form-control" id="exampleInputName2" name="gender" required>
                                    <option>Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="exampleInputName2">Mother/Father/Guardian Name</label>
                                <input type="text" class="form-control" id="exampleInputName2" name="parent" placeholder="Jane Doe">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="exampleInputName2">Phone Number*</label>
                                <input type="tel" class="form-control" id="exampleInputName2" name="enq_pn" pattern="[0-9]{10}" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label for="exampleInputName2">Mobile Number</label>
                                <input type="tel" class="form-control" id="exampleInputName2" name="enq_mn" pattern="[0-9]{10}">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="exampleInputName2">Email</label>
                                <input type="email" class="form-control" id="exampleInputName2" name="email" placeholder="xyz@xz.com">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="exampleInputName2">Academic Qualification</label>
                                <select class="form-control" id="exampleInputName2" name="enq_qual" required>
                                    <option>Select</option>
                                    <option value="Class 10th">Class 10th</option>
                                    <option value="Class 12th">Class 12th</option>
                                    <option value="UG/PG">UG/PG</option>
                                </select>
                            </div>
                        </td>                     
                    </tr>
                    <tr>
                        <td colspan="6"><h4>Office Use Only</h4></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label for="exampleInputName2">Institution</label>
                                <input type="text" class="form-control" id="exampleInputName2" placeholder="xyz@xz.com" name="enq_inst" value="'.$inst_name.'" readonly>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="exampleInputName2">Comes Through</label>
                                <select class="form-control" id="exampleInputName2" name="source" required>
                                    <option>Select</option>
                                    <option value="Friends Refrence">Friends Refrence</option>
                                    <option value="Social Media">Social Media</option>
                                    <option value="Ads">Ads</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="exampleInputName2">Course Recommended</label>
                                <select class="form-control" id="exampleInputName2" name="recommended_crs" required>
                                    <option>Select</option>
            ';
                                    fetchcourses(1);
            echo '
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="exampleInputName2">Counselled By</label>
                                <select class="form-control" id="exampleInputName2" name="counselled_by" required>
                                    <option>Select</option>
            ';
                                    fetchstaff(1);
            echo '
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="exampleInputName2">Date For Next Appointment</label>
                                <input class="form-control" id="date" name="nxt_date" placeholder="DD/MM/YYY" type="text"/>
                            </div>
                        </td>
                    </tr>
                </table>
                
                <button type="submit" class="btn btn-default" name="new_enq">Generate Enquiry</button>
            </form> 
        ';
    }

    
    // fetches all the data in enquirey table to be displayed
    // pagination value must be passed to display relevant data   --   default is 1
    function fetchdata($pi = 1){
        include ("../library/database/config.php");

        $sql = "SELECT * FROM $fee_head ";
        $query = mysqli_query($conn, $sql);
        if($query){
            
        }
    }

    // generating new enquirey
    function createenq($data){
        include ("../library/database/config.php");

        $enq_no = $data['enq_no'];

        $enq_date = $data['enq_date'];
        $enq_date = date("Y-m-d", strtotime($enq_date));

        $enq_name = $data['enq_name'];
        $gender = $data['gender'];
        $parent = $data['parent'];
        $enq_pn = $data['enq_pn'];
        $enq_mn = $data['enq_mn'];
        $email = $data['email'];
        $enq_qual = $data['enq_qual'];
        $enq_inst = $data['enq_inst'];
        $source = $data['source'];
        $recommended_crs = $data['recommended_crs'];
        $counselled_by = $data['counselled_by'];

        $nxt_date = $data['nxt_date'];
        $nxt_date = date("Y-m-d", strtotime($nxt_date));

        $sql = "INSERT INTO $enquiry (enq_no, enq_date, stu_name, gender, mfg_name, pno, mno, email, qualification, institution, source, enq_course, counsellor, nxt_date) 
        VALUES ('$enq_no', '$enq_date', '$enq_name', '$gender', '$parent', $enq_pn, $enq_mn, '$email', '$enq_qual', '$enq_inst', '$source', $recommended_crs, $counselled_by, '$nxt_date')";
        $query = mysqli_query($conn, $sql);

        echo $sql;

        if ($query) {
            return true;
        }else{
            // echo "<script>alert('".mysqli_error($conn)."');</script>";
            return false;
        }
    }
?>