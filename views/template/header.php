<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($data['title'])){ echo $data['title']; }else{ echo "IMS-IITCE"; } ?></title>

    <!-- including all UI CSS Assets from assets folder -->
    <link rel="stylesheet" href="../assets/normalize-css/normalize.css">
    <link rel="stylesheet" href="../assets/bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

</head>
<body>
    
    <!-- Header Branding -->
    <div class="container-fluid" id="top-header">
        <div class="row">
            <div class="col-sm-1">
                <img src="../assets/images/iitce_logo.png" alt="IITCE LOGO" width="100px">
            </div>
            <div class="col-sm-7" style="text-align:center;">
                <h1 style="font-weight:bold;color:white;">INSTITUTE MANAGEAMENT SYSTEM</h1>
                <p>For IITCE Developed by DoonDevelopers</p>
            </div>
            <div class="col-sm-3">
                <p>Company - IITCE</p>
                <p>Current Date - <?php echo date("d-m-Y"); ?></p>
                <p>Current User - Admin</p>
            </div>
            <div class="col-sm-1" style="text-align:center;">
                <p></p>
                <span class="glyphicon glyphicon-log-out" aria-hidden="true" style="font-size:40px;color:black;"></span>
                <p style="font-size:16px;">Log-Out</p>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <!-- <a class="navbar-brand" href="#">Brand</a> -->
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">

            <?php
                #Generating the menu bar according to users authority 
                #including menu generation file from library
                include_once("../library/menu_generation.php");
            ?>
            
        </ul>
        
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    </nav>