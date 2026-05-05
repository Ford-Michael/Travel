<?php
/**
 * Printable Bill View
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title ?? 'Print Bill'); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #1f2937;
            margin: 24px;
        }
        .print-actions {
            margin-bottom: 20px;
        }
        .print-actions button,
        .print-actions a {
            display: inline-block;
            border: 1px solid #cbd5e1;
            background: #fff;
            border-radius: 6px;
            padding: 10px 14px;
            text-decoration: none;
            color: #0f172a;
            cursor: pointer;
            margin-right: 8px;
        }
        h1 {
            margin-bottom: 8px;
        }
        .meta {
            color: #64748b;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }
        th, td {
            border: 1px solid #dbe4ee;
            padding: 10px 12px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background: #eff6ff;
        }
        .text-right {
            text-align: right;
        }
        .details-box {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px;
            background: #f8fafc;
            margin-top: 16px;
            white-space: pre-wrap;
        }
        @media print {
            body {
                margin: 12mm;
            }
            .print-actions {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="print-actions">
        <button type="button" onclick="window.print()">Print</button>
        <a href="index.php?controller=bill&action=exportPdf&id=<?php echo urlencode($bill['billID']); ?>" target="_blank">Save as PDF</a>
    </div>

    <h1>Bill <?php echo htmlspecialchars($bill['billID']); ?></h1>
    <div class="meta">Issued at <?php echo !empty($bill['dateIssued']) ? date('d/m/Y H:i', strtotime($bill['dateIssued'])) : 'N/A'; ?></div>

    <table>
        <tr>
            <th width="25%">Customer</th>
            <td><?php echo htmlspecialchars($bill['usersname'] ?? 'N/A'); ?></td>
            <th width="20%">Email</th>
            <td><?php echo htmlspecialchars($bill['userEmail'] ?? 'N/A'); ?></td>
        </tr>
        <tr>
            <th>Tour</th>
            <td><?php echo htmlspecialchars($bill['tourTitle'] ?? 'N/A'); ?></td>
            <th>Destination</th>
            <td><?php echo htmlspecialchars($bill['destination'] ?? 'N/A'); ?></td>
        </tr>
        <tr>
            <th>Adults</th>
            <td><?php echo (int) ($bill['numAdults'] ?? 0); ?></td>
            <th>Children</th>
            <td><?php echo (int) ($bill['numChildren'] ?? 0); ?></td>
        </tr>
        <tr>
            <th>Payment Status</th>
            <td><?php echo htmlspecialchars($bill['paymentStatus'] ?? 'Unknown'); ?></td>
            <th>Total Amount</th>
            <td class="text-right">$<?php echo number_format((float) ($bill['amount'] ?? 0), 2); ?></td>
        </tr>
    </table>

    <?php if (!empty($bill['details'])): ?>
    <div class="details-box"><?php echo htmlspecialchars($bill['details']); ?></div>
    <?php endif; ?>
</body>
</html>
