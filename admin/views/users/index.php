<?php
/**
 * Users List View
 */
ob_start();
?>

<!-- Banner Image -->
<div class="card shadow mb-4" style="border-radius: 15px; overflow: hidden; border: none;">
    <div style="position: relative; height: 180px; background: url('../img/dn.png') center/cover no-repeat;">
        <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(102,126,234,0.85), rgba(118,75,162,0.75));"></div>
        <div style="position: relative; z-index: 1; height: 100%; display: flex; align-items: center; justify-content: space-between; padding: 0 2rem;">
            <div>
                <h1 class="h3 mb-1 text-white font-weight-bold"><i class="fas fa-users mr-2"></i>Users Management</h1>
                <p class="text-white-50 mb-0">Manage all registered user accounts</p>
            </div>
            <a href="index.php?controller=user&action=create" class="btn btn-light btn-sm shadow-sm">
                <i class="fas fa-plus fa-sm mr-1"></i> Add New User
            </a>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Users</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalUsers ?? 0; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Active Users</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $activeCount ?? 0; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Inactive Users</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $inactiveCount ?? 0; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-times fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search & Filters -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form method="GET" class="form-inline">
            <input type="hidden" name="controller" value="user">
            <div class="form-group mr-3">
                <input type="text" name="search" class="form-control" placeholder="Search users..." 
                       value="<?php echo htmlspecialchars($search ?? ''); ?>">
            </div>
            <div class="form-group mr-3">
                <select name="status" class="form-control">
                    <option value="">All Status</option>
                    <option value="active" <?php echo ($currentStatus ?? '') === 'active' ? 'selected' : ''; ?>>Active</option>
                    <option value="inactive" <?php echo ($currentStatus ?? '') === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mr-2">
                <i class="fas fa-search"></i> Search
            </button>
            <?php if ($search || $currentStatus): ?>
            <a href="index.php?controller=user" class="btn btn-secondary">Clear</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<!-- Users Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-users mr-2"></i>All Users
            <span class="badge badge-primary ml-2"><?php echo count($users ?? []); ?></span>
        </h6>
    </div>
    <div class="card-body">
        <?php if (empty($users)): ?>
        <div class="text-center py-5">
            <i class="fas fa-users fa-3x text-gray-300 mb-3"></i>
            <p class="text-gray-500">No users found.</p>
            <a href="index.php?controller=user&action=create" class="btn btn-primary">Add First User</a>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th width="180">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['usersID']; ?></td>
                        <td>
                            <strong><?php echo htmlspecialchars($user['usersname']); ?></strong>
                        </td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['phoneNumber'] ?? '-'); ?></td>
                        <td class="text-center">
                            <?php if ($user['isActive']): ?>
                            <span class="badge badge-success">Active</span>
                            <?php else: ?>
                            <span class="badge badge-secondary">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td class="table-actions">
                            <a href="index.php?controller=user&action=show&id=<?php echo $user['usersID']; ?>" 
                               class="btn btn-info btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="index.php?controller=user&action=edit&id=<?php echo $user['usersID']; ?>" 
                               class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="index.php?controller=user&action=toggleStatus&id=<?php echo $user['usersID']; ?>" 
                               class="btn btn-secondary btn-sm" title="Toggle Status">
                                <i class="fas fa-toggle-<?php echo $user['isActive'] ? 'on' : 'off'; ?>"></i>
                            </a>
                            <a href="#" onclick="confirmDelete('index.php?controller=user&action=delete&id=<?php echo $user['usersID']; ?>', 'user')" 
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
