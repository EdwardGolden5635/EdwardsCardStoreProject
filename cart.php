<?php
require_once("../Model/database.php");
$conn = getDbConn();

$sql = "SELECT oi.ProductId, c.ProductName, oi.Quantity, oi.Price
        FROM order_items oi
        JOIN cards c ON oi.ProductId = c.ProductID
        WHERE oi.Quantity >= 1
        ORDER BY oi.ProductId ASC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Edward's Card Store</h1>
    </header>
    <nav>
        <ul class="nav-flex">
            <li><a href="index.php">Continue Shopping</a></li>
            <li><a href="cart.php">Shopping Cart</a></li>
        </ul>
    </nav>
    <main>
        <h2>Cart Summary</h2>
        <table>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Product Total</th>
            </tr>
            <?php
            $itemTotal = 0;
            while ($row = mysqli_fetch_assoc($result)):
                $lineTotal = $row["Quantity"] * $row["Price"];
                $itemTotal += $lineTotal;
            ?>
                <tr>
                    <td><?php echo $row["ProductId"]; ?></td>
                    <td><?php echo htmlspecialchars($row["ProductName"]); ?></td>
                    <td><?php echo $row["Quantity"]; ?></td>
                    <td>$<?php echo number_format($row["Price"], 2); ?></td>
                    <td>$<?php echo number_format($lineTotal, 2); ?></td>
                </tr>
            <?php endwhile; ?>

            <?php
            $tax = $itemTotal * 0.05;
            $shipping = $itemTotal * 0.10;
            $orderTotal = $itemTotal + $tax + $shipping;
            ?>
            <tr><td colspan="5"><hr></td></tr>
            <tr>
                <td colspan="4" style="text-align:right;"><strong>Total of Items:</strong></td>
                <td>$<?php echo number_format($itemTotal, 2); ?></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:right;"><strong>Tax (5%):</strong></td>
                <td>$<?php echo number_format($tax, 2); ?></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:right;"><strong>Shipping & Handling (10%):</strong></td>
                <td>$<?php echo number_format($shipping, 2); ?></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:right;"><strong>Order Total:</strong></td>
                <td><strong>$<?php echo number_format($orderTotal, 2); ?></strong></td>
            </tr>
        </table>

        <form method="post" action="../Controller/checkout.php" style="margin-top:20px;">
            <input type="submit" name="checkout" value="Check Out">
        </form>
    </main>
    <footer>
         2025 Edward's Card Store — All Rights Reserved
    </footer>
</body>
</html>