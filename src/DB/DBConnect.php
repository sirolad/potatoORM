<?php
namespace Sirolad\Potato\DB;

use PDO;
use Dotenv\Dotenv;

class DBConnect
{
    protected $host;
    protected $user;
    protected $pass;
    protected $dbport;
    protected $dbtype;
    protected $dbname;

    public function getConnection()
    {
        $this->loader();
        try {
            if ($this->dbtype === 'pgsql') {
                $conn = new PDO($this->dbtype . 'host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbname . ';user' . $this->user . ';password=' . $this->pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->setAttribute(PDO::ATTR_PERSISTENT, false);
            } elseif ($this->dbtype === 'mysql') {
                $conn = new PDO($this->dbtype . ':host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8mb4', $this->user, $this->pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                PDO::ATTR_PERSISTENT => false]);
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }

        return $conn;
    }

    public function loader()
    {
        $this->loadDotenv();
        $this->host = getenv('DB_HOST');
        $this->user = getenv('DB_USERNAME');
        $this->pass = getenv('DB_PASSWORD');
        $this->dbport = getenv('DB_PORT');
        $this->dbname = getenv('DB_DATABASE');
        $this->dbtype = getenv('DB_ENGINE');
    }

    /**
     * Loads environment variables
     */
    public function loadDotenv()
    {
        $dotEnv = new Dotenv($_SERVER['DOCUMENT_ROOT']);
        $dotEnv->load();
    }
}
