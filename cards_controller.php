<?php
require_once("../Model/database.php");
$conn = getDbConn();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add_to_cart"])) 
{
    $ProductID = intval($_POST["card_id"] ?? 0);
    $Quantity  = intval($_POST["quantity"] ?? 1);

    if ($ProductID > 0 && $Quantity > 0) 
        {
        $sql = "SELECT ProductCost FROM cards WHERE ProductID = $ProductID";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) === 1) 
        {
            $card = mysqli_fetch_assoc($result);
            $price = intval($card["ProductCost"]);

            $insert = "INSERT INTO order_items (ProductId, Quantity, Price)
                       VALUES ($ProductID, $Quantity, $price)";
            mysqli_query($conn, $insert);

            header("Location: ../View/cart.php");
            exit();
        } else 
        {
            echo "Card not found.";
        }
    } 
    else 
    {
        echo "Invalid input.";
    }
} 
else 
{
    require_once("../Model/cardinfo.php");
    $cards = getAllCards($conn);
    mysqli_close($conn);
    include("../View/index.php");
}