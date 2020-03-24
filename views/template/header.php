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

</head>
<body>
    
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