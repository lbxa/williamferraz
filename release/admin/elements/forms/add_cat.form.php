<?php
    if ((is_POST()) && (isset($_POST['cat_upload_submit']))) {
        $cat_title = trim(filter_input(INPUT_POST, "cat_title", FILTER_SANITIZE_STRING));

        $cat_handler = new Category();
        $cat_handler->create(strtolower($cat_title));
        $cat_handler->upload();
    }
?>
<form class="form" action="" method="POST">
    <div class="form-group">
        <label for="cat_title">Add Category</label>
        <input type="text" id="cat_title" class="form-control" name="cat_title" required>
    </div>
    <div class="form-group">
        <button type="submit" name="cat_upload_submit" class="btn btn-primary">Add Category</button>
    </div>
</form>
