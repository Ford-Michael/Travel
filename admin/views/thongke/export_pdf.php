<?php
/**
 * Statistics PDF Export View
 * Browser print dialog can be saved as PDF.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #1f2937;
            margin: 24px;
        }
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        .toolbar a,
        .toolbar button {
            border: 1px solid #cbd5e1;
            background: #fff;
            border-radius: 6px;
            padding: 10px 14px;
            text-decoration: none;
            color: #0f172a;
            cursor: pointer;
        }
        h1 {
            margin: 0 0 8px;
        }
        .muted {
            color: #64748b;
            margin-bottom: 18px;
        }
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 24px;
        }
        .summary-card {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px;
            background: #f8fafc;
        }
        .summary-card .label {
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #64748b;
            margin-bottom: 6px;
        }
        .summary-card .value {
            font-size: 22px;
            font-weight: 700;
        }
        .section-title {
            margin: 28px 0 12px;
            font-size: 18px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dbe4ee;
            padding: 10px 12px;
            text-align: left;
        }
        th {
            background: #eff6ff;
        }
        .text-right {
            text-align: right;
        }
        @media print {
            body {
                margin: 12mm;
            }
            .toolbar {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="toolbar">
        <a href="index.php?controller=thongke">Back</a>
        <button type="button" onclick="window.print()">Save / Print PDF</button>
    </div>

    <h1>Statistics Report</h1>
    <div class="muted">Generated at <?php echo date('d/m/Y H:i:s'); ?></div>

    <div class="summary-grid">
        <div class="summary-card">
            <span class="label">Total Users</span>
            <div class="value"><?php echo number_format((int) $stats['totalUsers']); ?></div>
        </div>
        <div class="summary-card">
            <span class="label">Active Users</span>
            <div class="value"><?php echo number_format((int) $stats['activeUsers']); ?></div>
        </div>
        <div class="summary-card">
            <span class="label">Inactive Users</span>
            <div class="value"><?php echo number_format((int) $stats['inactiveUsers']); ?></div>
        </div>
        <div class="summary-card">
            <span class="label">Total Payments</span>
            <div class="value"><?php echo number_format((int) $stats['totalCheckouts']); ?></div>
        </div>
        <div class="summary-card">
            <span class="label">Revenue</span>
            <div class="value"><?php echo number_format((float) $stats['totalRevenue'], 0, ',', '.'); ?> VND</div>
        </div>
        <div class="summary-card">
            <span class="label">Completed Payments</span>
            <div class="value"><?php echo number_format((int) $stats['completedPayments']); ?></div>
        </div>
        <div class="summary-card">
            <span class="label">Pending Payments</span>
            <div class="value"><?php echo number_format((int) $stats['pendingPayments']); ?></div>
        </div>
        <div class="summary-card">
            <span class="label">Failed Payments</span>
            <div class="value"><?php echo number_format((int) $stats['failedPayments']); ?></div>
        </div>
    </div>

    <div class="section-title">Monthly User Registrations</div>
    <table>
        <thead>
            <tr>
                <th>Month</th>
                <th class="text-right">Users</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (($stats['userMonthlyData']['labels'] ?? []) as $index => $label): ?>
            <tr>
                <td><?php echo htmlspecialchars($label); ?></td>
                <td class="text-right"><?php echo number_format((int) ($stats['userMonthlyData']['data'][$index] ?? 0)); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="section-title">Monthly Payment Statistics</div>
    <table>
        <thead>
            <tr>
                <th>Month</th>
                <th class="text-right">Transactions</th>
                <th class="text-right">Revenue</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (($stats['checkoutMonthlyData']['labels'] ?? []) as $index => $label): ?>
            <tr>
                <td><?php echo htmlspecialchars($label); ?></td>
                <td class="text-right"><?php echo number_format((int) ($stats['checkoutMonthlyData']['counts'][$index] ?? 0)); ?></td>
                <td class="text-right"><?php echo number_format((float) ($stats['checkoutMonthlyData']['amounts'][$index] ?? 0), 0, ',', '.'); ?> VND</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        window.addEventListener('load', function () {
            window.print();
        });
    </script>
</body>
</html>
