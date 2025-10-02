<?php
require_once("../Model/database.php");
$conn = getDbConn();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["checkout"])) 
    {
    $clear = "DELETE FROM order_items";
    mysqli_query($conn, $clear);
    }

header("Location: ../View/index.php");
exit();