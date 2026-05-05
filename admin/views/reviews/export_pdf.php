<?php
/**
 * Reviews PDF Export View
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews Report</title>
    <style>
        body { font-family: Arial, sans-serif; color: #1f2937; margin: 24px; }
        .toolbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; }
        .toolbar a, .toolbar button { border:1px solid #cbd5e1; background:#fff; border-radius:6px; padding:10px 14px; text-decoration:none; color:#0f172a; cursor:pointer; }
        h1 { margin:0 0 8px; }
        .muted { color:#64748b; margin-bottom:18px; }
        table { width:100%; border-collapse:collapse; }
        th, td { border:1px solid #dbe4ee; padding:10px 12px; text-align:left; vertical-align:top; }
        th { background:#eff6ff; }
        .details-box { border:1px solid #e2e8f0; border-radius:8px; padding:14px; background:#f8fafc; white-space:pre-wrap; }
        @media print { body { margin:12mm; } .toolbar { display:none; } }
    </style>
</head>
<body>
    <div class="toolbar">
        <a href="index.php?controller=review">Back</a>
        <button type="button" onclick="window.print()">Save / Print PDF</button>
    </div>

    <h1><?php echo $review ? 'Review #' . htmlspecialchars($review['reviewID']) : 'Reviews Report'; ?></h1>
    <div class="muted">Generated at <?php echo date('d/m/Y H:i:s'); ?></div>

    <?php if ($review): ?>
    <table>
        <tr><th width="25%">Tour</th><td><?php echo htmlspecialchars($review['tourTitle'] ?? 'N/A'); ?></td><th width="20%">Customer</th><td><?php echo htmlspecialchars($review['usersname'] ?? 'N/A'); ?></td></tr>
        <tr><th>Email</th><td><?php echo htmlspecialchars($review['userEmail'] ?? 'N/A'); ?></td><th>Rating</th><td><?php echo (int) ($review['rating'] ?? 0); ?>/5</td></tr>
        <tr><th>Date</th><td colspan="3"><?php echo !empty($review['timestamp']) ? date('d/m/Y H:i', strtotime($review['timestamp'])) : 'N/A'; ?></td></tr>
    </table>
    <h3>Comment</h3>
    <div class="details-box"><?php echo htmlspecialchars($review['comment'] ?? ''); ?></div>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tour</th>
                <th>Customer</th>
                <th>Rating</th>
                <th>Comment</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($reviews)): ?>
            <tr><td colspan="6">No reviews found.</td></tr>
            <?php else: ?>
                <?php foreach ($reviews as $exportReview): ?>
                <tr>
                    <td><?php echo htmlspecialchars($exportReview['reviewID'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($exportReview['tourTitle'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($exportReview['usersname'] ?? 'N/A'); ?></td>
                    <td><?php echo (int) ($exportReview['rating'] ?? 0); ?>/5</td>
                    <td><?php echo htmlspecialchars($exportReview['comment'] ?? ''); ?></td>
                    <td><?php echo !empty($exportReview['timestamp']) ? date('d/m/Y H:i', strtotime($exportReview['timestamp'])) : ''; ?></td>
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
