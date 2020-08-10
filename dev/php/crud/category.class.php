<?php
class Category {
    public function create($cat_title) {
        $this->cat_title = $cat_title;
    }

    public function upload() {
        GLOBAL $wf_db_conn;

        try {
            $cat_creation_handler = $wf_db_conn->prepare(
                "INSERT INTO categories (cat_title) VALUES (?);"
            );
            $cat_creation_handler->bindParam(1, $this->cat_title, PDO::PARAM_STR, 255);
            $cat_creation_handler->execute();

            $this->create_dir("../img_repo/" . $this->cat_title);

        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function search($cat_search_param=NULL) {
        GLOBAL $wf_db_conn;

        $cat_id_search_query = "SELECT * FROM categories WHERE cat_id = ?;";
        $cat_title_search_query = "SELECT * FROM categories WHERE cat_title = ?;";

        try {
            // search by either category_id or category_title
            if (is_numeric($cat_search_param)) {
                $cat_search_handler = $wf_db_conn->prepare($cat_id_search_query);
            } else {
                $cat_search_handler = $wf_db_conn->prepare($cat_title_search_query);
            }

            if ($cat_search_param === NULL) {
                $cat_search_handler->bindParam(1, $this->cat_title, PDO::PARAM_STR, 255);
            } else {
                $cat_search_handler->bindParam(1, $cat_search_param, PDO::PARAM_STR, 255);
            }

            $cat_search_handler->execute();

            while ($curr_row = $cat_search_handler->fetch(PDO::FETCH_ASSOC)) {
                $fetched_cat_id    = $curr_row["cat_id"];
                $fetched_cat_title = $curr_row["cat_title"];

                $cat_data = array(
                    "cat_id"=>$fetched_cat_id,
                    "cat_title"=>$fetched_cat_title
                );

                return $cat_data;
            }

        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function update($old_cat_id, $new_cat_title) {
        GLOBAL $wf_db_conn;

        $old_dir_name = $this->get_cat_dir_from_id($old_cat_id);
        $new_dir_name = "../img_repo/" . $new_cat_title . '/';
        $this->rename_dir($old_dir_name, $new_dir_name);

        try {
            $cat_update_handler = $wf_db_conn->prepare("
                UPDATE categories SET cat_title = ? WHERE cat_id = ?;
            ");
            $cat_update_handler->bindParam(1, $new_cat_title, PDO::PARAM_STR, 255);
            $cat_update_handler->bindParam(2, $old_cat_id, PDO::PARAM_STR, 255);
            $cat_update_handler->execute();



        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function delete($cat_deletion_param) {
        GLOBAL $wf_db_conn;

        // multi-functionlaity
        $cat_id_deletion_query = "DELETE FROM categories WHERE cat_id = ?;";
        $cat_title_deletion_query = "DELETE FROM categories WHERE cat_title = ?;";

        // delete all images in category repo
        $dir_name = $this->get_cat_dir_from_id($cat_deletion_param);
        self::delete_dir($dir_name);

        // delete all images entries in database
        $img_cat_deletion_handler = new Image();
        $cat_data = $this->search($cat_deletion_param);
        $img_cat_deletion_handler->delete_entire_cat($cat_data['cat_title']);

        try {
            if (is_numeric($cat_deletion_param)) {
                $cat_deletion_handler = $wf_db_conn->prepare($cat_id_deletion_query);
            } else {
                $cat_deletion_handler = $wf_db_conn->prepare($cat_title_deletion_query);
            }

            $cat_deletion_handler->bindParam(1, $cat_deletion_param, PDO::PARAM_STR, 255);
            $cat_deletion_handler->execute();

        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function get_all_assoc() {
        GLOBAL $wf_db_conn;

        // produces associative array
        try {
            $cat_fetch_all_handler = $wf_db_conn->query("SELECT * FROM categories;");

            $cat_data = array();
            while ($curr_row = $cat_fetch_all_handler->fetch(PDO::FETCH_ASSOC)) {
                array_push($cat_data, $curr_row["cat_title"]);
            }
            return $cat_data;

        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function display_table() {
        GLOBAL $wf_db_conn;

        try {
            $table = "<table class='table table-hover table-condensed'>";
            $table .= "<thead>";
            $table .= "<tr>";
            $table .= "<th>Id</th>";
            $table .= "<th>Category Title</th>";
            $table .= "<th>Actions</th>";
            $table .= "</tr>";
            $table .= "</thead>";
            $table .= "</tr>";
            $table .= "<tbody>";

            $cat_search_handler = $wf_db_conn->query("SELECT * FROM categories;");
            while ($curr_row = $cat_search_handler->fetch(PDO::FETCH_ASSOC)) {
                $fetched_cat_id   = $curr_row["cat_id"];
                $fetched_cat_title = $curr_row["cat_title"];
                $table .= '<tr>';
                $table .= '<td>' . $fetched_cat_id . '</td>';
                $table .= '<td>' . $fetched_cat_title . '</td>';
                $table .= "<td> <a href='categories.php?edit={$fetched_cat_id}'><i class='fal fa-edit'></i></a>";
                $table .= "&nbsp;&nbsp;&nbsp;&nbsp;";
                $table .= "<a href='categories.php?del={$fetched_cat_id}'><i class='fal fa-trash-alt'></i></a></td>";
                $table .= '</tr>';
            }

            $table .= "</tbody>";
            $table .= "</table>";

            return $table;

        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function create_dir($dir_name) {
        if (! is_dir($dir_name)) {
            if (! mkdir($dir_name, 0755, true)) {
                die ("Failed to create new category folders within img_repo");
            }
        }
    }

    public static function delete_dir($dir_name) {
        if (is_dir($dir_name)) {
            //GLOB_MARK adds a slash to directories returned
            $files = glob($dir_name . '*', GLOB_MARK);

            foreach($files as $curr_file) {
                self::delete_dir($curr_file);
            }
            rmdir($dir_name);
        } else if (is_file($dir_name)) {
            unlink($dir_name);
        }
    }

    public function rename_dir($old_name, $new_name) {
        if (is_dir($old_name)) {
            rename($old_name, $new_name);
        } else {
            return false;
        }
    }

    public function get_cat_dir_from_id($cat_id) {
        $cat_data = $this->search($cat_id);
        return $dir_name = "../img_repo/" . $cat_data['cat_title'] . '/';
    }

    protected $cat_id;
    protected $cat_title;

}
?>
