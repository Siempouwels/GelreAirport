<?php

class Database
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        // Define your database connection parameters
        $db_host = 'database_server';    // Database server
        $db_name = 'GelreAirport';       // Database name
        $db_user = 'sa';                 // Database user
        $db_password = 'abc123!@#';      // Database user's password

        try {
            // Create a new PDO connection
            $this->connection = new PDO(
                'sqlsrv:Server=' . $db_host . ';Database=' . $db_name . ';ConnectionPooling=0;TrustServerCertificate=1',
                $db_user,
                $db_password
            );

            // Set PDO attributes
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Unset the sensitive password from memory
            unset($db_password);
        } catch (PDOException $e) {
            // Handle the exception gracefully
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}

