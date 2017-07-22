<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function run() {
    $viewbag = null;
    /* Get the URL and parse it into the controller and view */
    $request = (isset($_GET['request']) ? explode('/', $_GET['request']) : null);
    if (empty($request[1]) && empty($request[0])) {
        /* if no URI passed. Then send to home index */
        $request[0] = 'home';
        $request[1] = 'index';
    } elseif (!empty($request[0]) && empty($request[1])) {
        /* if no action is passed, send to index */
        $request[1] = 'index';
    }
    if (file_exists("$_SERVER[DOCUMENT_ROOT]/controllers/$request[0]Controller.php")) {
        /* include the database connection on every page */
        require "$_SERVER[DOCUMENT_ROOT]/models/_shared/db.php";
        if (file_exists("$_SERVER[DOCUMENT_ROOT]/models/$request[0]/$request[1]Model.php")) {
            /* if there is a model for this page, the include it */
            require "$_SERVER[DOCUMENT_ROOT]/models/$request[0]/$request[1]Model.php";
        }
        /* include the controller */
        require "$_SERVER[DOCUMENT_ROOT]/controllers/$request[0]Controller.php";
        /* construct the controller and use the action. */
        $controller = new $request[0]();
        $viewbag = $controller->{$request[1]}();
        /*get the count of the products in the shopping cart for the navbar*/
        if (empty($viewbag['page_path'])) {
            $viewbag['page_path'] = "/views/$request[0]/$request[1].php";
        }
        if (!empty($viewbag['page_layout']) && $viewbag['page_layout'] == 'none') {
            
        } elseif (empty($viewbag['page_layout'])) {
            /* use default page layout */
            require "$_SERVER[DOCUMENT_ROOT]/views/_shared/_layout.php";
        } else {
            /* use controller defined layout */
            require "$_SERVER[DOCUMENT_ROOT]$viewbag[page_layout]";
        }
    } else {
        echo '404 File does not exist';
    }
    return $viewbag;
}

$viewbag = run();
