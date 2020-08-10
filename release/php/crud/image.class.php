<?php
class Image {
    public function create($img_file_name, $img_desc, $img_date, $img_category) {
        $this->img_file_name = $img_file_name;
        $this->img_desc = $img_desc;
        $this->img_date = $img_date;
        $this->img_category = $img_category;
    }

    public function upload() {
        GLOBAL $wf_db_conn;

        try {
            $img_creation_handler = $wf_db_conn->prepare(
                "INSERT INTO images (img_file_name, img_description, img_date, img_category, img_status) VALUES (?, ?, ?, ?, ?);"
            );
            $img_creation_handler->bindParam(1, $this->img_file_name, PDO::PARAM_STR, 250);
            $img_creation_handler->bindParam(2, $this->img_desc, PDO::PARAM_STR, 750);
            $img_creation_handler->bindParam(3, $this->img_date, PDO::PARAM_STR, 10);
            $img_creation_handler->bindParam(4, $this->img_category, PDO::PARAM_STR, 250);
            $img_creation_handler->bindParam(5, $this->img_status, PDO::PARAM_STR, 250);
            $img_creation_handler->execute();
        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }

    }

    public function search($img_search_param=NULL) {
        GLOBAL $wf_db_conn;

        $img_id_seach_query = "SELECT * FROM images WHERE img_id = ?";
        $img_file_name_seach_query = "SELECT * FROM images WHERE img_file_name = ?";

        try {
            if (is_numeric($img_search_param)) {
                $img_search_handler = $wf_db_conn->prepare($img_id_seach_query);
            } else {
                $img_search_handler = $wf_db_conn->prepare($img_file_name_seach_query);
            }

            if ($img_search_param == NULL) {
                $img_search_handler->bindParam(1, $this->img_file_name, PDO::PARAM_STR, 255);
            } else {
                $img_search_handler->bindParam(1, $img_search_param, PDO::PARAM_STR, 255);
            }

            $img_search_handler->execute();

            // read in array retrieved
            while ($curr_row = $img_search_handler->fetch(PDO::FETCH_ASSOC)) {
                $fetched_img_id           = $curr_row["img_id"];
                $fetched_img_file_name    = $curr_row["img_file_name"];
                $fetched_img_description  = $curr_row["img_description"];
                $fetched_img_date         = $curr_row["img_date"];
                $fetched_img_category     = $curr_row["img_category"];

                $img_data = array(
                    "img_id"=>$fetched_img_id,
                    "img_file_name"=>$fetched_img_file_name,
                    "img_description"=>$fetched_img_description,
                    "img_date"=>$fetched_img_date,
                    "img_category"=>$fetched_img_category
                );

                return $img_data;
            }

        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function update($old_img_id, $new_img_desc) {
        GLOBAL $wf_db_conn;

        try {
            $img_update_handler = $wf_db_conn->prepare("
                UPDATE images SET img_description = ? WHERE img_id = ?;
            ");

            $img_update_handler->bindParam(1, $new_img_desc, PDO::PARAM_STR, 750);
            $img_update_handler->bindParam(2, $old_img_id, PDO::PARAM_INT);
            $img_update_handler->execute();

        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function delete($img_id=NULL) {
        GLOBAL $wf_db_conn;

        // delete from img_repo
        $this->delete_img_file($img_id);

        try {
            $img_deletion_handler = $wf_db_conn->prepare("
                DELETE FROM images WHERE img_id = ?;
            ");

            $img_deletion_handler->bindParam(1, $img_id, PDO::PARAM_INT);
            $img_deletion_handler->execute();

        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function get_img_count() {
        GLOBAL $wf_db_conn;

        try {
            $query = "SELECT COUNT(*) FROM images;";
            $img_count_handler = $wf_db_conn->query($query);

            $img_count = '';
            while($curr_row = $img_count_handler->fetch(PDO::FETCH_ASSOC)) {
                // array[0] => {COUNT(*) => x}
                $img_count = $curr_row['COUNT(*)'];
            }

            return $img_count;

        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function get_active_imgs($img_limit=4) {
        // @display active imgs in index carousel
        GLOBAL $wf_db_conn;

        try {
            $search_query = "SELECT * FROM images WHERE img_status = 'active' LIMIT ?;";
            $active_img_handler = $wf_db_conn->prepare($search_query);
            $active_img_handler->bindParam(1, $img_limit, PDO::PARAM_INT);
            $active_img_handler->execute();

            return $active_img_handler->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function get_entire_cat_imgs($cat_title=NULL) {

        GLOBAL $wf_db_conn;

        try {
            $img_cat_search_handler = $wf_db_conn->prepare("
                SELECT * FROM images WHERE img_category = ?;
            ");

            if ($cat_title === NULL) {
                $img_cat_search_handler->bindParam(1, $this->img_category, PDO::PARAM_STR, 255);
            } else {
                $img_cat_search_handler->bindParam(1, $cat_title, PDO::PARAM_STR, 255);
            }

            $img_cat_search_handler->execute();
            return $img_cat_search_handler->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function check_if_img_active($img_id) {
        GLOBAL $wf_db_conn;

        try {
            $check_img_handler = $wf_db_conn->prepare("
                SELECT img_status FROM images WHERE img_id = ?;
            ");
            $check_img_handler->bindParam(1, $img_id, PDO::PARAM_STR, 255);
            $check_img_handler->execute();

            $img_result = $check_img_handler->fetchAll(PDO::FETCH_ASSOC);
            $img_state = '';

            foreach($img_result as $img) {
                $img_state = $img['img_status'];
            }

            if ($img_state == 'active') {
                return true;
            } else {
                return false;
            }

        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function toggle_img_status($img_id) {
        GLOBAL $wf_db_conn;
        $active_img_status = 'active';
        $default_img_status = 'none';

        $img_status = $this->check_if_img_active($img_id);

        try {
            $img_activation_handler = $wf_db_conn->prepare("
                UPDATE images SET img_status = ? WHERE img_id = ?;
            ");
            if ($img_status === true) {
                $img_activation_handler->bindParam(1, $default_img_status, PDO::PARAM_STR, 255);
            } else {
                $img_activation_handler->bindParam(1, $active_img_status, PDO::PARAM_STR, 255);
            }
            $img_activation_handler->bindParam(2, $img_id, PDO::PARAM_INT);
            $img_activation_handler->execute();
        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }

    }

    public function delete_entire_cat($cat_title=NULL) {
        GLOBAL $wf_db_conn;

        try {
            $img_deletion_handler = $wf_db_conn->prepare("
                DELETE FROM images WHERE img_category = ?;
            ");

            if ($cat_title === NULL) {
                $img_deletion_handler->bindParam(1, $this->img_category, PDO::PARAM_STR, 2000);
            } else {
                $img_deletion_handler->bindParam(1, $cat_title, PDO::PARAM_STR, 2000);
            }

            $img_deletion_handler->execute();

        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function delete_img_file($img_id) {
        $img_data = $this->search($img_id);
        $img_file_location = "../img_repo/" . $img_data['img_category']  . '/' . $img_data['img_file_name'];
        if (file_exists($img_file_location)) {
            unlink($img_file_location);
            return true;
        }
        return false;
    }

    protected $img_file_name;
    protected $img_desc;
    protected $img_date;
    protected $img_category;
    protected $img_status = 'none';
}
?>
