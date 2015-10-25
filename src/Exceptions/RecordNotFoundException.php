<?php

namespace Sirolad\Potato\Exceptions;

use PDOException;

class RecordNotFoundException extends PDOException
{
    public function message()
    {
        return 'This record does not exist.';
    }
}
