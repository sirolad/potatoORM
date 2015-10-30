<?php

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
