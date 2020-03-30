<?php

    session_start();

    #blocking direct access without login
    if (!isset($_SESSION["user_name"])) {
        #push the user out
        header("location:../");
    }

    #passing data for the view to be generated
    $data = array();
    $data['title'] = "IMS-IITCE Course Master";    //title

    // including header file
    include_once("./template/header.php");

    include_once("../library/streammaster.php");

    include_once("../library/coursemaster.php");

?>

<!-- main section of the application -->

<div class="container-fluid" style="height:90vh;border:2px solid black;">
    <div class="row">
        <div class="col-sm-5" style="height:80vh;border:2px solid black;">

            <?php
                if(!isset($_POST['update'])){
            ?>

            <h3 class="page-info">Course Creation</h3>
            <hr>

            <!-- Course creation form -->
            <form action="" method="post">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Course Stream</span>
                    <select class="form-control" name="course_stream" id="" aria-describedby="basic-addon1" required>
                        <option></option>
                        <?php
                            // fetching all streams present
                            $call = 1; //passing 1 to fetch desired output structure
                            fetchstream($call);
                        ?>
                    </select>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">Course Abbr Name</span>
                    <input type="text" class="form-control" name="course_aname" placeholder="Enter Course Abbriviation Name" aria-describedby="basic-addon3" required>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon2">Course Full Name</span>
                    <input type="text" class="form-control" name="course_fname" placeholder="Enter Course Full Name" aria-describedby="basic-addon2" required>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon4">Course Duration</span>
                    <input type="number" class="form-control" name="course_duration" placeholder="Enter Duration" aria-describedby="basic-addon4" required>
                    <select class="form-control" name="course_period" id="" aria-describedby="basic-addon4" required>
                        <option></option>
                        <option value="Hours">Hours</option>
                        <option value="Months">Months</option>
                        <option value="Year">Year</option>
                </select>
                </div>
                <br>
                <!-- <label for="stream_name">Taxable</label>
                <input class="form-control" type="checkbox" name="feehead_tax" id=""> -->
                <button class="btn btn-success" type="submit" name="new">Create Course</button>
            </form>

            <?php
                }else{
                    #implementing updation form
                    $update = $_POST['update'];
                    updatecourseform($update);
                }
            ?>
        </div>
        <div class="col-sm-7" style="height:80vh;;border:2px solid black;">
            <!-- display existing Courses -->
            <table class="table table-bordered table-striped table-responsive">
                <tr>
                    <th colspan="5">Available Courses</th>
                </tr>
                <tr class="info">
                    <th>Stream</th>
                    <th>Abbr Name</th>
                    <th>Full Name</th>
                    <th>Duration</th>
                    <th>Actions</th>
                </tr>
                <?php
                    // fetching existing streams
                    fetchcourses();
                ?>
            </table>
        </div>
    </div>
</div>


<?php

    // including footer file
    include_once("./template/footer.php");

    // adding new course
    if (isset($_POST['new'])) {
        # calling createcourse function
        # with all required values;
        $data = array();
        $data = [
            "stream" => $_POST['course_stream'],
            "fname" => $_POST['course_fname'],
            "aname" => $_POST['course_aname'],
            "duration" => $_POST['course_duration'],
            "period" => $_POST['course_period']
        ];
        $result = createcourse($data);
        if($result){
            // echo "<script>alert('Hurray');</script>";
            // header("location:./streammaster.php");
            echo "<script>window.location.href='./coursemaster.php';</script>";

        }else{
            // echo "<script>alert('Opps!');</script>";
        }
    }

    // updating existing course
    if (isset($_POST['update_crs'])) {

        $id = $_POST['update_crs'];
        # calling updatecrs function
        $data = array();
        $data = [
            "stream" => $_POST['course_stream'],
            "fname" => $_POST['course_fname'],
            "aname" => $_POST['course_aname'],
            "duration" => $_POST['course_duration'],
            "period" => $_POST['course_period']
        ];
        
        $result = updatecrs($id, $data);
        if($result){
            // echo "<script>alert('Hurray');</script>";
            // header("location:./streammaster.php");
            echo "<script>window.location.href='./coursemaster.php';</script>";

        }else{
            echo "<script>alert('Opps!');</script>";
        }
    }
    
    // deleting a stream
    if (isset($_POST['delete'])) {
        # calling deletestreame function
        $delete = $_POST['delete'];
        $result = deletecourse($delete);
        if($result){
            // echo "<script>alert('Stream Has Been Successfully Removed!');</script>";
            // header("location:./streammaster.php");
            echo "<script>window.location.href='./coursemaster.php';</script>";

        }else{
            echo "<script>alert('Opps Some Error has occured.');<script>";
        }
    }

?>