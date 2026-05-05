<?php
/**
 * Payments Excel Export
 */
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Payments Report</title>
</head>
<body>
    <table border="1">
        <tr>
            <th colspan="8" style="font-size:16px;font-weight:bold;text-align:center;">Payments Report</th>
        </tr>
        <tr>
            <td colspan="8">Generated at: <?php echo date('d/m/Y H:i:s'); ?></td>
        </tr>
        <tr style="font-weight:bold;background:#ddebf7;">
            <th>ID</th>
            <th>Tour</th>
            <th>Customer</th>
            <th>Email</th>
            <th>Method</th>
            <th>Transaction ID</th>
            <th>Amount</th>
            <th>Status</th>
        </tr>
        <?php if (empty($checkouts)): ?>
        <tr><td colspan="8">No payments found.</td></tr>
        <?php else: ?>
            <?php foreach ($checkouts as $exportCheckout): ?>
            <tr>
                <td><?php echo htmlspecialchars($exportCheckout['checkoutID'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($exportCheckout['tourTitle'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($exportCheckout['usersname'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($exportCheckout['userEmail'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($exportCheckout['paymentMethod'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($exportCheckout['transactionID'] ?? 'N/A'); ?></td>
                <td><?php echo number_format((float) ($exportCheckout['amount'] ?? 0), 2, '.', ','); ?></td>
                <td><?php echo htmlspecialchars($exportCheckout['paymentStatus'] ?? 'Unknown'); ?></td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>
