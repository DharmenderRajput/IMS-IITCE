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
        <div class="col-sm-5" style="height:80vh;border:2px solid black;">
            
            <!-- checking for updation condition -->
            <?php
                if(!isset($_POST['update'])){
            ?>
            <h3 class="page-info">Fee Head Creation</h3>
            <hr>
            <!-- Fee Head creation form -->
            <form action="" method="POST">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Fee Head Code</span>
                    <input type="text" class="form-control" name="feehead_code" placeholder="Enter Fee Head Code" aria-describedby="basic-addon1" required>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon2">Fee Head Name</span>
                    <input type="text" class="form-control" name="feehead_name" placeholder="Enter Fee Head Name" aria-describedby="basic-addon2" required>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">Fee Head Type</span>
                   <select class="form-control" name="feehead_type" id="" aria-describedby="basic-addon3" required>
                        <option></option>
                        <option value="Institutional">Institutional</option>
                        <option value="Non-Institutional">Non-Institutional</option>
                    </select>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon4">Fee Head Category</span>
                    <select class="form-control" name="feehead_category" id="" aria-describedby="basic-addon4" required>
                        <option></option>
                        <option value="Installment">Installment</option>
                        <option value="Exam">Exam</option>
                        <option value="Addmission">Addmission</option>
                        <option value="Refundable">Refundable</option>
                        <option value="Additional">Additional</option>
                    </select>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon5">Taxable</span>
                    <input type="checkbox" class="form-control" name="feehead_tax" aria-describedby="basic-addon5">
                </div>
                <br>
                <button class="btn btn-success" type="submit" name="new">Create Feehead</button>
            </form>

            <?php
                }

                if(isset($_POST['update'])){
                //  updating existing feehead
                    $update = $_POST['update'];
                    updateform($update);  
                }
            ?>
        </div>
        <div class="col-sm-7" style="height:80vh;;border:2px solid black;">
            <!-- display existing stream -->
            <table class="table table-bordered table-striped table-responsive">
                <tr>
                    <th colspan="6">Fee-Heads</th>
                </tr>
                <tr class="info">
                    <th>Feehead Code</th>
                    <th>Feehead Name</th>
                    <th>Feehead Type</th>
                    <th>Feehead Category</th>
                    <th>Taxable</th>
                    <th>Actions</th>
                </tr>
                <?php
                    // fetching existing streams
                    fetchfeehead();
                ?>
            </table>
        </div>
    </div>
</div>


<?php

    // including footer file
    include_once("./template/footer.php");

    // adding new feehead
    if (isset($_POST['new'])) {
        # calling createfeehead function
        $feehead_data = array();
        $feehead_data['feehead_code'] = $_POST['feehead_code'];
        $feehead_data['feehead_name'] = $_POST['feehead_name'];
        $feehead_data['feehead_type'] = $_POST['feehead_type'];
        $feehead_data['feehead_category'] = $_POST['feehead_category'];
        $feehead_data['feehead_tax'] = $_POST['feehead_tax'];
        $result = createfeehead($feehead_data);
        if($result){
            // echo "<script>alert('Hurray');</script>";
            // header("location:./streammaster.php");
            echo "<script>window.location.href='./feeheadmaster.php';</script>";
        }else{
            // echo "<script>alert('Opps!');</script>";
        }
    }

    // updating existing feehead
    if (isset($_POST['update_feehead'])) {
        # calling updatefeehead function
        #with required values
        $data = array();
        $data['code'] = $_POST['feehead_code'];
        $data['name'] = $_POST['feehead_name'];
        $data['type'] = $_POST['feehead_type'];
        $data['category'] = $_POST['feehead_category'];
        $data['tax'] = $_POST['feehead_tax'];
        if($data['tax'] == "on"){
            $data['tax'] = 1;
        }else{
            $data['tax'] = 0;
        }
        $id = $_POST['update_feehead'];
        $result = updatefeehead($id, $data);
        if($result){
            // echo "<script>alert('Hurray');</script>";
            // header("location:./streammaster.php");
            echo "<script>window.location.href='./feeheadmaster.php';</script>";

        }else{
            echo "<script>alert('Opps!');</script>";
        }
    }
    
    // deleting a stream
    if (isset($_POST['delete'])) {
        # calling deletefeehead function
        $delete = $_POST['delete'];
        $result = deletefeehead($delete);
        if($result){
            // echo "<script>alert('Stream Has Been Successfully Removed!');</script>";
            // header("location:./streammaster.php");
            echo "<script>window.location.href='./feeheadmaster.php';</script>";

        }else{
            echo "<script>alert('Opps Some Error has occured.');<script>";
        }
    }

?>