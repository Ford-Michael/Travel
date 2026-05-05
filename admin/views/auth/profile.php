<?php ob_start(); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
</div>

<div class="row">
    <div class="col-lg-4">
        <!-- Profile Picture Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profile Picture</h6>
            </div>
            <div class="card-body text-center">
                <?php 
                    $avatarSrc = !empty($admin['avatar']) 
                        ? '../img/avatars/' . htmlspecialchars($admin['avatar']) 
                        : 'assets/img/undraw_profile.svg'; 
                ?>
                <img class="img-profile rounded-circle mb-3 border border-width-2 shadow-sm" 
                     src="<?php echo $avatarSrc; ?>" 
                     style="width: 150px; height: 150px; object-fit: cover;" 
                     alt="Admin Avatar">
                
                <div class="small font-italic text-muted mb-4">
                    Role: <span class="badge badge-primary"><?php echo htmlspecialchars(ucfirst($admin['role'] ?? 'Moderator')); ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <!-- Account Details Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Account Details</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?controller=auth&action=profile" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label font-weight-bold">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" name="username" 
                                   value="<?php echo htmlspecialchars($admin['username'] ?? ''); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label font-weight-bold">Email Address</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?php echo htmlspecialchars($admin['email'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label font-weight-bold">New Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Leave blank to keep current password">
                            <small class="form-text text-muted">Must be at least 6 characters if you want to change it.</small>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="avatar" class="col-sm-3 col-form-label font-weight-bold">Change Avatar</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="avatar" name="avatar" accept="image/*">
                                <label class="custom-file-label" for="avatar">Choose new image file...</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save mr-1"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Update file input label when a file is selected
var avatarInput = document.querySelector('.custom-file-input');
if (avatarInput) {
    avatarInput.addEventListener('change', function(e) {
        if (!document.getElementById('avatar').files.length) {
            return;
        }

        var fileName = document.getElementById('avatar').files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
}
</script>

<?php 
$content = ob_get_clean(); 
require_once __DIR__ . '/../layouts/admin.php'; 
?>
