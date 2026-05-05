<?php
/**
 * Edit User View
 */
ob_start();
?>

<!-- Page Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
    <a href="index.php?controller=user" class="btn btn-secondary btn-sm shadow-sm">
        <i class="fas fa-arrow-left fa-sm mr-1"></i> Back to Users
    </a>
</div>

<!-- Edit Form -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-user-edit mr-2"></i>Edit User: <?php echo htmlspecialchars($user['usersname']); ?>
        </h6>
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?controller=user&action=update">
            <input type="hidden" name="usersID" value="<?php echo $user['usersID']; ?>">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="usersname"><strong>Username</strong> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="usersname" name="usersname" 
                               value="<?php echo htmlspecialchars($user['usersname']); ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email"><strong>Email</strong> <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password"><strong>Password</strong></label>
                        <input type="password" class="form-control" id="password" name="password" minlength="6">
                        <small class="form-text text-muted">Leave blank to keep current password</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phoneNumber"><strong>Phone Number</strong></label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" 
                               value="<?php echo htmlspecialchars($user['phoneNumber'] ?? ''); ?>">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="address"><strong>Address</strong></label>
                <textarea class="form-control" id="address" name="address" rows="3"><?php echo htmlspecialchars($user['address'] ?? ''); ?></textarea>
            </div>
            
            <hr>
            
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save mr-1"></i> Update User
                </button>
                <a href="index.php?controller=user" class="btn btn-secondary">
                    <i class="fas fa-times mr-1"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin.php';
?>
