<?php


namespace Sirolad\Potato\Exceptions;

use PDOException;

class TableDoesNotExistException extends PDOException
{
    /**
     * Handle encounter with non-existent table
     *
     * @return string
     */
    public function message()
    {
        return 'Table does not exist!!! Create a table with the name of the corresponding class in lowercase or with first character uppercase. Feel free to pluralize the name, but plurals of irregular nouns are not supported.';
    }
}
