<?php
class Database {
    public function __construct($schema_name, $schema_user, $schema_pwd) {
        $this->hostname = "localhost";
        $this->schema_name = $schema_name;
        $this->user_name = $schema_user;
        $this->user_pwd = $schema_pwd;
    }

    public $hostname;
    public $schema_name;
    public $user_name;
    public $user_pwd;

    public function get_dsn() {
        // dsn = data source name
        $dsn = "mysql:host=" . $this->hostname . ";";
        $dsn .= "dbname=" . "$this->schema_name";
        return $dsn;
    }

    public function connect() {
        try {
            $database_conn = new PDO($this->get_dsn(), $this->user_name, $this->user_pwd);
            $database_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $database_conn->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        } catch (Exception $e) {
            $error_code = $e->getMessage();
            echo $error_code . "<br>";
            exit;
        }
        return $database_conn;
    }
}

// create the actual database connection
$williamferraz_db = new Database("williamferraz_db", "root", "");
$wf_db_conn = $williamferraz_db->connect(); // establish connection
?>
