<?php
/**
 * Bills Excel Export
 */
?>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($exportTitle); ?></title>
</head>
<body>
    <table border="1">
        <tr>
            <th colspan="8" style="font-size:16px;font-weight:bold;text-align:center;">
                <?php echo htmlspecialchars($exportTitle); ?>
            </th>
        </tr>
        <tr>
            <td colspan="8">Generated at: <?php echo date('d/m/Y H:i:s'); ?></td>
        </tr>
        <tr style="font-weight:bold;background:#ddebf7;">
            <th>Bill ID</th>
            <th>Booking ID</th>
            <th>Tour</th>
            <th>Customer</th>
            <th>Email</th>
            <th>Amount</th>
            <th>Issued Date</th>
            <th>Payment Status</th>
        </tr>
        <?php if (empty($bills)): ?>
        <tr>
            <td colspan="8">No bills found.</td>
        </tr>
        <?php else: ?>
            <?php foreach ($bills as $exportBill): ?>
            <tr>
                <td><?php echo htmlspecialchars($exportBill['billID'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($exportBill['bookingID'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($exportBill['tourTitle'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($exportBill['usersname'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($exportBill['userEmail'] ?? 'N/A'); ?></td>
                <td><?php echo number_format((float) ($exportBill['amount'] ?? 0), 2, '.', ','); ?></td>
                <td><?php echo !empty($exportBill['dateIssued']) ? date('d/m/Y H:i', strtotime($exportBill['dateIssued'])) : ''; ?></td>
                <td><?php echo htmlspecialchars($exportBill['paymentStatus'] ?? 'Unknown'); ?></td>
            </tr>
            <?php if (!empty($exportBill['details'])): ?>
            <tr>
                <td colspan="8">Details: <?php echo htmlspecialchars($exportBill['details']); ?></td>
            </tr>
            <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>
