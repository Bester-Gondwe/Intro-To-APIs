<?php 
class Database {
    private static $database_name = 'users';
    private static $database_host = 'localhost';
    private static $database_port = '3307'; // Set port to 3307
    private static $database_user = 'root'; // Replace with actual username
    private static $database_user_password = ''; // Replace with actual password
    private static $connection_status = null;

    // Prevent object instantiation
    private function __construct() {
        die('Init function is not allowed');
    }

    public static function connect() {
        if (self::$connection_status === null) {
            try {
                $dsn = 'mysql:host=' . self::$database_host . ';port=' . self::$database_port . ';dbname=' . self::$database_name . ';charset=utf8mb4';
                self::$connection_status = new PDO($dsn, self::$database_user, self::$database_user_password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                die('Database Connection Failed: ' . $e->getMessage());
            }
        }
        return self::$connection_status;
    }

    public static function disconnect() {
        self::$connection_status = null;
    }
}
?>
