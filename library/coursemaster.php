<?php
  #function for creating new course
  function createcourse($data)
  {
      include ("../library/database/config.php");

      $sql = "INSERT INTO $courses (crs_stream, crs_fname, crs_aname, crs_duration, crs_period) VALUES (".$data['stream'].", '".$data['fname']."', '".$data['aname']."', ".$data['duration'].", '".$data['period']."')";
      $query = mysqli_query($conn, $sql);
      
      if ($query) {
          return true;
      }else{
        return false;
      }
  }  

  function fetchcourses()
  {
    include ("../library/database/config.php");

    $sql = "SELECT * FROM $courses";
    $query = mysqli_query($conn, $sql);

    if($query){
        if (mysqli_num_rows($query) > 0) {
            // fetching data in associative array format
            while($row = mysqli_fetch_assoc($query)){
                $id = $row['id'];

                $stream = $row['crs_stream'];
                #converting stream id to name
                $query2 = mysqli_query($conn, "SELECT * FROM $streams WHERE id = $stream");
                if ($query2) {
                    $result = mysqli_fetch_assoc($query2);
                    $stream = $result['stream_name'];
                }

                $fname = $row['crs_fname'];
                $aname = $row['crs_aname'];
                $duration = $row['crs_duration'];
                $period = $row['crs_period'];
                
                echo '
                    <tr>
                        <td>'.$stream.'</td>
                        <td>'.$fname.'</td>
                        <td>'.$aname.'</td>
                        <td>'.$duration.' '.$period.'</td>
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
            echo "<tr><td colspan='5'>No Data Found</td></tr>";
        }
    }else{
        echo "<tr><td colspan='5'>Error Occured</td></tr>";
    }
  }

  # removing a course
  function deletecourse($delete){
    include ("../library/database/config.php");

    $sql = "DELETE FROM $courses WHERE id = $delete";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        return true;
    }else{
        return false;
    }
  }

  #updating a course
  function updatecourseform($update)
  {
    include ("../library/database/config.php");

    $sql = "SELECT * FROM $courses WHERE id = $update";
    $query = mysqli_query($conn, $sql);

    if($query){
        #fetching all data 
        $row = mysqli_fetch_assoc($query);

        $stream = $row['crs_stream'];
        #converting stream id to name
        $stream_name;
        $query2 = mysqli_query($conn, "SELECT * FROM $streams WHERE id = $stream");
        if ($query2) {
            $result = mysqli_fetch_assoc($query2);
            $stream_name = $result['stream_name'];
        }

        $fname = $row['crs_fname'];
        $aname = $row['crs_aname'];
        $duration = $row['crs_duration'];
        $period = $row['crs_period'];

        echo '
            <h3 class="page-info">Course Updation</h3>
            <hr>

            <!-- Course creation form -->
            <form action="" method="post">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Course Stream</span>
                    <select class="form-control" name="course_stream" id="" aria-describedby="basic-addon1" required>
                        <option value = "'.$stream.'">'.$stream_name.'</option>
                        <option></option>
                            ';
                            fetchstream(1);
                            echo '
                    </select>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon2">Course Full Name</span>
                    <input type="text" class="form-control" name="course_fname" value="'.$fname.'" placeholder="Enter Course Full Name" aria-describedby="basic-addon2" required>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">Course Abbr Name</span>
                    <input type="text" class="form-control" name="course_aname" value="'.$aname.'" placeholder="Enter Course Abbriviation Name" aria-describedby="basic-addon3" required>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon4">Course Duration</span>
                    <input type="number" class="form-control" name="course_duration" value="'.$duration.'" placeholder="Enter Duration" aria-describedby="basic-addon4" required>
                    <select class="form-control" name="course_period" id="" aria-describedby="basic-addon4" required>
                        <option value="'.$period.'">'.$period.'</option>
                        <option></option>
                        <option value="Hours">Hours</option>
                        <option value="Months">Months</option>
                        <option value="Year">Year</option>
                </select>
                </div>
                <br>
                <!-- <label for="stream_name">Taxable</label>
                <input class="form-control" type="checkbox" name="feehead_tax" id=""> -->
                <button class="btn btn-success" type="submit" value="'.$update.'" name="update_crs">Update Course</button>
            </form>
        ';
    }
  }

  function updatecrs($id, $data)
  {
      include ("../library/database/config.php");

      $sql = "UPDATE $courses SET crs_stream = ".$data['stream'].", crs_fname = '".$data['fname']."', crs_aname = '".$data['aname']."', crs_duration = ".$data['duration'].", crs_period = '".$data['period']."' WHERE id = $id";
      $query = mysqli_query($conn, $sql);

      if ($query) {
          return true;
      }else{
          return false;
      }
  }
?>