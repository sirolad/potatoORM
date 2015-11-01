<?php

namespace Sirolad\Interfaces;

interface TableMapperInterface
{
    public static function checkTableName($table);

    public static function mapClassToTable($className);

    public static function getClassName($className);

    public static function getTableName($className);
}
