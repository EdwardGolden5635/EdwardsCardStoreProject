<?php
function getDbConn() 
{
    $hostname = 'localhost';
    $username = 'ecpi_user';
    $password = 'Password1';
    $dbname   = 'Project';
    $conn     = mysqli_connect($hostname, $username, $password, $dbname);
    return $conn;
}
?>