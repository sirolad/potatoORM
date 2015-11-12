<?php

/**
 * @package A simple ORM that performs basic CRUD operations
 * @author Surajudeen AKANDE <surajudeen.akande@andela.com>
 * @license MIT <https://opensource.org/licenses/MIT>
 * @link http://www.github.com/andela-sakande
 *
 */

namespace Sirolad;

use PDO;
use PDOException;
use Sirolad\DB\DBConnect;
use Sirolad\Libraries\Formatter;
use Sirolad\Libraries\TableMapper;
use Sirolad\Interfaces\PotatoInterface;
use Sirolad\Exceptions\EmptyTableException;
use Sirolad\Exceptions\RecordNotFoundException;
use Sirolad\Exceptions\TableDoesNotExistException;

/**
 * Potato is the main class which is not to be instantiated.
 * */
class Potato implements PotatoInterface
{
    /**
     * @var array Array for holding properties set with magic method __set()
     */
    protected $record = [];

    /**
     * Set property dynamically
     *
     * @param string $field Property set dynamically
     * @param string $value Value of property set dynamically
     */
    public function __set($field, $value)
    {
        $this->record[$field] = $value;
    }

    /**
     * @param string connection to class name
     * @return string table name of Called class
     */
    public function tableName()
    {
        return TableMapper::getClassName(get_called_class());
    }

    /**
     * Provide a read access to protected $record array
     *
     * @return array $record Array of variables set dynamically with method __set()
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * @return object Database connection
     */
    protected function makeDbConn()
    {
        $getConn = new DBConnect();
        return $getConn->getConnection();
    }

    /**
     * Get a distinct record from the database
     *
     * @param int $record Index of record to get
     * @return string|object
     */
    public function find($record)
    {
        return self::where('id', $record);
    }

    /**
     * Get a record in the database
     *
     * @param string $field Field name to search under
     * @param string $value Field value to search for
     * @return string|object
     */
    public function where($field, $value)
    {
        try {
            $dbConnect = self::makeDbConn();
            $sql = 'SELECT * FROM ' . self::tableName() . ' WHERE ' . $field . ' = ?';
            $query = $dbConnect->prepare($sql);
            $query->execute([$value]);
            if ($query->rowCount() > 0) {
                $found = new static;
                $found->dbData = $query->fetch(PDO::FETCH_ASSOC);

                return $found;
            } else {
                throw new RecordNotFoundException;
            }
        } catch (RecordNotFoundException $e) {
            return $e->message();
        }
        finally {
            $dbConnect = null;
        }
    }

    /**
     * Get all the records in a database table
     * @return array|object
     * @return exception
     */
    public function getAll()
    {
        try {
            $dbConn = self::makeDbConn();
            $query = $dbConn->prepare('SELECT * FROM ' . self::tableName());
            $query->execute();

            if ($query->rowCount()) {
                return json_encode($query->fetchAll(PDO::FETCH_ASSOC), JSON_FORCE_OBJECT);
            } else {
                throw new EmptyTableException;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        finally {
            $dbConn = null;
        }
    }

    /**
     * Insert or Update a record in a database table
     * @return inte
     * @return exception
     */
    public function save()
    {
        try {
            $dbConn = self::makeDbConn();

            if (isset($this->record['dbData']) && is_array($this->record['dbData'])) {
                $sql = 'UPDATE ' . $this->tableName() . ' SET ' . Formatter::tokenize(implode(',', Formatter::makeAssociativeArray($this->record)), ',') . ' WHERE id=' . $this->record['dbData']['id'];
                $query = $dbConn->prepare($sql);
                $query->execute();
            } else {
                $sql = 'INSERT INTO ' . $this->tableName() . ' (' . Formatter::tokenize(implode(',', array_keys($this->record)), ',') . ')' . ' VALUES ' . '(' . Formatter::tokenize(implode(',', Formatter::generateUnnamedPlaceholders($this->record)), ',') . ')';
                $query = $dbConn->prepare($sql);
                $query->execute(array_values($this->record));
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        } catch (RecordNotFoundException $e) {
            return $e->message();
        }
        finally {
            $dbConn = null;
        }

        return $query->rowCount();
    }

    /**
     * Delete a record from the database table
     * @param int $record Index of record to be deleted
     * @return bool|string
     * @return exception
     */
    public function destroy($record)
    {
        try {
            $dbConn = self::makeDbConn();
            $query = $dbConn->prepare('DELETE FROM ' . self::tableName($dbConn) . ' WHERE id= ' . $record);
            $query->execute();
            $check = $query->rowCount();
            if ($check) {
                return $check;
            } else {
                throw new RecordNotFoundException;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        finally {
            $dbConn = null;
        }
    }
}
