<?php 
//this page handels 500 errors when running on an apache2 server. 
register_shutdown_function('error_alert'); 

function error_alert() 
{ 
        if(is_null($e = error_get_last()) === false) 
        { 
                //mail('sales@dcsnewyork.com', 'Error from auto_prepend', print_r($e, true)); 
                //$error = print_r($e, true); 
            
                if ($_SERVER['REQUEST_URI'] != '/errors/error_500.php')  {
                    include $_SERVER['DOCUMENT_ROOT'] . "/errors/error_500.php";
                    exit();
                }
                
        } 
} 
?> 