<?php

    session_start();

    #blocking direct access without login
    if (!isset($_SESSION["user_name"])) {
        #push the user out
        header("location:../");
    }

    #passing data for the view to be generated
    $data = array();
    $data['title'] = "IMS-IITCE Course Fee Setup";    //title

    // including header file
    include_once("./template/header.php");

    include_once("../library/coursemaster.php");

?>

<!-- main section of the application -->

<div class="container-fluid" style="height:90vh;border:2px solid black;">
    <div class="row">
        <div class="col-sm-6" style="height:80vh;border:2px solid black;">

            <h3 class="page-info">COURSE FEE SETUP</h3>
            <hr>
            <!-- stream creation form -->
            <form action="" method="post">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Select Course</span>
                    <!-- <input type="text" class="form-control" name="stream_name" placeholder="Enter Stream Name" aria-describedby="basic-addon1"> -->
                    <select name="" id="course" class="form-control" onChange = "fetchFeeHeads(this.value)" aria-describedby="basic-addon1">
                        <option value=""></option>
                        <?php
                            #fetching existing courses
                            $code = 1;
                            fetchcourses($code);
                        ?>
                    </select>
                </div>
                <br>
                <div id="feeheads">
                
                </div>
                <!-- <label for="stream_name">Stream</label>
                <input class="form-control" type="text" name="stream_name" id="" placeholder="Enter Stream Name"> -->
                <!-- <br>
                <button class="btn btn-warning" type="submit" name="new">ADD</button> -->
            </form>

            <?php
                 // updating existing stream
                if (isset($_POST['update'])) {
                    $update = $_POST['update'];
                    updateform($update);
                }
            ?>
        </div>
        <div class="col-sm-6" style="height:80vh;border:2px solid black;">
            <!-- display existing stream -->
            <table class="table table-bordered table-striped table-responsive" id="display">
                <tbody>
                    <tr>
                        <th colspan="2">FEE-HEADS</th>
                    </tr>
                    <tr class="info">
                        <th>Course</th>
                        <th>Fee-Head</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Ajax code to fetch dynamic data

    // fetching available fee-heads for a course
    function fetchFeeHeads(selected){
        // alert(selected);
        $.ajax(
            {
                type : "POST",
                url : "../library/coursefee.php",
                data : {
                    function : 'feeheads',
                    course : selected
                },
                success: function(result){
                    $('#feeheads').html(result);
                }
            }
        );

        $.ajax(
            {
                type : "POST",
                url : "../library/coursefee.php",
                data : {
                    function : 'display',
                    course : selected
                },
                success: function(result){
                    $('#display').html(result);
                }
            }
        );
    }
</script>

<?php

    // including footer file
    include_once("./template/footer.php");

    // adding new stream
    if (isset($_POST['new'])) {
        # calling createstreame function
        $stream_name = $_POST['stream_name'];
        $result = createstream($stream_name);
        if($result){
            // echo "<script>alert('Hurray');</script>";
            // header("location:./streammaster.php");
            echo "<script>window.location.href='./streammaster.php';</script>";
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