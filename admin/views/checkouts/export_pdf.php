<?php
/**
 * Payments PDF Export View
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments Report</title>
    <style>
        body { font-family: Arial, sans-serif; color: #1f2937; margin: 24px; }
        .toolbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; }
        .toolbar a, .toolbar button { border:1px solid #cbd5e1; background:#fff; border-radius:6px; padding:10px 14px; text-decoration:none; color:#0f172a; cursor:pointer; }
        h1 { margin:0 0 8px; }
        .muted { color:#64748b; margin-bottom:18px; }
        table { width:100%; border-collapse:collapse; }
        th, td { border:1px solid #dbe4ee; padding:10px 12px; text-align:left; vertical-align:top; }
        th { background:#eff6ff; }
        .text-right { text-align:right; }
        @media print { body { margin:12mm; } .toolbar { display:none; } }
    </style>
</head>
<body>
    <div class="toolbar">
        <a href="index.php?controller=checkout<?php echo $checkout ? '&action=show&id=' . urlencode($checkout['checkoutID']) : ''; ?>">Back</a>
        <button type="button" onclick="window.print()">Save / Print PDF</button>
    </div>

    <h1><?php echo $checkout ? 'Payment #' . htmlspecialchars($checkout['checkoutID']) : 'Payments Report'; ?></h1>
    <div class="muted">Generated at <?php echo date('d/m/Y H:i:s'); ?></div>

    <?php if ($checkout): ?>
    <table>
        <tr><th width="25%">Customer</th><td><?php echo htmlspecialchars($checkout['usersname'] ?? 'N/A'); ?></td><th width="20%">Email</th><td><?php echo htmlspecialchars($checkout['userEmail'] ?? 'N/A'); ?></td></tr>
        <tr><th>Tour</th><td><?php echo htmlspecialchars($checkout['tourTitle'] ?? 'N/A'); ?></td><th>Method</th><td><?php echo htmlspecialchars($checkout['paymentMethod'] ?? 'N/A'); ?></td></tr>
        <tr><th>Transaction ID</th><td><?php echo htmlspecialchars($checkout['transactionID'] ?? 'N/A'); ?></td><th>Status</th><td><?php echo htmlspecialchars($checkout['paymentStatus'] ?? 'Unknown'); ?></td></tr>
        <tr><th>Payment Date</th><td><?php echo !empty($checkout['paymentDate']) ? date('d/m/Y H:i', strtotime($checkout['paymentDate'])) : 'N/A'; ?></td><th>Amount</th><td class="text-right">$<?php echo number_format((float) ($checkout['amount'] ?? 0), 2); ?></td></tr>
    </table>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tour</th>
                <th>Customer</th>
                <th>Method</th>
                <th>Transaction ID</th>
                <th class="text-right">Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($checkouts)): ?>
            <tr><td colspan="7">No payments found.</td></tr>
            <?php else: ?>
                <?php foreach ($checkouts as $exportCheckout): ?>
                <tr>
                    <td><?php echo htmlspecialchars($exportCheckout['checkoutID'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($exportCheckout['tourTitle'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($exportCheckout['usersname'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($exportCheckout['paymentMethod'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($exportCheckout['transactionID'] ?? 'N/A'); ?></td>
                    <td class="text-right">$<?php echo number_format((float) ($exportCheckout['amount'] ?? 0), 2); ?></td>
                    <td><?php echo htmlspecialchars($exportCheckout['paymentStatus'] ?? 'Unknown'); ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <?php endif; ?>

    <script>
        window.addEventListener('load', function () { window.print(); });
    </script>
</body>
</html>
