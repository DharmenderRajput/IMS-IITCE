<?php
    # this peice of code is responsible for creating and updating feeheads

    #creating a new feehead
    function createfeehead ($feehead_data)
    {
        include ("../library/database/config.php");

        $code = $feehead_data['feehead_code'];
        $name = $feehead_data['feehead_name'];
        $type = $feehead_data['feehead_type'];
        $category = $feehead_data['feehead_category'];
        $tax = $feehead_data['feehead_tax'];

        if ($tax == "on") {
            $tax = 1;
        }else{
            $tax = 0;
        }

        $sql = "INSERT INTO $fee_head (fee_head_code, fee_head_name, fee_head_type, fee_head_category, taxable) VALUES ('$code', '$name', '$type', '$category', $tax)";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            # query executed successfully
            return true;
        }else{
            return false;
        }
    }

    #fetching feehead data
    function fetchfeehead()
    {
        include ("../library/database/config.php");

        $sql = "SELECT * FROM $fee_head ";
        $query = mysqli_query($conn, $sql);
        if($query){
            if (mysqli_num_rows($query) > 0) {
                // fetching data in associative array format
                while($row = mysqli_fetch_assoc($query)){
                    $id = $row['id'];
                    $code = $row['fee_head_code'];
                    $name = $row['fee_head_name'];
                    $type = $row['fee_head_type'];
                    $category = $row['fee_head_category'];
                    $tax = $row['taxable'];
                    if ($tax == 1) {
                        $tax = "YES";
                    }else{
                        $tax = "NO";
                    }
                    echo '
                        <tr>
                            <td>'.$code.'</td>
                            <td>'.$name.'</td>
                            <td>'.$type.'</td>
                            <td>'.$category.'</td>
                            <td>'.$tax.'</td>
                            <td>
                                <form method="POST">
                                    <button type="submit" name="update" value="'.$id.'">UPDATE</button>
                                    <button type="submit" name="delete" value="'.$id.'">REMOVE</button>
                                </form>
                            </td>
                        </tr>
                    ';
                }

            }else{
                echo "<tr><td colspan='6'>No Data Found</td></tr>";
            }
        }else{
            echo "<tr><td colspan='6'>Error Occured</td></tr>";
        }

    }

    #updation form
    function updateform($update)   
    {
        include ("../library/database/config.php");

        $sql = "SELECT * FROM $fee_head WHERE id = $update";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            $row = mysqli_fetch_assoc($query);
            $code = $row['fee_head_code'];
            $name = $row['fee_head_name'];
            $type = $row['fee_head_type'];
            $category = $row['fee_head_category'];
            $tax = $row['taxable'];
            if ($tax == 1) {
                $tax = "checked";
            }else{
                $tax = "";
            }

            echo '
            <h3 class="page-info">Fee Head Updation</h3>
            <hr>
            <form action="" method="POST">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Fee Head Code</span>
                    <input type="text" class="form-control" name="feehead_code" value="'.$code.'" placeholder="Enter Fee Head Code" aria-describedby="basic-addon1">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon2">Fee Head Name</span>
                    <input type="text" class="form-control" name="feehead_name" value="'.$name.'" placeholder="Enter Fee Head Name" aria-describedby="basic-addon2">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">Fee Head Type</span>
                <select class="form-control" name="feehead_type" id="" aria-describedby="basic-addon3">
                        <option value="'.$type.'">'.$type.'</option>
                        <option></option>
                        <option value="Institutional">Institutional</option>
                        <option value="Non-Institutional">Non-Institutional</option>
                    </select>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon4">Fee Head Category</span>
                    <select class="form-control" name="feehead_category" id="" aria-describedby="basic-addon4">
                        <option value="'.$category.'">'.$category.'</option>
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
                    <input type="checkbox" class="form-control" name="feehead_tax" aria-describedby="basic-addon5" '.$tax.'>
                </div>
                <br>
                <button class="btn btn-success" type="submit" name="update">Update Feehead</button>
            </form>
            ';

        }else{
            echo "Error Occured!";
        }
    }
?>