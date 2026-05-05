<?php
/**
 * Tours List View
 */
ob_start();
?>

<!-- Banner Image -->
<div class="card shadow mb-4" style="border-radius: 15px; overflow: hidden; border: none;">
    <div style="position: relative; height: 180px; background: url('../img/pexels-chaitaastic-1918291.jpg') center/cover no-repeat;">
        <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(78,115,223,0.85), rgba(54,185,204,0.75));"></div>
        <div style="position: relative; z-index: 1; height: 100%; display: flex; align-items: center; justify-content: space-between; padding: 0 2rem;">
            <div>
                <h1 class="h3 mb-1 text-white font-weight-bold"><i class="fas fa-map-marked-alt mr-2"></i>Tours Management</h1>
                <p class="text-white-50 mb-0">Manage and organize all your travel tour packages</p>
            </div>
            <a href="index.php?controller=tour&action=create" class="btn btn-light btn-sm shadow-sm">
                <i class="fas fa-plus fa-sm mr-1"></i> Add New Tour
            </a>
        </div>
    </div>
</div>

<!-- Search & Filters -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form method="GET" class="form-inline">
            <input type="hidden" name="controller" value="tour">
            <div class="form-group mr-3">
                <input type="text" name="search" class="form-control" placeholder="Search tours..." 
                       value="<?php echo htmlspecialchars($search ?? ''); ?>">
            </div>
            <button type="submit" class="btn btn-primary mr-2">
                <i class="fas fa-search"></i> Search
            </button>
            <?php if ($search): ?>
            <a href="index.php?controller=tour" class="btn btn-secondary">Clear</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<!-- Tours Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-map-marked-alt mr-2"></i>All Tours
            <span class="badge badge-primary ml-2"><?php echo count($tours); ?></span>
        </h6>
    </div>
    <div class="card-body">
        <?php if (empty($tours)): ?>
        <div class="text-center py-5">
            <i class="fas fa-map-marked-alt fa-3x text-gray-300 mb-3"></i>
            <p class="text-gray-500">No tours found.</p>
            <a href="index.php?controller=tour&action=create" class="btn btn-primary">Add First Tour</a>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%">
                <thead class="thead-light">
                    <tr>
                        <th width="80">Image</th>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Destination</th>
                        <th>Duration</th>
                        <th>Adult Price</th>
                        <th>Child Price</th>
                        <th>Qty</th>
                        <th>Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tours as $tour): ?>
                    <tr>
                        <td class="text-center">
                            <?php if (!empty($tour['firstImage'])): ?>
                                <img src="<?php echo htmlspecialchars($tour['firstImage']); ?>" 
                                     alt="Tour" 
                                     style="width: 60px; height: 45px; object-fit: cover; border-radius: 4px;">
                            <?php else: ?>
                                <div style="width: 60px; height: 45px; background: #f8f9fa; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image text-gray-300"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $tour['tourID']; ?></td>
                        <td>
                            <strong><?php echo htmlspecialchars($tour['title']); ?></strong>
                            <?php if ($tour['description']): ?>
                            <br><small class="text-muted"><?php echo htmlspecialchars(substr($tour['description'], 0, 50)); ?>...</small>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($tour['destination']); ?></td>
                        <td><?php echo htmlspecialchars($tour['duration']); ?></td>
                        <td class="text-right">$<?php echo number_format($tour['priceAdult'], 2); ?></td>
                        <td class="text-right">$<?php echo number_format($tour['priceChild'], 2); ?></td>
                        <td class="text-center"><?php echo $tour['quantity']; ?></td>
                        <td class="text-center">
                            <?php if ($tour['availability']): ?>
                            <span class="badge badge-success">Available</span>
                            <?php else: ?>
                            <span class="badge badge-secondary">Unavailable</span>
                            <?php endif; ?>
                        </td>
                        <td class="table-actions">
                            <a href="index.php?controller=tour&action=show&id=<?php echo $tour['tourID']; ?>" 
                               class="btn btn-info btn-sm" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="index.php?controller=tour&action=itinerary&id=<?php echo $tour['tourID']; ?>" 
                               class="btn btn-primary btn-sm" title="Lịch Trình">
                                <i class="fas fa-route"></i>
                            </a>
                            <a href="index.php?controller=tour&action=edit&id=<?php echo $tour['tourID']; ?>" 
                               class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="index.php?controller=tour&action=toggleAvailability&id=<?php echo $tour['tourID']; ?>" 
                               class="btn btn-secondary btn-sm" title="Toggle Status">
                                <i class="fas fa-toggle-<?php echo $tour['availability'] ? 'on' : 'off'; ?>"></i>
                            </a>
                            <a href="#" onclick="confirmDelete('index.php?controller=tour&action=delete&id=<?php echo $tour['tourID']; ?>', 'tour')" 
                               class="btn btn-danger btn-sm" title="Delete">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin.php';
?>
