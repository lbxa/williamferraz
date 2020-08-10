<?php
class User {
    public function create($user_name, $user_pwd, $user_first_name, $user_last_name,
                           $user_email, $user_profile_img, $user_type) {

        $this->user_name = $user_name;
        $this->user_pwd = $user_pwd;
        $this->user_first_name = $user_first_name;
        $this->user_last_name = $user_last_name;
        $this->user_email = $user_email;
        $this->user_profile_img = $user_profile_img;
        $this->user_type = $user_type;
        $this->user_date_joined = date("Y-m-d");
    }

    public function upload() {
        GLOBAL $wf_db_conn;

        try {
            $user_creation_handler = $wf_db_conn->prepare(
                "INSERT INTO users (user_name, user_pwd, user_first_name, user_last_name, user_email,
                                    user_profile_img, user_type, user_date_joined) VALUES (?, ?, ?, ?, ?, ?, ?, ?);"
            );
            $user_creation_handler->bindParam(1, $this->user_name, PDO::PARAM_STR, 255);
            $user_creation_handler->bindParam(2, $this->user_pwd, PDO::PARAM_STR, 255);
            $user_creation_handler->bindParam(3, $this->user_first_name, PDO::PARAM_STR, 255);
            $user_creation_handler->bindParam(4, $this->user_last_name, PDO::PARAM_STR, 255);
            $user_creation_handler->bindParam(5, $this->user_email, PDO::PARAM_STR, 255);
            $user_creation_handler->bindParam(6, $this->user_profile_img, PDO::PARAM_STR, 2000);
            $user_creation_handler->bindParam(7, $this->user_type, PDO::PARAM_STR, 255);
            $user_creation_handler->bindParam(8, $this->user_date_joined, PDO::PARAM_STR, 10);
            $user_creation_handler->execute();
        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function search($user_name_param=NULL, $user_pwd_param=NULL) {
        GLOBAL $wf_db_conn;

        try {
            $user_search_handler = $wf_db_conn->prepare("
                SELECT * FROM users WHERE user_name = ? AND user_pwd = ?;
            ");

            if (($user_name_param === NULL) || ($user_pwd_param === NULL)) {
                $user_search_handler->bindParam(1, $this->user_name, PDO::PARAM_STR, 255);
                $user_search_handler->bindParam(2, $this->user_pwd, PDO::PARAM_STR, 255);
            } else {
                $user_search_handler->bindParam(1, $user_name_param, PDO::PARAM_STR, 255);
                $user_search_handler->bindParam(2, $user_pwd_param, PDO::PARAM_STR, 255);
            }

            $user_search_handler->execute();

            while ($curr_row = $user_search_handler->fetch(PDO::FETCH_ASSOC)) {
                $fetched_user_id          = $curr_row["user_id"];
                $fetched_user_name        = $curr_row["user_name"];
                $fetched_user_pwd         = $curr_row["user_pwd"];
                $fetched_user_first_name  = $curr_row["user_first_name"];
                $fetched_user_last_name   = $curr_row["user_last_name"];
                $fetched_user_email       = $curr_row["user_email"];
                $fetched_user_profile_img = $curr_row["user_profile_img"];
                $fetched_user_type        = $curr_row["user_type"];
                $fetched_user_date_joined = $curr_row["user_date_joined"];

                $user_data = array(
                    "user_id"=>$fetched_user_id,
                    "user_name"=>$fetched_user_name,
                    "user_pwd"=>$fetched_user_pwd,
                    "user_first_name"=>$fetched_user_first_name,
                    "user_last_name"=>$fetched_user_last_name,
                    "user_email"=>$fetched_user_email,
                    "user_profile_img"=>$fetched_user_profile_img,
                    "user_type"=>$fetched_user_type,
                    "user_date_joined"=>$fetched_user_date_joined
                );

                return $user_data;
            }

        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function update($old_user_id, $new_user_data) {
        GLOBAL $wf_db_conn;

        try {
            $user_update_handler = $wf_db_conn->prepare("
                UPDATE users SET user_name = ?,
                                 user_pwd = ?,
                                 user_first_name = ?,
                                 user_last_name = ?,
                                 user_email = ?,
                                 user_date_joined = ?
                WHERE user_id = ?;
            ");
            $user_update_handler->bindParam(1, $new_user_data['user_name'], PDO::PARAM_STR, 255);
            $user_update_handler->bindParam(2, $new_user_data['user_pwd'], PDO::PARAM_STR, 255);
            $user_update_handler->bindParam(3, $new_user_data['user_first_name'], PDO::PARAM_STR, 255);
            $user_update_handler->bindParam(4, $new_user_data['user_last_name'], PDO::PARAM_STR, 255);
            $user_update_handler->bindParam(5, $new_user_data['user_email'], PDO::PARAM_STR, 255);
            $user_update_handler->bindParam(6, $new_user_data['user_date_joined'], PDO::PARAM_STR, 10);
            $user_update_handler->bindParam(7, $old_user_id, PDO::PARAM_STR, 255);
            $user_update_handler->execute();
        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function get_user_count() {
        GLOBAL $wf_db_conn;

        try {
            $query = "SELECT COUNT(*) FROM users;";
            $user_count_handler = $wf_db_conn->query($query);

            $user_count = '';
            while($curr_row = $user_count_handler->fetch(PDO::FETCH_ASSOC)) {
                // array[0] => {COUNT(*) => x}
                $user_count = $curr_row['COUNT(*)'];
            }

            return $user_count;

        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function update_profile_img($user_id, $new_user_profile_img) {
        GLOBAL $wf_db_conn;

        try {
            $user_update_handler = $wf_db_conn->prepare("
                UPDATE users SET user_profile_img = ? WHERE user_id = ?;
            ");
            $user_update_handler->bindParam(1, $new_user_profile_img, PDO::PARAM_STR, 2000);
            $user_update_handler->bindParam(2, $user_id, PDO::PARAM_STR, 255);
            $user_update_handler->execute();
        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function get_admin_data() {
        GLOBAL $wf_db_conn;

        try {
            $search_query = "SELECT * FROM users WHERE user_type = 'admin';";
            $admin_search_handler = $wf_db_conn->query($search_query);

            return $admin_search_handler->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function login() {
        // do some shit
    }

    protected $user_id;
    protected $user_name;
    protected $user_pwd;
    protected $user_first_name;
    protected $user_last_name;
    protected $user_email;
    protected $user_profile_img;
    protected $user_type;
    protected $user_date_joined;

}
?>
