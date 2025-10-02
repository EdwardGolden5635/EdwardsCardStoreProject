<?php
function getAllCards($conn) 
{
    $sql = "SELECT ProductID, ProductName, ProductDescription, ProductCost FROM cards";
    $result = mysqli_query($conn, $sql);
    $cards = [];

    while ($row = mysqli_fetch_assoc($result)) 
    {
        $cards[] = $row;
    }

    return $cards;
}

function getCartQuantities($conn) 
{
    $sql = "SELECT ProductId, SUM(Quantity) AS Qty FROM order_items GROUP BY ProductId";
    $result = mysqli_query($conn, $sql);
    $quantities = [];

    while ($row = mysqli_fetch_assoc($result)) 
    {
        $quantities[$row["ProductId"]] = $row["Qty"];
    }

    return $quantities;
}
?>