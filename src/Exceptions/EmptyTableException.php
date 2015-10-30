<?php

namespace Sirolad\Exceptions;

use PDOException;

class EmptyTableException extends PDOException
{
    public function __construct()
    {
        parent::__construct('The table is empty.');
    }

    public function message()
    {
        return 'Error: ' . $this->getMessage();
    }
}
