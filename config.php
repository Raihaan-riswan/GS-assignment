<?php

class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'resident_database.';
    private $conn;
    private static $instance = null;

    private function __construct() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $this->conn = new mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->database
        );

        if ($this->conn->connect_error) {
            error_log('Database connection failed: ' . $this->conn->connect_error);
            throw new Exception('Database connection failed.');
        }

        $this->conn->set_charset('utf8mb4');
    }

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): mysqli {
        return $this->conn;
    }

    private function __clone() {}

    public function __wakeup() {
        throw new Exception('Cannot unserialize singleton');
    }
}

try {
    $database = Database::getInstance();
    $conn = $database->getConnection();
} catch (Exception $e) {
    die('A database error occurred. Please try again later.');
}

?>