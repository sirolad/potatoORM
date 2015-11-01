<?php
/**
 * @package A simple ORM that performs basic CRUD operations
 * @author Surajudeen AKANDE <surajudeen.akande@andela.com>
 * @license MIT <https://opensource.org/licenses/MIT>
 * @link http://www.github.com/andela-sakande
 * */
namespace Sirolad\Libraries;

use Sirolad\Exception;

/**
 * This class pluralizes, tokenize, make placeholders and associative array for the main class (Potato).
 * */
class Formatter
{
    /**
     * Pluralizes or singularizes inputs
     * @param string $str
     * @return string $str
     * */
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

    /**
     * Break down a delimited statement into set of string separated by comma
     *
     * @param string $str Statement to be broken down
     * @param string $delimiter Character being searched for to bring about the break down
     * @return string Comma-separated set of string
     */
    public static function tokenize($str, $delimiter)
    {
        $output = '';
        $token = strtok($str, $delimiter);
        $output .= $token;

        while ($token) {
            $token = strtok($delimiter);
            $output .= ',' .$token;
        }

        return rtrim($output, ',');
    }

    /**
     * Generate unnamed placeholders depending on the number of table fields concerned
     *
     * @param array $record Set of affected table fields
     * @return array $placeholder Sql statement placeholders for field values
     */
    public static function generateUnnamedPlaceholders(array $records)
    {
        $placeholder = [];

        foreach ($records as $record) {
            array_push($placeholder, '?');
        }

        return $placeholder;
    }

    /**
     * Create an array of elements in the format 'array_key=array_value' of the argument array supplied
     *
     * @param array $record Associative type of array
     * @return array $temp New array of elements in the format 'array_key=array_value' of the argument array supplied
     */
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
