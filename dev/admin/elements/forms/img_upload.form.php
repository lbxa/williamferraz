<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-12">
    <?php
        if ((is_POST()) && (isset($_POST["img_upload_submit"]))) {
            $img_tmp_server_name = $_FILES["img_file"]["tmp_name"];
            $img_file_name       = $_FILES["img_file"]["name"];
            $img_category        = $_POST["img_styles"];
            $img_date            = date("Y-m-d");
            $img_desc = trim(filter_input(INPUT_POST, "img_description", FILTER_SANITIZE_STRING));

            // file path information --> img_repo
            $img_dir = "../img_repo/";
            $file_upload_verification = is_uploaded_file($img_tmp_server_name);

            if ($file_upload_verification == true) {
                $file_transfer_verification = move_uploaded_file($img_tmp_server_name, $img_dir . $img_category . "/" . $img_file_name);
                $new_img = new Image();
                $new_img->create($img_file_name, $img_desc, $img_date, $img_category);
                $new_img->upload();
                include_once('elements/alerts/img-upload-success.php');
            } else {
                include_once('elements/alerts/img-upload-failure.php');
            }
        }
    ?>
    </div>
</div>

<form class="form row" action="" method="POST" enctype="multipart/form-data">
    <div class="col-md-7 col-lg-7">
        <div class="form-group row">
            <label for="img_description" class="col-sm-2 col-form-label"><b>Description</b></label>
            <div class="col-sm-10">
                <textarea name="img_description" id="img_description" class="form-control" required style="height: 100px;"></textarea>
            </div>
        </div>


        <div class="form-group row">
            <label for="img_description" class="col-sm-2 col-form-label"><b>Style</b></label>
            <div class="col-sm-10">
                <?php
                    $cat_data_handler = new Category();
                    $cat_data_list = $cat_data_handler->get_all_assoc();
                    foreach ($cat_data_list as $key => $value) {
                    // end PHP code block
                ?>
                <div class="form-check">
                    <input class="" type="radio" name="img_styles" id="<?php echo $cat_data_list[$key]; ?>" value="<?php echo $cat_data_list[$key]; ?>" required>
                    <label class="form-check-label" for="<?php echo $cat_data_list[$key]; ?>">
                        <?php echo ucfirst($cat_data_list[$key]); ?>
                    </label>
                </div>
                <?php
                    // continue PHP code block
                    }
                ?>
            </div>
        </div>


        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" name="img_upload_submit" class="btn btn-dark"><b>Upload</b></button>
            </div>
        </div>

    </div>

    <div class="col-md-5 col-lg-5">
        <div class="form-group row">
            <label for="img_upload" class="col-sm-2 col-form-label"><b>Upload</b></label>
            <div class="col-sm-10">
                <input type="file" name="img_file" class="form-control" id="img_upload" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="#" class="col-sm-2 col-form-label"><b>Preview</b></label>
            <div class="col-sm-10">
                <img src="../img/misc/content-placeholder.png" alt="Preview image" id="prev_img" style="margin: auto; width: 100%;" class="card">
            </div>
        </div>
    </div>
</form>
<!-- end row -->
