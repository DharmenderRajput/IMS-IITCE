<?php

    session_start();

    #blocking direct access without login
    if (!isset($_SESSION["user_name"])) {
        #push the user out
        header("location:../");
    }

    #passing data for the view to be generated
    $data = array();
    $data['title'] = "IMS-IITCE Students Enquiry Form";    //title

    // including header file
    include_once("./template/header.php");

    include_once("../library/coursemaster.php");
    include_once("../library/enquiry.php");

?>

<!-- main section of the application -->

<div class="container-fluid" style="height:90vh;border:2px solid black;">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-4">
                    <h3 class="page-info">Student Enquiry</h3>
                </div>
                <div class="col-sm-8">
                    <form action="" method="POST">
                        <button class="btn btn-success" type="submit" name="new">NEW</button>
                    </form>
                </div>
            </div>
            
            <hr>
            <!-- main section to display data and new enquiry form -->

            <?php
                // if request for new enquiry is generated
                if (isset($_POST['new'])) {
                    
                    #calling function to display the form
                    newenquiry();


                }else{
                    // fetch the data for existing Enquires
                    echo '
                        <table class="table table-responsive table-bordered">
                            <tr class="info">
                                <th>Student Name</th>
                                <th>Gurdain Name</th>
                                <th>Enquiry Date</th>
                                <th>Mobile No.</th>
                                <th>Address</th>
                                <th>Location</th>
                                <th>Qualification</th>
                            </tr>
                    ';
                        // fetchdata();
                    echo '
                        </table>
                    ';
                }
            ?>


            <!-- stream creation form -->
            <!-- <form action="" method="post">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Stream Name</span>
                    <input type="text" class="form-control" name="stream_name" placeholder="Enter Stream Name" aria-describedby="basic-addon1">
                </div>
                <br>
                <button class="btn btn-success" type="submit" name="new">Create Stream</button>
            </form> -->
            <!-- <form class="form-inline">
                <div class="form-group">
                    <label for="exampleInputName2">Enquiry Number</label>
                    <input type="text" class="form-control" id="exampleInputName2" placeholder="Jane Doe">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail2">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="jane.doe@example.com">
                </div>
                <button type="submit" class="btn btn-default">Send invitation</button>
            </form> -->
            <?php
                 // updating existing stream
                if (isset($_POST['update'])) {
                    $update = $_POST['update'];
                    updateform($update);
                }
            ?>
        </div>
    </div>
</div>


<?php

    // including footer file
    include_once("./template/footer.php");

    // // adding new enquirey
    if (isset($_POST['new_enq'])) {
        # calling createenq function
        $data = array();
        $data['enq_no'] = $_POST['enq_no'];
        $data['enq_date'] = $_POST['enq_date'];
        $data['enq_name'] = $_POST['enq_name'];
        $data['gender'] = $_POST['gender'];
        $data['parent'] = $_POST['parent'];
        $data['enq_pn'] = $_POST['enq_pn'];
        $data['enq_mn'] = $_POST['enq_mn'];
        $data['email'] = $_POST['email'];
        $data['enq_qual'] = $_POST['enq_qual'];
        $data['enq_inst'] = $_POST['enq_inst'];
        $data['source'] = $_POST['source'];
        $data['recommended_crs'] = $_POST['recommended_crs'];
        $data['counselled_by'] = $_POST['counselled_by'];
        $data['nxt_date'] = $_POST['nxt_date'];
        // createenq($data);
        $result = createenq($data);
        if($result){
            // echo "<script>alert('Hurray');</script>";
            // header("location:./streammaster.php");
            echo "<script>window.location.href='./enquiry.php';</script>";
        }else{
            echo "<script>alert('oopsa');</script>";
        }
    }

    // // updating existing stream
    // if (isset($_POST['update_stream'])) {
    //     # calling updatestreame function
    //     $id = $_POST['stream_id'];
    //     $update = $_POST['stream_name'];
    //     $result = updatestream($id, $update);
    //     if($result){
    //         // echo "<script>alert('Hurray');</script>";
    //         // header("location:./streammaster.php");
    //         echo "<script>window.location.href='./streammaster.php';</script>";
    //     }else{
    //         echo "<script>alert('Opps!');</script>";
    //     }
    // }
    
    // // deleting a stream
    // if (isset($_POST['delete'])) {
    //     # calling deletestreame function
    //     $delete = $_POST['delete'];
    //     $result = deletestreame($delete);
    //     if($result){
    //         // echo "<script>alert('Stream Has Been Successfully Removed!');</script>";
    //         // header("location:./streammaster.php");
    //         echo "<script>window.location.href='./streammaster.php';</script>";
    //     }else{
    //         echo "<script>alert('Opps Some Error has occured.');<script>";
    //     }
    // }

?>
<script>
    $(document).ready(function(){
      var date_input=$('input[name="nxt_date"]'); //our date input has the name "date"
    //   var date_input1=$('input[name="edate"]'); //our date input has the name "date"
      var container=$('#main form').length>0 ? $('#main form').parent() : "body";
      var options={
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    //   date_input1.datepicker(options);
    })
</script>
<script>
// stop form resubmission
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>