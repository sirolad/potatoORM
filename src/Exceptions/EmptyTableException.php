<?php

/**
 * @package A simple ORM that performs basic CRUD operations
 * @author Surajudeen AKANDE <surajudeen.akande@andela.com>
 * @license MIT <https://opensource.org/licenses/MIT>
 * @link http://www.github.com/andela-sakande
 * */

namespace Sirolad\Exceptions;

use PDOException;

/**
 * Exception class for Empty Table
 * */
class EmptyTableException extends PDOException
{
     /**
     * constructor class
     * */
    public function __construct()
    {
        parent::__construct('The table is empty.');
    }

    /**
     * @return string
     * */
    public function message()
    {
        return 'Fatal Error: ' . $this->getMessage();
    }
}
