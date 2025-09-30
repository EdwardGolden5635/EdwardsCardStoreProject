<?php
require_once("../Model/database.php");
$conn = getDbConn();

$sql = "SELECT oi.ProductId, c.ProductName, c.ProductDescription, oi.Quantity, oi.Price
        FROM order_items oi
        JOIN cards c ON oi.ProductId = c.ProductID
        ORDER BY oi.ProductId DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header>
        <h1>Edward's Card Store</h1>
    </header>
    <nav>
        <ul class="nav-flex">
            <li><a href="../Controller/cards_controller.php">Homepage</a></li>
            <li><a href="cart.php">Shopping Cart</a></li>
        </ul>
    </nav>
    <main>
        <h2>Cart Items</h2>
        <table>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
            <?php
            $grandTotal = 0;
            while ($row = mysqli_fetch_assoc($result)):
                $lineTotal = $row["Quantity"] * $row["Price"];
                $grandTotal += $lineTotal;
            ?>
                <tr>
                    <td><?php echo $row["ProductId"]; ?></td>
                    <td><?php echo htmlspecialchars($row["ProductName"]); ?></td>
                    <td><?php echo htmlspecialchars($row["ProductDescription"]); ?></td>
                    <td><?php echo $row["Quantity"]; ?></td>
                    <td>$<?php echo number_format($row["Price"], 2); ?></td>
                    <td>$<?php echo number_format($lineTotal, 2); ?></td>
                </tr>
            <?php endwhile; ?>
            <tr>
                <td colspan="5" style="text-align:right;"><strong>Grand Total:</strong></td>
                <td><strong>$<?php echo number_format($grandTotal, 2); ?></strong></td>
            </tr>
        </table>
    </main>
    <footer>
        © 2025 Edward's Card Store — All Rights Reserved
    </footer>
</body>
</html>