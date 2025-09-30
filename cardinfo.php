<?php
function getAllCards($conn) {
    $sql = "SELECT ProductID, ProductName, ProductDescription, ProductCost FROM cards";
    $result = mysqli_query($conn, $sql);
    $cards = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $cards[] = $row;
    }

    return $cards;
}
?>