<?php
namespace Sirolad\Libraries;

use Sirolad\DB\DBConnect;
use Sirolad\Libraries\Formatter;
use Sirolad\Exceptions\TableDoesNotExistException;

/**
 *
 */
class TableMapper
{

    public static function checkTableName($table)
    {
        $dbConnect = new DBConnect();
        try {
            $result = $dbConnect->getConnection()->query('SELECT 1 FROM ' . $table . ' LIMIT 1');
            if($result !== false)
            {
                return $table;
            }
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
        finally {
            $dbConn = null;
        }
    }

    public static function mapClassToTable($className)
    {
        if ($demarcation !== false) {
            $table = strtolower(substr($className, $demarcation + 1));
        }
        else {
            $table = strtolower($className);
        }

        $conn = new DBConnect();

        if (!self::checkForTable($table, $conn)) {
            $table = Formatter::decideS($table);

            if (!self::checkForTable($table, $conn)) {
                throw new TableDoesNotExistException;
            }
        }

        return $table;
    }

    public static function getClassName($className) {

        $demarcation = explode('\\', $className);

        return Formatter::decideS(strtolower($demarcation[2]));
    }

    public static function getTableName($className)
    {
        return self::checkTableName(self::getClassName($className));

    }
}
