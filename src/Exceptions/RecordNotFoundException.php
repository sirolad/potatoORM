<?php

/**
 * @package A simple ORM that performs basic CRUD operations
 * @author Surajudeen AKANDE <surajudeen.akande@andela.com>
 * @license MIT <https://opensource.org/licenses/MIT>
 * @link http://www.github.com/andela-sakande
 * */
namespace Sirolad\Exceptions;

use PDOException;

class RecordNotFoundException extends PDOException
{
    public function __construct()
    {
        parent::__construct('This record does not exist.');
    }

    public function message()
    {
        return 'Error: ' . $this->getMessage();
    }
}
