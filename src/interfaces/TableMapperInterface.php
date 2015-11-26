<?php

namespace Sirolad\Interfaces;

/**
 * Interface for TableMapper class
 * */
interface TableMapperInterface
{
    public static function checkTableName($table);

    public static function mapTableToClass($className);

    public static function getClassName($className);
}
