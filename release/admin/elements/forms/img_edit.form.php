<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-12">
    <?php
        $img_handler = new Image();
        $old_img_data = $img_handler->search($edited_img_id);

        if ((is_POST()) && (isset($_POST["img_upload_submit"]))) {
            $img_desc = trim(filter_input(INPUT_POST, "new_img_description", FILTER_SANITIZE_STRING));

            $new_img = new Image();
            $new_img->update($edited_img_id, $img_desc);
            include_once('elements/alerts/img-upload-success.php');
        }
    ?>
    </div>
</div>

<form class="form row" action="" method="POST" enctype="multipart/form-data">
    <div class="col-md-7 col-lg-7">
        <div class="form-group row">
            <label for="new_img_description" class="col-sm-2 col-form-label"><b>Description</b></label>
            <div class="col-sm-10">
                <textarea name="new_img_description" id="new_img_description" class="form-control" required style="height: 100px;"><?php echo $old_img_data['img_description']; ?></textarea>
            </div>
        </div>


        <div class="form-group row">
            <label for="img_description" class="col-sm-2 col-form-label"><b>Style</b></label>
            <div class="col-sm-10">
                <?php
                    $cat_data_handler = new Category();
                    $cat_data_list = $cat_data_handler->get_all_assoc();
                    foreach ($cat_data_list as $curr_cat => $value) {
                    // end PHP code block
                ?>
                <div class="form-check">
                    <input class="" type="radio" name="img_styles" id="<?php echo $cat_data_list[$curr_cat]; ?>" value="<?php echo $cat_data_list[$curr_cat]; ?>" required <?php if (strtolower($old_img_data['img_category']) === strtolower($cat_data_list[$curr_cat])) {echo 'checked';} else {echo 'disabled';} ?>>
                    <label class="form-check-label" for="<?php echo $cat_data_list[$curr_cat]; ?>">
                        <?php echo ucfirst($cat_data_list[$curr_cat]); ?>
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
                <button type="submit" name="img_upload_submit" class="btn btn-dark"><b>Update</b></button>
            </div>
        </div>

    </div>

    <div class="col-md-5 col-lg-5">
        <!-- <div class="form-group row">
            <label for="img_upload" class="col-sm-2 col-form-label"><b>Upload</b></label>
            <div class="col-sm-10">
                <input type="file" name="img_file" class="form-control" id="img_upload" required>
            </div>
        </div> -->

        <div class="form-group row">
            <label for="#" class="col-sm-2 col-form-label"><b>Preview</b></label>
            <div class="col-sm-10">
                <img src="<?php echo '../img_repo/' . $old_img_data['img_category'] . '/' . $old_img_data['img_file_name']; ?>" alt="Preview image" id="prev_img" style="margin: auto; width: 100%;" class="card">
            </div>
        </div>
    </div>
</form>
<!-- end row -->
