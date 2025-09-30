<?php
require_once("../Model/database.php");
require_once("../Model/cardinfo.php");

$conn = getDbConn();
$cards = getAllCards($conn);
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
            <li><a href="../Controller/cards_controller.php">Homepage</a></li>
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
                <th>Quantity</th>
                <th>Add</th>
            </tr>
            <?php foreach ($cards as $card): ?>
                <tr>
                    <td><?php echo $card["ProductID"]; ?></td>
                    <td><?php echo htmlspecialchars($card["ProductName"]); ?></td>
                    <td><?php echo htmlspecialchars($card["ProductDescription"]); ?></td>
                    <td>$<?php echo number_format($card["ProductCost"], 2); ?></td>
                    <td>
                        <form method="post" action="../Controller/cards_controller.php">
                            <input type="hidden" name="card_id" value="<?php echo $card["ProductID"]; ?>">
                            <input type="number" name="quantity" value="1" min="1">
                    </td>
                    <td>
                            <input type="submit" name="add_to_cart" value="Add to Cart">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>
    <footer>
        © 2025 Edward's Card Store — All Rights Reserved
    </footer>
</body>
</html>