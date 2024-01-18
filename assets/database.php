<?php

/**
 * 
 * Připojení se k databázi
 * 
 * @return object - pro připojení k databázi
 * 
 */

function connectionDB() {
    
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "shop_db";

    $connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    if(mysqli_connect_error()){
        echo mysqli_connect_error();
        exit;
    }

    return $connection;

}

    