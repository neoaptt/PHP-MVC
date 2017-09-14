<?php
/*this namespace allows us to use the same class name called index in multiple different subfolders*/
namespace home;
/*in order to use classes outside our namespace we must use the use keyword and specify the class we are trying to access*/
use PDO;
use db;
class index {
    public function getDBstuff() {
        /*this is a simple select command for MySQL*/
        $sql = "SELECT * FROM php.test WHERE id=:id";
        /*This grabs the database connection from our database class*/
        $pdo = db::getPDO();
        /*set up the return variable in case it doesn't work*/
        $r = false;
        /*preparing a sql command like this means that sql injection cannot happen*/
        if ($con = $pdo->prepare($sql)) {
            /*The execute command is where we place our variables with the keyword from the sql command*/
            $con->execute([':id'=>1]);
            /*fetch all FETCH_ASSOC returns the all the database rows in an associative array*/
            $r = $con->fetchAll(PDO::FETCH_ASSOC);
        }
        /*return this back to the caller, ussually the controller, but could be the view as well.*/
        return $r;
    }
}
