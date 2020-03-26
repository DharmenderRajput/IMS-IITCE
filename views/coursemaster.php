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

?>

<!-- main section of the application -->

<div class="container-fluid" style="height:90vh;border:2px solid black;">
    <div class="row">
        <div class="col-sm-6" style="height:80vh;border:2px solid black;">

            <h3 class="page-info">Course Creation</h3>
            <hr>

            <!-- Course creation form -->
            <form action="" method="post">
                <label for="stream_name">Course Stream</label>
                <select class="form-control" name="feehead_category" id="">
                    <option></option>
                    <?php
                        // fetching all streams present
                        $call = 1; //passing 1 to fetch desired output structure
                        fetchstream($call);
                    ?>
                </select>
                <label for="stream_name">Course Full Name</label>
                <input class="form-control" type="text" name="feehead_name" id="" placeholder="Enter Fee Head Name">
                <label for="stream_name">Course Abbr Name</label>
                <input class="form-control" type="text" name="feehead_name" id="" placeholder="Enter Fee Head Name">
                <label for="stream_name">Course Duration</label>
                <input class="form-control" type="number" name="feehead_name" id="" placeholder="Enter Duration Period">
                <select class="form-control" name="feehead_category" id="">
                    <option></option>
                    <option value="">Hours</option>
                    <option value="">Months</option>
                    <option value="">Year</option>
                </select>
                <!-- <label for="stream_name">Taxable</label>
                <input class="form-control" type="checkbox" name="feehead_tax" id=""> -->
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