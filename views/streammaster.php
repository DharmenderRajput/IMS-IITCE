<?php

    session_start();

    #blocking direct access without login
    if (!isset($_SESSION["user_name"])) {
        #push the user out
        header("location:../");
    }

    #passing data for the view to be generated
    $data = array();
    $data['title'] = "IMS-IITCE Stream Master";    //title

    // including header file
    include_once("./template/header.php");

    include_once("../library/streammaster.php");

?>

<!-- main section of the application -->

<div class="container-fluid" style="height:90vh;border:2px solid black;">
    <div class="row">
        <div class="col-sm-6" style="height:80vh;border:2px solid black;">

            <h3 class="page-info">STREAM CREATION</h3>
            <hr>
            <!-- stream creation form -->
            <form action="" method="post">
                <label for="stream_name">Stream</label>
                <input class="form-control" type="text" name="stream_name" id="" placeholder="Enter Stream Name">
                <button class="btn btn-success" type="submit" name="new">Create Stream</button>
            </form>

            <?php
                 // updating existing stream
                if (isset($_POST['update'])) {
                    $update = $_POST['update'];
                    updateform($update);
                }
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
                    fetchstream();
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