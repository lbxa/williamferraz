<?php
if ((is_POST()) && (isset($_POST['user_update_submit']))) {
    $updated_user_data = array();
    $updated_user_data['user_name']        = trim(filter_input(INPUT_POST, 'new_user_name', FILTER_SANITIZE_STRING));
    $updated_user_data['user_pwd']         = trim(filter_input(INPUT_POST, 'new_user_pwd', FILTER_SANITIZE_STRING));
    $updated_user_data['user_first_name']  = trim(filter_input(INPUT_POST, 'new_user_first_name', FILTER_SANITIZE_STRING));
    $updated_user_data['user_last_name']   = trim(filter_input(INPUT_POST, 'new_user_last_name', FILTER_SANITIZE_STRING));
    $updated_user_data['user_email']       = trim(filter_input(INPUT_POST, 'new_user_email', FILTER_SANITIZE_STRING));
    $updated_user_data['user_date_joined'] = trim(filter_input(INPUT_POST, 'new_user_date_joined', FILTER_SANITIZE_STRING));

    $user_id = $_SESSION['user_id'];
    $updated_user_profile = new User();
    $updated_user_auth = $updated_user_profile->update($user_id, $updated_user_data);

    // refresh session after update (refactor later)
    $_SESSION['user_name']        = $updated_user_data['user_name'];
    $_SESSION['user_pwd']         = $updated_user_data['user_pwd'];
    $_SESSION['user_first_name']  = $updated_user_data['user_first_name'];
    $_SESSION['user_last_name']   = $updated_user_data['user_last_name'];
    $_SESSION['user_email']       = $updated_user_data['user_email'];
    $_SESSION['user_date_joined'] = $updated_user_data['user_date_joined'];

    header('Location: ' . $_SERVER['PHP_SELF']);
}

?>

<!-- Column -->
<div class="col-lg-8 col-xlg-9 col-md-7">
    <div class="card">
        <div class="card-block">
            <form class="form-horizontal form-material" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label class="col-md-12">User Name</label>
                    <div class="col-md-12">
                        <input type="text" name="new_user_name" class="form-control form-control-line" value="<?php echo (isset($user_profile_data['user_name']) ? $user_profile_data['user_name']:''); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Password</label>
                    <div class="col-md-12">
                        <input type="password" name="new_user_pwd"  class="form-control form-control-line" value="<?php echo (isset($user_profile_data['user_pwd']) ? $user_profile_data['user_pwd']:''); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">First Name</label>
                    <div class="col-md-12">
                        <input type="text" name="new_user_first_name" class="form-control form-control-line" value="<?php echo (isset($user_profile_data['user_first_name']) ? $user_profile_data['user_first_name']:''); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Last Name</label>
                    <div class="col-md-12">
                        <input type="text"  name="new_user_last_name" class="form-control form-control-line" value="<?php echo (isset($user_profile_data['user_last_name']) ? $user_profile_data['user_last_name']:''); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-email" class="col-md-12">Email</label>
                    <div class="col-md-12">
                        <input type="email" name="new_user_email" class="form-control form-control-line" id="example-email" value="<?php echo (isset($user_profile_data['user_email']) ? $user_profile_data['user_email']:''); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Date Joined</label>
                    <div class="col-md-12">
                        <input type="date" name="new_user_date_joined" class="form-control form-control-line" value="<?php echo (isset($user_profile_data['user_date_joined']) ? $user_profile_data['user_date_joined']:''); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success" name="user_update_submit">Update Profile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Column -->
