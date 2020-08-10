<?php
class Inquiry {
    public function create($inquiry_name, $inquiry_contact, $inquiry_details, $inquiry_date) {
        $this->inquiry_name = $inquiry_name;
        $this->inquiry_contact = $inquiry_contact;
        $this->inquiry_details = $inquiry_details;
        $this->inquiry_date = $inquiry_date;
    }

    public function upload() {
        GLOBAL $wf_db_conn;

        try {
            $inquiry_creation_handler = $wf_db_conn->prepare(
                "INSERT INTO inquiries (inquiry_name, inquiry_contact, inquiry_details, inquiry_date) VALUES (?, ?, ?, ?);"
            );
            $inquiry_creation_handler->bindParam(1, $this->inquiry_name, PDO::PARAM_STR, 250);
            $inquiry_creation_handler->bindParam(2, $this->inquiry_contact, PDO::PARAM_STR, 250);
            $inquiry_creation_handler->bindParam(3, $this->inquiry_details, PDO::PARAM_STR, 2000);
            $inquiry_creation_handler->bindParam(4, $this->inquiry_date, PDO::PARAM_STR, 10);
            $inquiry_creation_handler->execute();
        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }

    }

    public function search($inquiry_contact_name = NULL) {
        GLOBAL $wf_db_conn;

        try {
            $inquiry_search_handler = $wf_db_conn->prepare("
                SELECT * FROM inquiries WHERE inquiry_contact = ?;
            ");

            if ($inquiry_contact_name == NULL) {
                $inquiry_search_handler->bindParam(1, $this->inquiry_contact, PDO::PARAM_STR, 250);
            } else {
                $inquiry_search_handler->bindParam(1, $inquiry_contact_name, PDO::PARAM_STR, 250);
            }

            $inquiry_search_handler->execute();

            // read in array retrieved
            while ($curr_row = $inquiry_search_handler->fetch(PDO::FETCH_ASSOC)) {
                $fetched_inquiry_id      = $curr_row["inquiry_id"];
                $fetched_inquiry_name    = $curr_row["inquiry_name"];
                $fetched_inquiry_contact = $curr_row["inquiry_contact"];
                $fetched_inquiry_details = $curr_row["inquiry_details"];
                $fetched_inquiry_date    = $curr_row["inquiry_date"];

                $inquiry_data = array(
                    "inquiry_id"=>$fetched_inquiry_id,
                    "inquiry_name"=>$fetched_inquiry_name,
                    "inquiry_contact"=>$fetched_inquiry_contact,
                    "inquiry_details"=>$fetched_inquiry_details,
                    "inquiry_date"=>$fetched_inquiry_date
                );

                return $inquiry_data;
            }

        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function delete($inquiry_id) {
        GLOBAL $wf_db_conn;

        try {
            $inquiry_deletion_handler = $wf_db_conn->prepare("
                DELETE FROM inquiries WHERE inquiry_id = ?;
            ");

            $inquiry_deletion_handler->bindParam(1, $inquiry_id, PDO::PARAM_INT);
            $inquiry_deletion_handler->execute();

        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function get_inquiry_count() {
        GLOBAL $wf_db_conn;

        try {
            $query = "SELECT COUNT(*) FROM inquiries;";
            $inquiry_count_handler = $wf_db_conn->query($query);

            $inquiry_count = '';
            while($curr_row = $inquiry_count_handler->fetch(PDO::FETCH_ASSOC)) {
                // array[0] => {COUNT(*) => x}
                $inquiry_count = $curr_row['COUNT(*)'];
            }

            return $inquiry_count;

        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    public function get_all() {
        GLOBAL $wf_db_conn;

        try {
            $inquiry_search_handler = $wf_db_conn->query("SELECT * FROM inquiries ORDER BY inquiry_date DESC;");
            return $inquiry_search_handler->fetchAll();
        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
    }

    protected $inquiry_name;
    protected $inquiry_contact;
    protected $inquiry_details;
    protected $inquiry_date;

}
?>
