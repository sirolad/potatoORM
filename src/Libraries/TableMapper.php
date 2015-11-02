<?php

/**
 * @package A simple ORM that performs basic CRUD operations
 * @author Surajudeen AKANDE <surajudeen.akande@andela.com>
 * @license MIT <https://opensource.org/licenses/MIT>
 * @link http://www.github.com/andela-sakande
 * */
namespace Sirolad\Libraries;

use PDOException;
use Sirolad\DB\DBConnect;
use Sirolad\Libraries\Formatter;
use Sirolad\Interfaces\TableMapperInterface;
use Sirolad\Exceptions\TableDoesNotExistException;

/**
 *
 */
class TableMapper implements TableMapperInterface
{
    /**
     * Check for the existence of a table in the currentt database
     *
     * @param string $table Name of table to be searched in the database
     * @param DbConnnect $dbConnect Database connection object
     * @return string Name of the table checked
     */
    public static function checkTableName($table)
    {
        try {
            $dbConnect = new DBConnect();
            $result = $dbConnect->getConnection()->query('SELECT 1 FROM ' . $table . ' LIMIT 1');
            if ($result !== false) {
                return $table;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        finally {
            $dbConnect = null;
        }
    }

    /**
     * @var array classname from class namespace
     * @return string which is in lower case
     **/
    public static function getClassName($className)
    {
        $demarcation = explode('\\', $className);
        return Formatter::decideS(strtolower($demarcation[2]));
    }

    /**
     * @var array classname from class namespace
     * @return string classname mapped to tablename
     **/
    public static function mapTableToClass($className)
    {
        return self::checkTableName(self::getClassName($className));
    }
}
