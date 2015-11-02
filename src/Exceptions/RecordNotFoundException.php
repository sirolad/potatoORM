<?php

/**
 * @package A simple ORM that performs basic CRUD operations
 * @author Surajudeen AKANDE <surajudeen.akande@andela.com>
 * @license MIT <https://opensource.org/licenses/MIT>
 * @link http://www.github.com/andela-sakande
 * */
namespace Sirolad\Exceptions;

/**
 * Exception class for Inexistent Record
 * */
use PDOException;

class RecordNotFoundException extends PDOException
{
     /**
     * constructor class
     * */
    public function __construct()
    {
        parent::__construct('This record does not exist.');
    }

    /**
     * @return string
     * */
    public function message()
    {
        return 'Fatal Error: ' . $this->getMessage();
    }
}
