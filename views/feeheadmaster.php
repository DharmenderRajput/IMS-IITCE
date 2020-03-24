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
    <div class="container-fluid" style="height:10vh;">
        <!-- this area only displays descriptive informations -->
        <h3>Fee Head Creation</h3>
    </div>
    <div class="row">
        <div class="col-sm-6" style="height:80vh;background:red;border:2px solid black;">
            <!-- Fee Head creation form -->
            <form action="" method="post">
                <label for="stream_name">Fee Head Code</label>
                <input class="form-control" type="text" name="feehead_code" id="" placeholder="Enter Fee Head Code">
                <label for="stream_name">Fee Head Name</label>
                <input class="form-control" type="text" name="feehead_name" id="" placeholder="Enter Fee Head Name">
                <label for="stream_name">Fee Head Type</label>
                <select class="form-control" name="feehead_type" id="">
                    <option value="">Institutional</option>
                    <option value="">Non-Institutional</option>
                    <option value="">Refundable</option>
                </select>
                <label for="stream_name">Fee Head Category</label>
                <select class="form-control" name="feehead_category" id="">
                    <option value="">Institutional</option>
                    <option value="">Non-Institutional</option>
                    <option value="">Refundable</option>
                </select>
                <label for="stream_name">Taxable</label>
                <input class="form-control" type="checkbox" name="feehead_tax" id="">
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