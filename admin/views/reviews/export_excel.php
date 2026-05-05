<?php
/**
 * Reviews Excel Export
 */
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reviews Report</title>
</head>
<body>
    <table border="1">
        <tr>
            <th colspan="6" style="font-size:16px;font-weight:bold;text-align:center;">Reviews Report</th>
        </tr>
        <tr>
            <td colspan="6">Generated at: <?php echo date('d/m/Y H:i:s'); ?></td>
        </tr>
        <tr style="font-weight:bold;background:#ddebf7;">
            <th>ID</th>
            <th>Tour</th>
            <th>Customer</th>
            <th>Email</th>
            <th>Rating</th>
            <th>Comment</th>
        </tr>
        <?php if (empty($reviews)): ?>
        <tr><td colspan="6">No reviews found.</td></tr>
        <?php else: ?>
            <?php foreach ($reviews as $exportReview): ?>
            <tr>
                <td><?php echo htmlspecialchars($exportReview['reviewID'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($exportReview['tourTitle'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($exportReview['usersname'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($exportReview['userEmail'] ?? 'N/A'); ?></td>
                <td><?php echo (int) ($exportReview['rating'] ?? 0); ?></td>
                <td><?php echo htmlspecialchars($exportReview['comment'] ?? ''); ?></td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>
