<?php

    session_start();

    #blocking direct access without login
    if (!isset($_SESSION["user_name"])) {
        #push the user out
        header("location:../");
    }

    #passing data for the view to be generated
    $data = array();
    $data['title'] = "IMS-IITCE Staff Master";    //title

    // including header file
    include_once("./template/header.php");

    include_once("../library/staffmaster.php");

?>

<!-- main section of the application -->

<div class="container-fluid" style="height:90vh;border:2px solid black;">
    <div class="row">
        <div class="col-sm-4" style="height:80vh;border:2px solid black;">

            <h3 class="page-info">STAFF MASTER</h3>
            <hr>
            <!-- stream creation form -->
            <form action="" method="post">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Staff Name</span>
                    <input type="text" class="form-control" name="emp_name" placeholder="Enter Staff Name" aria-describedby="basic-addon1">
                </div><br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon2">Department</span>
                    <!-- <input type="text" class="form-control" name="stream_name" placeholder="Enter Stream Name" aria-describedby="basic-addon2"> -->
                    <select class="form-control" name="dep_name" id="department" aria-describedby="basic-addon2">
                        <!-- <option value="">Select Department</option> -->

                        <?php
                            // fetching available departments
                            fetch_dep();
                        ?>

                    </select>
                    <span class="input-group-btn">
                        <button class="btn btn-default" id="dep_add" onclick="addDepForm()" type="button">Add!</button>
                    </span>
                </div>
                <br>
                <div class="input-group" id="dep_add_form" style="display:none;">
                    <span class="input-group-addon" id="basic-addon2">Add Department</span>
                    <input type="text" class="form-control" id="dep_name" placeholder="Enter Department Name....">
                    <span class="input-group-btn">
                        <button class="btn btn-default" onclick="addDep()" type="button">Go!</button>
                    </span>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">Designation</span>
                    <!-- <input type="text" class="form-control" name="stream_name" placeholder="Enter Stream Name" aria-describedby="basic-addon3"> -->
                    <select class="form-control" name="des_name" id="designation" aria-describedby="basic-addon2">
                        <!-- <option value="">Select Department</option> -->

                        <?php
                            // fetching available departments
                            fetch_des();
                        ?>

                    </select>
                    <span class="input-group-btn">
                        <button class="btn btn-default" id="des_add" onclick="addDesForm()" type="button">Add!</button>
                    </span>
                </div>
                <br>
                <div class="input-group" id="des_add_form" style="display:none;">
                    <span class="input-group-addon" id="basic-addon2">Add Designation</span>
                    <input type="text" class="form-control" id="des_name" placeholder="Enter Department Name....">
                    <span class="input-group-btn">
                        <button class="btn btn-default" onclick="addDes()" type="button">Go!</button>
                    </span>
                </div>
                <!-- <label for="stream_name">Stream</label>
                <input class="form-control" type="text" name="stream_name" id="" placeholder="Enter Stream Name"> -->
                <br>
                <button class="btn btn-success" type="submit" name="new">ADD STAFF</button>
            </form>

            <?php
                 // updating existing stream
                if (isset($_POST['update'])) {
                    $update = $_POST['update'];
                    updateform($update);
                }
            ?>
        </div>
        <div class="col-sm-8" style="height:80vh;border:2px solid black;">
            <!-- display existing stream -->
            <table class="table table-bordered table-striped table-responsive">
                <tr>
                    <th colspan="4">Staff Members</th>
                </tr>
                <tr class="info">
                    <th>Name</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Actions</th>
                </tr>
                <?php
                    // fetching existing staff
                    fetchstaff();
                ?>
            </table>
        </div>
    </div>
</div>

<script>
    // JS for adding functionality

    // updating page data
    function updateDep(){
        $.ajax(
                {
                    type : "POST",
                    url : "../library/staffmaster.php",
                    data : {
                        function : 'fetch_dep'
                    },
                    success: function(result){
                        $('#department').html(result);
                        $('#dep_add_form').css("display","none");
                        // alert('yep');
                        // update data with new sets
                        // fetchFeeHeads(selected);
                    }
                }
            );
    }

    function updateDes(){
        $.ajax(
                {
                    type : "POST",
                    url : "../library/staffmaster.php",
                    data : {
                        function : 'fetch_des'
                    },
                    success: function(result){
                        $('#designation').html(result);
                        $('#des_add_form').css("display","none");
                        // alert('yep');
                        // update data with new sets
                        // fetchFeeHeads(selected);
                    }
                }
            );
    }

    // display for field for adding department
    function addDepForm(){
        $('#dep_add_form').removeAttr("style");
    }

    // display for field for adding designation
    function addDesForm(){
        $('#des_add_form').removeAttr("style");
    }

    // adding new department using AJAX and Updating the list
    function addDep(){
        var dep = $('#dep_name').val();
        if (dep != "") {
            // alert(dep);
            // AJAX call to update the records
            $.ajax(
                {
                    type : "POST",
                    url : "../library/staffmaster.php",
                    data : {
                        function : 'add_dep',
                        name : dep
                    },
                    success: function(result){
                        // $('#display').html(result);
                        // alert('yep');
                        updateDep();
                    }
                }
            );
        }
    }

    // adding new designation using AJAX and Updating the list
    function addDes(){
        var des = $('#des_name').val();
        if (des != "") {
            // alert(dep);
            // AJAX call to update the records
            $.ajax(
                {
                    type : "POST",
                    url : "../library/staffmaster.php",
                    data : {
                        function : 'add_des',
                        name : des
                    },
                    success: function(result){
                        // $('#display').html(result);
                        // alert('yep');
                        updateDes();
                    }
                }
            );
        }
    }
</script>

<?php

    // including footer file
    include_once("./template/footer.php");

    // adding new stream
    if (isset($_POST['new'])) {
        # calling createstaff function
        $data = array();
        $data['dep_name'] = $_POST['dep_name'];
        $data['des_name'] = $_POST['des_name'];
        $data['emp_name'] = $_POST['emp_name'];
        $result = createstaff($data);
        if($result){
            // echo "<script>alert('Hurray');</script>";
            // header("location:./streammaster.php");
            echo "<script>window.location.href='./staffmaster.php';</script>";
        }else{
            echo "<script>alert('Opps!');</script>";
        }
    }


?>