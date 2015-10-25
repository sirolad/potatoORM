<?php

namespace Sirolad\Potato\Libraries;

use Sirolad\Potato\Libraries\Formatter;
use Sirolad\Potato\DB\DBConnect;

/**
*
*/
class TableMapper
{
    public static function checkForTable($table, DbConn $dbConn)
    {
        try {
            $result = $dbConn->query('SELECT 1 FROM ' . $table . ' LIMIT 1');
        } catch (\PDOException $e) {
            return false;
        } finally {
            $dbConn = null;
        }

        return $result !== false;
    }

    public static function mapClassToTable($className)
    {
        $demarcation = strrpos($className, '\\', -1);

        if ($demarcation !== false) {
            $table = strtolower(substr($className, $demarcation + 1));
        } else {
            $table = strtolower($className);
        }

        $dbConn = new DbConnect;

        if ($table == 'user' || (! self::checkForTable($table, $dbConn))) {
            $table = self::decideS($table);

            if (! self::checkForTable($table, $dbConn)) {
                throw new TableDoesNotExistException;
            }
        }

        return $table;
    }

    public static function getTable($className)
    {
        try {
            $table = self::mapClassToTable($className);
        } catch (TableDoesNotExistException $e) {
            return $e->message();
        }

        return $table;
    }
}
