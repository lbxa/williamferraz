<?php
    if ((is_GET()) && (isset($_GET['edit']))) {
        $edit_cat_id = trim(filter_input(INPUT_GET, 'edit', FILTER_SANITIZE_NUMBER_INT));
        $curr_cat_search_handler = new Category();
        $curr_cat_contents = $curr_cat_search_handler->search($edit_cat_id);
        $curr_cat_title = $curr_cat_contents['cat_title'];
    }

    if ((is_POST()) && (isset($_POST['cat_update_submit']))) {
        $new_cat_title = $_POST['updated_cat_title'];

        $updated_cat_handler = new Category();
        $updated_cat_handler->update($cat_id, $new_cat_title);
        header('Location: ' . $_SERVER['PHP_SELF']);
    }
?>
<form class="form" action="" method="POST">
    <div class="form-group">
        <label for="cat_title">Edit Category</label>
        <input type="text" value="<?php if (isset($curr_cat_title)) {echo $curr_cat_title;} ?>" id="cat_title" class="form-control" name="updated_cat_title" required>
    </div>
    <div class="form-group">
        <button type="submit" name="cat_update_submit" class="btn btn-primary">Update Category</button>
    </div>
</form>
