<?php

namespace Sirolad\Potato\DB;

use Dotenv\Dotenv;

class DBConnect extends \PDO
{
    protected static $host;
    protected static $user;
    protected static $pass;
    protected static $dbport;
    protected static $dbtype;
    protected static $dbname;

    public function __construct()
    {
        self::loader();
        try {
            if (self::$dbtype === 'pgsql') {
                $conn = new PDO(self::$dbtype . 'host=' . self::$host . ';port=' . self::$port . ';dbname=' .
                 self::$dbname .';user' . self::$user . ';password=' . self::$pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->setAttribute(PDO::ATTR_PERSISTENT, false);
            } elseif (self::$dbtype === 'mysql') {
                $conn = new PDO(self::$dbtype . ':host=' . self::$host . ';dbname=' . self::$dbname .
                 ';charset=utf8mb4', self::$user, self::$pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                PDO::ATTR_PERSISTENT => false]);
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        return $conn;
    }

    public function loader()
    {
        self::loadDotenv();

        self::$host     = getEnv('DB_HOST');
        self::$user     = getEnv('DB_USERNAME');
        self::$pass     = getEnv('DB_PASSWORD');
        self::$port     = getEnv('DB_PORT');
        self::$dbname   = getEnv('DB_NAME');
        self::$dbtype   = getEnv('DB_ENGINE');
    }

    /**
     * Loads environment variables
     */
    public function loadDotenv()
    {
          $dotEnv = new Dotenv(__DIR__ . '/../../');
          $dotEnv->load();
    }
}
