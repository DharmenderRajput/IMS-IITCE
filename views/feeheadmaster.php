<?php

    session_start();

    #blocking direct access without login
    if (!isset($_SESSION["user_name"])) {
        #push the user out
        header("location:../");
    }

    #passing data for the view to be generated
    $data = array();
    $data['title'] = "IMS-IITCE Feehead Master";    //title

    // including header file
    include_once("./template/header.php");

    include_once("../library/feeheadmaster.php");

?>

<!-- main section of the application -->

<div class="container-fluid" style="height:90vh;border:2px solid black;">
    <div class="row">
        <div class="col-sm-6" style="height:80vh;border:2px solid black;">

            <h3 class="page-info">Fee Head Creation</h3>
            <hr>
            <!-- Fee Head creation form -->
            <form action="" method="post">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Fee Head Code</span>
                    <input type="text" class="form-control" name="feehead_code" placeholder="Enter Fee Head Code" aria-describedby="basic-addon1">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon2">Fee Head Name</span>
                    <input type="text" class="form-control" name="feehead_name" placeholder="Enter Fee Head Name" aria-describedby="basic-addon2">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">Fee Head Type</span>
                    <!-- <input type="text" class="form-control" name="feehead_name" placeholder="Enter Fee Head Name" aria-describedby="basic-addon2"> -->
                    <select class="form-control" name="feehead_type" id="" aria-describedby="basic-addon3">
                        <option></option>
                        <option value="">Institutional</option>
                        <option value="">Non-Institutional</option>
                        <!-- <option value="">Refundable</option> -->
                    </select>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon4">Fee Head Category</span>
                    <!-- <input type="text" class="form-control" name="feehead_name" placeholder="Enter Fee Head Name" aria-describedby="basic-addon2"> -->
                    <select class="form-control" name="feehead_category" id="" aria-describedby="basic-addon4">
                        <option></option>
                        <option value="">Installment</option>
                        <option value="">Exam</option>
                        <option value="">Addmission</option>
                        <option value="">Refundable</option>
                        <option value="">Additional</option>
                    </select>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon5">Taxable</span>
                    <input type="checkbox" class="form-control" name="feehead_tax" aria-describedby="basic-addon5">
                </div>
                <br>
                <button class="btn btn-success" type="submit" name="new">Create Stream</button>
            </form>

            <?php
                 // updating existing stream
                // if (isset($_POST['update'])) {
                //     $update = $_POST['update'];
                //     updateform($update);
                // }
            ?>
        </div>
        <div class="col-sm-6" style="height:80vh;;border:2px solid black;">
            <!-- display existing stream -->
            <table class="table">
                <tr>
                    <th>STREAMS</th>
                </tr>
                <?php
                    // fetching existing streams
                    // fetchstream();
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
        $stream_name = $_POST['stream_name'];
        $result = createstream($stream_name);
        if($result){
            // echo "<script>alert('Hurray');</script>";
            header("location:./streammaster.php");
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
            header("location:./streammaster.php");
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
            header("location:./streammaster.php");
        }else{
            echo "<script>alert('Opps Some Error has occured.');<script>";
        }
    }

?>