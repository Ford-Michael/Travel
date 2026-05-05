<?php
/**
 * Statistics Excel Export
 */
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Statistics Report</title>
</head>
<body>
    <table border="1">
        <tr>
            <th colspan="2" style="font-size:16px;font-weight:bold;text-align:center;">Statistics Report</th>
        </tr>
        <tr>
            <td colspan="2">Generated at: <?php echo date('d/m/Y H:i:s'); ?></td>
        </tr>
        <tr style="font-weight:bold;background:#ddebf7;">
            <th>Metric</th>
            <th>Value</th>
        </tr>
        <tr><td>Total Users</td><td><?php echo (int) $stats['totalUsers']; ?></td></tr>
        <tr><td>Active Users</td><td><?php echo (int) $stats['activeUsers']; ?></td></tr>
        <tr><td>Inactive Users</td><td><?php echo (int) $stats['inactiveUsers']; ?></td></tr>
        <tr><td>Total Payments</td><td><?php echo (int) $stats['totalCheckouts']; ?></td></tr>
        <tr><td>Total Revenue</td><td><?php echo number_format((float) $stats['totalRevenue'], 0, '.', ','); ?></td></tr>
        <tr><td>Completed Payments</td><td><?php echo (int) $stats['completedPayments']; ?></td></tr>
        <tr><td>Pending Payments</td><td><?php echo (int) $stats['pendingPayments']; ?></td></tr>
        <tr><td>Failed Payments</td><td><?php echo (int) $stats['failedPayments']; ?></td></tr>
    </table>

    <br>

    <table border="1">
        <tr style="font-weight:bold;background:#e2f0d9;">
            <th colspan="2">Monthly User Registrations</th>
        </tr>
        <tr style="font-weight:bold;">
            <th>Month</th>
            <th>Users</th>
        </tr>
        <?php foreach (($stats['userMonthlyData']['labels'] ?? []) as $index => $label): ?>
        <tr>
            <td><?php echo htmlspecialchars($label); ?></td>
            <td><?php echo (int) (($stats['userMonthlyData']['data'][$index] ?? 0)); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br>

    <table border="1">
        <tr style="font-weight:bold;background:#fce4d6;">
            <th colspan="3">Monthly Payment Statistics</th>
        </tr>
        <tr style="font-weight:bold;">
            <th>Month</th>
            <th>Transactions</th>
            <th>Revenue</th>
        </tr>
        <?php foreach (($stats['checkoutMonthlyData']['labels'] ?? []) as $index => $label): ?>
        <tr>
            <td><?php echo htmlspecialchars($label); ?></td>
            <td><?php echo (int) (($stats['checkoutMonthlyData']['counts'][$index] ?? 0)); ?></td>
            <td><?php echo number_format((float) (($stats['checkoutMonthlyData']['amounts'][$index] ?? 0)), 0, '.', ','); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
