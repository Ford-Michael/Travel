<?php
require __DIR__ . '/admin/models/TourModel.php';
$model = new TourModel();
foreach ([2,3,4,5] as $tourId) {
    $tour = $model->getWithImages($tourId);
    $count = is_array($tour) && isset($tour['images']) ? count($tour['images']) : 0;
    echo 'tour=' . $tourId . ' images=' . $count . PHP_EOL;
}
