<?php

namespace Sirolad\Potato\Libraries;

use Sirolad\Potato\Exception;

class Formatter
{
    public static function decideS($str)
    {
        $tableNameAsArray = str_split($str);

        if ($tableNameAsArray[count($tableNameAsArray) - 1] === 's') {
            array_pop($tableNameAsArray);
            $str = implode($tableNameAsArray);
        } else {
            $str .= 's';
        }

        return $str;
    }

    public static function tokenize($str, $delimiter)
    {
        $output = '';
        $token = strtok($str, $delimiter);
        $output .= $token;

        while ($token) {
            $token = strtok($delimeter);
            $output .= ',' .$token;
        }

        return rtrim($output, ',');
    }


    public static function generateUnnamedPlaceholders(array $records)
    {
        $placeholder = [];

        foreach ($records as $record) {
            array_push($placeholder, '?');
        }

        return $placeholder;
    }

    public static function makeAssociativeArray(array $record)
    {
        $temp = [];
        for ($i = 1; $i < count($record); $i++) {
            $value = array_values($record)[$i];

            if (is_null($value)) {
                $value = 'NULL';
            } else {
                $value = '"' . $value . '"';
            }

            array_push($temp, array_keys($record)[$i] . '=' . $value);
        }
        return $temp;
    }
}
