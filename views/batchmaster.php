<?php

    session_start();

    #blocking direct access without login
    if (!isset($_SESSION["user_name"])) {
        #push the user out
        header("location:../");
    }

    #passing data for the view to be generated
    $data = array();
    $data['title'] = "IMS-IITCE Batch Master";    //title

    // including header file
    include_once("./template/header.php");

    include_once("../library/coursemaster.php");
    include_once("../library/staffmaster.php");
    include_once("../library/batchmaster.php");

?>

<!-- main section of the application -->

<div class="container-fluid" id="main" style="height:90vh;border:2px solid black;">
    <div class="row">
        <div class="col-sm-5" style="height:80vh;border:2px solid black;">

            <h3 class="page-info">BATCH CREATION</h3>
            <hr>
            <!-- stream creation form -->
            <form action="" method="post">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Batch Name</span>
                    <input type="text" class="form-control" name="batchname" placeholder="Enter Batch Name" aria-describedby="basic-addon1" required>
                </div>
                <br>
                <!-- <div class="input-group"> -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Start Date</span>
                                <!-- <input type="date" class="form-control" name="stream_name" aria-describedby="basic-addon1"> -->
                                <input class="form-control" id="date" name="sdate" placeholder="DD/MM/YYY" type="text"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">End Date</span>
                                <!-- <input type="date" class="form-control" name="stream_name" aria-describedby="basic-addon1"> -->
                                <input class="form-control" id="date" name="edate" placeholder="DD/MM/YYY" type="text"/>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Course</span>
                        <select name="course" id="course" class="form-control" aria-describedby="basic-addon1">
                            <option value="">Select Course</option>
                            <option value=""></option>
                            <?php
                                #fetching existing courses
                                $code = 1;
                                fetchcourses($code);
                            ?>
                        </select>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Faculty</span>
                        <select name="faculty" id="course" class="form-control" aria-describedby="basic-addon1">
                            <option value="">Select Faculty</option>
                            <option value=""></option>
                            <?php
                                #fetching existing courses
                                $code = 1;
                                fetchstaff($code);
                            ?>
                        </select>
                    </div>
                    <!-- <span class="input-group-addon" id="basic-addon1">Batch Name</span>
                    <input type="text" class="form-control" name="stream_name" placeholder="Enter Batch Name" aria-describedby="basic-addon1"> -->
                <!-- </div> -->
                <!-- <label for="stream_name">Stream</label>
                <input class="form-control" type="text" name="stream_name" id="" placeholder="Enter Stream Name"> -->
                <br>
                <button class="btn btn-success" type="submit" name="new">Create Batch</button>
            </form>

            <?php
                 // updating existing stream
                if (isset($_POST['update'])) {
                    $update = $_POST['update'];
                    updateform($update);
                }
            ?>
        </div>
        <div class="col-sm-7" style="height:80vh;border:2px solid black;">
            <!-- display existing stream -->
            <table class="table table-bordered table-striped table-responsive">
                <tr>
                    <th colspan="4">BATCHES</th>
                </tr>
                <tr class="info">
                    <th>Batch</th>
                    <th>Duration</th>
                    <th>Course</th>
                    <th>Faculty</th>
                </tr>
                <?php
                    // fetching existing streams
                    fetchbatch();
                ?>
            </table>
        </div>
    </div>
</div>


<?php

    // including footer file
    include_once("./template/footer.php");

    // adding new stream
    if (isset($_POST['new'])) {
        # calling createstreame function
        $data = array();
        $data['batchname'] = $_POST['batchname'];
        $data['sdate'] = $_POST['sdate'];
        $data['sdate'] = date("Y-m-d", strtotime($data['sdate']));
        // echo "<script>alert('$date');</script>";
        $data['edate'] = $_POST['edate'];
        $data['edate'] = date("Y-m-d", strtotime($data['edate']));
        $data['course'] = $_POST['course'];
        $data['faculty'] = $_POST['faculty'];
        $result = createbatch($data);
        if($result){
            // echo "<script>alert('Hurray');</script>";
            // header("location:./streammaster.php");
            echo "<script>window.location.href='./batchmaster.php';</script>";
        }else{
            // echo "<script>alert('Opps!');</script>";
        }
    }

    // updating existing stream
    if (isset($_POST['update_stream'])) {
        # calling updatestreame function
        $id = $_POST['stream_id'];
        $update = $_POST['stream_name'];
        $result = updatestream($id, $update);
        if($result){
            // echo "<script>alert('Hurray');</script>";
            // header("location:./streammaster.php");
            echo "<script>window.location.href='./streammaster.php';</script>";
        }else{
            echo "<script>alert('Opps!');</script>";
        }
    }
    
    // deleting a stream
    if (isset($_POST['delete'])) {
        # calling deletestreame function
        $delete = $_POST['delete'];
        $result = deletestreame($delete);
        if($result){
            // echo "<script>alert('Stream Has Been Successfully Removed!');</script>";
            // header("location:./streammaster.php");
            echo "<script>window.location.href='./streammaster.php';</script>";
        }else{
            echo "<script>alert('Opps Some Error has occured.');<script>";
        }
    }

?>
<script>
    $(document).ready(function(){
      var date_input=$('input[name="sdate"]'); //our date input has the name "date"
      var date_input1=$('input[name="edate"]'); //our date input has the name "date"
      var container=$('#main form').length>0 ? $('#main form').parent() : "body";
      var options={
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
      date_input1.datepicker(options);
    })
</script>