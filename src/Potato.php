<?php

namespace Sirolad\Potato;

use PDOException;
use Sirolad\Potato\DB\DBConnect;
use Sirolad\Potato\Libraries\Formatter;
use Sirolad\Potato\Libraries\TableMapper;
use Sirolad\Potato\Exceptions\EmptyTableException;
use Sirolad\Potato\Exceptions\RecordNotFoundException;
use Sirolad\Potato\Exceptions\TableDoesNotExistException;

abstract class Potato
{
    protected $record = [];

    public function __set($field, $value)
    {
        $this->record[$field] = $value;
    }

    public function getRecord()
    {
        return $this->record;
    }

    protected function makeDbConn()
    {
        return new DbConnect();
    }

    public static function find($record)
    {
        return self::where('id', $record);
    }

    public static function where($field, $value)
    {
        $table = TableMapper::getTable(get_called_class());

        try {
            $dbConn = static::makeDbConn();

            $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $field . ' = ?';
            $query = $dbConn->prepare($sql);
            $query->execute([$value]);
        } catch (PDOException $e) {
            return $e->getMessage();
        } finally {
            $dbConn = null;
        }

        if ($query->rowCount()) {
            $found = new static;
            $found->dbData = $query->fetch(DbConn::FETCH_ASSOC);

            return $found;
        } else {
            throw new RecordNotFoundException;
        }
    }

    public static function getAll()
    {
        $table = TableMapper::getTable(get_called_class());

        try {
            $dbConn = static::makeDbConn();
            $query = $dbConn->prepare('SELECT * FROM ' . $table);
            $query->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        } finally {
            $dbConn = null;
        }

        if ($query->rowCount()) {
            return $query->fetchAll(DbConn::FETCH_ASSOC);
        } else {
            throw new EmptyTableException;
        }
    }

    public function save()
    {
        $table = TableMapper::getTable(get_called_class());

        try {
            $dbConn = static::makeDbConn();

            if (isset($this->record['dbData']) && is_array($this->record['dbData'])) {
                $sql = 'UPDATE ' . $table . ' SET ' . Formatter::tokenize(implode(',', Formatter::makeAssociativeArray($this->record)), ',') . ' WHERE id=' . $this->record['dbData']['id'];
                $query = $dbConn->prepare($sql);
                $query->execute();
            } else {
                $sql = 'INSERT INTO ' . $table . ' (' . Formatter::tokenize(implode(',', array_keys($this->record)), ',') . ')' . ' VALUES ' . '(' . Formatter::tokenize(implode(',', Formatter::generateUnnamedPlaceholders($this->record)), ',') . ')';
                $query = $dbConn->prepare($sql);
                $query->execute(array_values($this->record));
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        } finally {
            $dbConn = null;
        }

        return $query->rowCount();
    }

    public static function destroy($record)
    {
        $table = TableMapper::getTable(get_called_class());

        try {
            $dbConn = static::makeDbConn();
            $query = $dbConn->prepare('DELETE FROM ' . $table . ' WHERE id= ' . $record);
            $query->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        } finally {
            $dbConn = null;
        }

        $check = $query->rowCount();

        if ($check) {
            return $check;
        } else {
            throw new RecordNotFoundException;
        }
    }
}


class User extends Potato{

}

$user = new User();
$user->login = "Terryd";
$user->password = "password";
$user->age = 34;
$user->getAll();