<?php

namespace Sirolad\Potato\Exceptions;

use PDOException;

class EmptyTableException extends PDOException
{
    public function message()
    {
        return 'The table is empty.';
    }
}