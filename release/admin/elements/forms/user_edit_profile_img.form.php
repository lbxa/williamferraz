<div class="card">
    <div class="card-block">
        <center class="m-t-30">
            <?php
                if ((is_POST()) && (isset($_POST["img_update_submit"]))) {
                    $img_tmp_server_name = $_FILES["new_user_img_file"]["tmp_name"];
                    $img_file_name       = $_FILES["new_user_img_file"]["name"];

                    // file path information --> img_repo
                    $img_dir = "img/user_profiles";
                    $file_upload_verification = is_uploaded_file($img_tmp_server_name);

                    if ($file_upload_verification == true) {
                        $file_transfer_verification = move_uploaded_file($img_tmp_server_name, $img_dir . "/" . $img_file_name);
                        $user_profile_img_handler = new User();

                        // WARNING: upload image to database using user class NOT IMAGE class
                        $update_profile_img_auth = $user_profile_img_handler->update_profile_img($_SESSION['user_id'], $img_dir . "/" . $img_file_name);
                        // WARNING: refresh session data too.
                        $_SESSION['user_profile_img'] = $img_dir . "/" . $img_file_name;
                        header('Location: ' . $_SERVER['PHP_SELF']);
                    }
                }
            ?>
            <form class="form" action="" method="POST" enctype="multipart/form-data">
                <!-- <div class="form-group">
                    <div class="profile-circle" style="background-image: url(<?php echo  $user_profile_data['user_profile_img']; ?>)"></div>
                </div> -->
                <div class="form-group">
                    <div class="col-sm-12">
                        <img src="<?php echo  $user_profile_data['user_profile_img']; ?>" alt="Preview image" id="prev_img" style="margin: auto; width: 100%;" class="profile-circle">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="file" id="img_upload" name="new_user_img_file" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-success" type="submit" name="img_update_submit">Update Profile</button>
                    </div>
                </div>
            </form>
        </center>
    </div>
</div>
