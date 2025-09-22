<?php

    function getDbconn()
    {
    $hostname = "localhost";
    $username = "ecpi_user";
    $password = "Password1";
    $dbname = "Project";
    return mysqli_connect($hostname, $username, $password, $dbname);
    }
?>