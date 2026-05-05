<?php
/**
 * Bills PDF Export View
 * Browser print dialog can be saved as PDF.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($exportTitle); ?></title>
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
        .header {
            margin-bottom: 18px;
        }
        .header h1 {
            margin: 0 0 6px;
            font-size: 24px;
        }
        .header p {
            margin: 0;
            color: #64748b;
        }
        .meta-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px 24px;
            margin: 20px 0 28px;
        }
        .meta-grid div {
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #f8fafc;
        }
        .label {
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #64748b;
            margin-bottom: 6px;
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
        .section-title {
            margin: 30px 0 12px;
            font-size: 18px;
        }
        .details-box {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px;
            background: #f8fafc;
            white-space: pre-wrap;
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
        <a href="index.php?controller=bill<?php echo $bill ? '&action=show&id=' . urlencode($bill['billID']) : ''; ?>">Back</a>
        <button type="button" onclick="window.print()">Save / Print PDF</button>
    </div>

    <?php if ($bill): ?>
        <div class="header">
            <h1>Bill <?php echo htmlspecialchars($bill['billID']); ?></h1>
            <p>Generated at <?php echo date('d/m/Y H:i:s'); ?></p>
        </div>

        <div class="meta-grid">
            <div>
                <span class="label">Customer</span>
                <?php echo htmlspecialchars($bill['usersname'] ?? 'N/A'); ?>
            </div>
            <div>
                <span class="label">Email</span>
                <?php echo htmlspecialchars($bill['userEmail'] ?? 'N/A'); ?>
            </div>
            <div>
                <span class="label">Issued Date</span>
                <?php echo !empty($bill['dateIssued']) ? date('d/m/Y H:i', strtotime($bill['dateIssued'])) : 'N/A'; ?>
            </div>
            <div>
                <span class="label">Payment Status</span>
                <?php echo htmlspecialchars($bill['paymentStatus'] ?? 'Unknown'); ?>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Tour</th>
                    <th>Destination</th>
                    <th>Duration</th>
                    <th>Adults</th>
                    <th>Children</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($bill['tourTitle'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($bill['destination'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($bill['duration'] ?? 'N/A'); ?></td>
                    <td><?php echo (int) ($bill['numAdults'] ?? 0); ?></td>
                    <td><?php echo (int) ($bill['numChildren'] ?? 0); ?></td>
                    <td class="text-right">$<?php echo number_format((float) ($bill['amount'] ?? 0), 2); ?></td>
                </tr>
            </tbody>
        </table>

        <?php if (!empty($bill['details'])): ?>
        <div class="section-title">Additional Details</div>
        <div class="details-box"><?php echo htmlspecialchars($bill['details']); ?></div>
        <?php endif; ?>
    <?php else: ?>
        <div class="header">
            <h1>Bills Report</h1>
            <p>Generated at <?php echo date('d/m/Y H:i:s'); ?></p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Bill ID</th>
                    <th>Tour</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th class="text-right">Amount</th>
                    <th>Issued Date</th>
                    <th>Payment</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($bills)): ?>
                <tr>
                    <td colspan="7">No bills found.</td>
                </tr>
                <?php else: ?>
                    <?php foreach ($bills as $exportBill): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($exportBill['billID'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($exportBill['tourTitle'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($exportBill['usersname'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($exportBill['userEmail'] ?? 'N/A'); ?></td>
                        <td class="text-right">$<?php echo number_format((float) ($exportBill['amount'] ?? 0), 2); ?></td>
                        <td><?php echo !empty($exportBill['dateIssued']) ? date('d/m/Y H:i', strtotime($exportBill['dateIssued'])) : ''; ?></td>
                        <td><?php echo htmlspecialchars($exportBill['paymentStatus'] ?? 'Unknown'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <script>
        window.addEventListener('load', function () {
            window.print();
        });
    </script>
</body>
</html>
