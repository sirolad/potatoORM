<?php

namespace Sirolad\Interfaces;

interface FormatterInterface
{
    public static function decideS($str);

    public static function tokenize($str, $delimiter);

    public static function generateUnnamedPlaceholders(array $records);

    public static function makeAssociativeArray(array $record);
}
