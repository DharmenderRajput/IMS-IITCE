<?php
    #this code is responsible for the generatrion of the menu bar according the users priority to access the menu option
    #all these options are controlled from the database itself and there is np dependency on any login criteria

    // session_start();
    $user_access = $_SESSION['user_access'];

    include_once("../library/database/config.php");

    #menu generation code
    $sql = "SELECT * FROM $menu where $user_access = 1 AND menu_position = 0";
    $query = mysqli_query($conn, $sql);

    #query executes properly or not
    if ($query) {

        # query OK
        #fetching all results in associative array
        while($result = mysqli_fetch_assoc($query)){

            $menu_id = $result['menu_id'];
            $menu_head = $result['menu_head'];

            $search = mysqli_query($conn, "SELECT * FROM $menu where menu_position = $menu_id");

            echo '
            <li class="dropdown">
            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$menu_head .' <span class="caret"></span></a>
                <ul class="dropdown-menu">
            ';

            while ($row = mysqli_fetch_assoc($search)) {
                $submenu_head = $row['menu_head'];
                $link = $row['link'];
                $icon = $row['icon'];

                echo '
                    <li><a href="./'.$link.'"><span class="glyphicon '.$icon.'" aria-hidden="true" style="color:black;padding-right:10px;"></span> '.$submenu_head.'</a></li>
                ';
            }

            echo '

                </ul>
            </li>    
            ';

        }

    } else {
        # ERROR in query
    }
    
?>