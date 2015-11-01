<?php
/**
 * @package A simple ORM that performs basic CRUD operations
 * @author Surajudeen AKANDE <surajudeen.akande@andela.com>
 * @license MIT <https://opensource.org/licenses/MIT>
 * @link http://www.github.com/andela-sakande
 * */
namespace Sirolad\Exceptions;

use PDOException;

class TableDoesNotExistException extends PDOException
{
    public function __construct()
    {
        parent::__construct('Table does not exist!!! Create a table with the name of the corresponding class in lowercase or with first character uppercase. Feel free to pluralize the name, but plurals of
            irregular nouns are not supported.');
    }
    /**
     * Handle encounter with non-existent table
     *
     * @return string
     */
    public function message()
    {
        return 'Error: ' . $this->getMessage();
    }
}
