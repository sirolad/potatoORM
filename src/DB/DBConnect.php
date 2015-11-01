<?php
/**
 * @package A simple ORM that performs basic CRUD operations
 * @author Surajudeen AKANDE <surajudeen.akande@andela.com>
 * @license MIT <https://opensource.org/licenses/MIT>
 * @link http://www.github.com/andela-sakande
 * */

namespace Sirolad\DB;

use PDO;
use Dotenv\Dotenv;
/**
 * This class manages the database connection for PotatoORM
 * It loads environmental variables from .env file
 * It has been proven to connect with MySQL and PgSQL databases.
 * */
class DBConnect
{
    /**
     * @var string
     * */
    protected $host;
    /**
     * @var string
     * */
    protected $user;
    /**
     * @var string
     * */
    protected $pass;
    /**
     * @var integer
     * */
    protected $dbport;
    /**
     * @var string
     * */
    protected $dbtype;
    /**
     * @var string
     * */
    protected $dbname;

    /**
     * This method makes connection to the database on getting the necessary parameters.
     * @return connection to database
     * */
    public function getConnection()
    {
        $this->loader();
        try {
            if ($this->dbtype === 'pgsql') {
                $conn = new PDO($this->dbtype . ':host=' . $this->host . ';port=' . $this->dbport . ';dbname=' . $this->dbname . ';user=' . $this->user . ';password=' . $this->pass);
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

    /**
     * Loads up the database configuration options from the .env file
     */
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
     * Makes connection to the env file in the root folder
     * @return void
     */
    public function loadDotenv()
    {
        $dotEnv = new Dotenv(__DIR__.'/../..');
        $dotEnv->load();
    }
}
