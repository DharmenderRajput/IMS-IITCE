<!-- Dashboard for ICM IITCE -->

<?php

    session_start();

    #blocking direct access without login
    if (!isset($_SESSION["user_name"])) {
        #push the user out
        header("location:../");
    }

    #passing data for the view to be generated
    $data = array();
    $data['title'] = "IMS-IITCE Dashboard!";    //title

    // including header file
    include_once("./template/header.php");

?>

<!-- main section of the application -->
<main id="main">

</main>

<?php

    // including footer file
    include_once("./template/footer.php");

?>