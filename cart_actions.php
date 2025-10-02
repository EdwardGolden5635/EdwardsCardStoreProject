<?php
require_once("../Model/database.php");
$conn = getDbConn();

$ProductID = intval($_POST["product_id"] ?? 0);
$Quantity  = intval($_POST["quantity"] ?? 0);

if ($ProductID > 0) 
    {
    if (isset($_POST["add_to_cart"])) 
        {
        $sql = "SELECT ProductCost FROM cards WHERE ProductID = $ProductID";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) === 1) 
        {
            $card = mysqli_fetch_assoc($result);
            $price = intval($card["ProductCost"]);
            $insert = "INSERT INTO order_items (ProductId, Quantity, Price) VALUES ($ProductID, 1, $price)";
            mysqli_query($conn, $insert);
        }
    }

    if (isset($_POST["remove_from_cart"]))
         {
        $delete = "DELETE FROM order_items WHERE ProductId = $ProductID";
        mysqli_query($conn, $delete);
         }

    if (isset($_POST["update_quantity"])) 
        {
        $delete = "DELETE FROM order_items WHERE ProductId = $ProductID";
        mysqli_query($conn, $delete);

        if ($Quantity > 0) 
        {
            $sql = "SELECT ProductCost FROM cards WHERE ProductID = $ProductID";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) === 1) 
            {
                $card = mysqli_fetch_assoc($result);
                $price = intval($card["ProductCost"]);
                $insert = "INSERT INTO order_items (ProductId, Quantity, Price) VALUES ($ProductID, $Quantity, $price)";
                mysqli_query($conn, $insert);
            }
        }
    }
}

header("Location: ../View/index.php");
exit();