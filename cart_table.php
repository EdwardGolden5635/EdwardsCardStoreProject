<table>
    <tr>
        <th>Card#</th>
        <th>Product</th>
        <th>Description</th>
        <th>Cost</th>
        <th>Qty</th>
        <th>Total</th>
    </tr>
    <?php if (!empty($cartItems)): ?>
        <?php
        $grandTotal = 0;
        foreach ($cartItems as $item):
            $lineTotal = $item["ProductCost"] * $item["Quantity"];
            $grandTotal += $lineTotal;
        ?>
            <tr>
                <td><?= htmlspecialchars($item["CardID"]) ?></td>
                <td><?= htmlspecialchars($item["ProductName"]) ?></td>
                <td><?= htmlspecialchars($item["ProductDescription"]) ?></td>
                <td>$<?= number_format($item["ProductCost"], 2) ?></td>
                <td><?= $item["Quantity"] ?></td>
                <td>$<?= number_format($lineTotal, 2) ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="5" style="text-align:right;"><strong>Grand Total:</strong></td>
            <td><strong>$<?= number_format($grandTotal, 2) ?></strong></td>
        </tr>
    <?php else: ?>
        <tr><td colspan="6">Your cart is empty.</td></tr>
    <?php endif; ?>
</table>