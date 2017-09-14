<?php

/*this allows errors to show throughout the entire website. it is adviced to remove this error checking on production code*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*this function run() is a top level function. I put all my code inside this function to limit the ammount of global variables*/
function run() {
    /*setting this variable to null allows me to use it in different scopes throughout this function*/
    $viewbag = null;
    /*here i check if the user has requested a page. If they have, then return the requestion page into parts for me to parse later*/
    $request = (isset($_GET['request']) ? explode('/', $_GET['request']) : null);
    /*Here is check if the user is accessing a specific page, if not, then assume they are searching for the home page or index page*/
    if (empty($request[1]) && empty($request[0])) {
        /* if no URI passed. Then send to home index */
        $request[0] = 'home';
        $request[1] = 'index';
    } elseif (!empty($request[0]) && empty($request[1])) {
        /* if no action is passed, send to index */
        $request[1] = 'index';
    }
    /*after i know exactly where the user wants to go i check if there is a file that exists in that space*/
    if (file_exists("$_SERVER[DOCUMENT_ROOT]/controllers/$request[0]Controller.php")) {
        /* include the database connection on every page */
        require "$_SERVER[DOCUMENT_ROOT]/models/_shared/db.php";
        /*here i check if the programmer has created a model, or business logic, for the requested page*/
        if (file_exists("$_SERVER[DOCUMENT_ROOT]/models/$request[0]/$request[1]Model.php")) {
            /* if there is a model for this page, the include it */
            require "$_SERVER[DOCUMENT_ROOT]/models/$request[0]/$request[1]Model.php";
        }
        /* include the controller, which will control how to route the user to their assigned function */
        require "$_SERVER[DOCUMENT_ROOT]/controllers/$request[0]Controller.php";
        /* construct the controller and use the action. */
        $controller = new $request[0]();
        /*I use the variables as function and class names. This allows me to dynamicly load in any class and function the user needs*/
        $viewbag = $controller->{$request[1]}();
        /*if the programmer did not deside to change what view he or she is using, then use the default path for the view*/
        if (empty($viewbag['page_path'])) {
            /*this builds the default view path that will be used later*/
            $viewbag['page_path'] = "/views/$request[0]/$request[1].php";
        }
        /*Here i check whether the programmer wanted to use a different page layout than the default one*/
        if (!empty($viewbag['page_layout']) && $viewbag['page_layout'] == 'none') {
            /*this is a simple way to not use any layout*/
        } elseif (empty($viewbag['page_layout'])) {
            /* use default page layout */
            require "$_SERVER[DOCUMENT_ROOT]/views/_shared/_layout.php";
        } else {
            /* use the controller defined layout */
            require "$_SERVER[DOCUMENT_ROOT]$viewbag[page_layout]";
        }
    } else {
        /*if i could not find the controller for the given page, then give the user a simple 404 error*/
        echo '404 File does not exist';
    }
    /*returning the viewbag variable is how i return the information needed to pass onto the html page, such as database information*/
    return $viewbag;
}
/*after defining the function I use the function and begin the program*/
$viewbag = run();
/*from here on is where the database connection, controller, layout, and view are created and displayed.*/
