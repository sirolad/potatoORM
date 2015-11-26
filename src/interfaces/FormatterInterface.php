<?php

namespace Sirolad\Interfaces;

/**
 * Interface for Formatter class
 * */
interface FormatterInterface
{
    public static function addOrRemoveS($str);

    public static function tokenize($str, $delimiter);

    public static function generateUnnamedPlaceholders(array $records);

    public static function makeAssociativeArray(array $record);
}
