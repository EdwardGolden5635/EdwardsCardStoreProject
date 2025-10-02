<?php
require_once("../Model/database.php");
require_once("../Model/cardinfo.php");

$conn = getDbConn();
$cards = getAllCards($conn);
$cartQuantities = getCartQuantities($conn);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edward's Card Store</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Edward's Card Store</h1>
    </header>
    <nav>
        <ul class="nav-flex">
            <li><a href="index.php">Homepage</a></li>
            <li><a href="cart.php">Shopping Cart</a></li>
        </ul>
    </nav>
    <main>
        <h2>Available Cards</h2>
        <table>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity in Cart</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($cards as $card): 
                $pid = $card["ProductID"];
                $qty = $cartQuantities[$pid] ?? 0;
            ?>
                <tr>
                    <td><?php echo $pid; ?></td>
                    <td><?php echo htmlspecialchars($card["ProductName"]); ?></td>
                    <td><?php echo htmlspecialchars($card["ProductDescription"]); ?></td>
                    <td>$<?php echo number_format($card["ProductCost"], 2); ?></td>
                    <td><?php echo $qty; ?></td>
                    <td>
                        <form method="post" action="../Controller/cart_actions.php" style="display:inline;">
                            <input type="hidden" name="product_id" value="<?php echo $pid; ?>">
                            <input type="number" name="quantity" value="<?php echo $qty; ?>" min="0">
                            <input type="submit" name="update_quantity" value="Update">
                        </form>
                        <form method="post" action="../Controller/cart_actions.php" style="display:inline;">
                            <input type="hidden" name="product_id" value="<?php echo $pid; ?>">
                            <input type="submit" name="add_to_cart" value="Add">
                        </form>
                        <form method="post" action="../Controller/cart_actions.php" style="display:inline;">
                            <input type="hidden" name="product_id" value="<?php echo $pid; ?>">
                            <input type="submit" name="remove_from_cart" value="Remove">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>
    <footer>
         2025 Edward's Card Store — All Rights Reserved
    </footer>
</body>
</html>