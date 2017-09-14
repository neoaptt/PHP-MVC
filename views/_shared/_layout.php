<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?= empty($viewbag['page_description']) ? '' : $viewbag['page_description'] ?>">
        <meta name="keywords" content="<?= empty($viewbag['page_keywords']) ? '' : $viewbag['page_keywords'] ?>">
        <meta name="author" content="Quinton Ward">

        <title><?= empty($viewbag['page_title']) ? 'Test' : $viewbag['page_title'] ?></title>

        <link href="/public/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <?php
        /*This is where if there is any additional css that the controller wants to load with go*/
        if (!empty($viewbag['page_css']) && is_array($viewbag['page_css'])) {
            /*if the css array exists then loop through each item and print out the html link*/
            foreach ($viewbag['page_css'] as $css) {
                echo "<link href='$css' rel='stylesheet' type='text/css'>";
            }
        }
        ?>
    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Test</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="#">Test</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <?php 
        /*here is where we print the view. Right after the navigation bar*/ 
        require "$_SERVER[DOCUMENT_ROOT]$viewbag[page_path]"; 
        ?>

        <script src="/public/vendors/jquery/jquery.min.js" type="text/javascript"></script>
        <script src="/public/vendors/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <?php
        /*This is where if there is any additional javascript that the controller wants to load with go*/
        if (!empty($viewbag) && !empty($viewbag['page_scripts']) && is_array($viewbag['page_scripts'])) {
            /*if the css array exists then loop through each item and print out the javascript script*/
            foreach ($viewbag['page_scripts'] as $script) {
                echo "<script src='$script'></script>";
            }
        }
        ?>
    </body>
</html>
