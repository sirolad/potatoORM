<?php

/**
 * @package A simple ORM that performs basic CRUD operations
 * @author Surajudeen AKANDE <surajudeen.akande@andela.com>
 * @license MIT <https://opensource.org/licenses/MIT>
 * @link http://www.github.com/andela-sakande
 * */
namespace Sirolad\Test;

use Sirolad\Libraries\Formatter;

/**
 * Test for Formatter class
 **/
class FormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test for singularize or pluralize
     * */
    public function testdecideS()
    {
        $this->assertEquals('user', Formatter::decideS('users'));
        $this->assertEquals('cars', Formatter::decideS('car'));
        $this->assertNotEquals('cars', Formatter::decideS('cars'));
    }

    /**
     * Test for SQL query placeholders
     **/
    public function testGenerateUnnamedPlaceholders()
    {
        $this->assertEquals(['?', '?', '?', '?'], Formatter::generateUnnamedPlaceholders(['username', 'password', 'email', 'date_created']));
        $this->assertNotEquals(['?', '?', '?', '?'], Formatter::generateUnnamedPlaceholders(['username', 'password', 'email']));
    }

    /**
     * Test to tokenize values of SQL query
     * */
    public function testTokenize()
    {
        $this->assertEquals('username,password,email', Formatter::tokenize('username,password,email', ','));
    }

    /**
     * Test that SQL query is used associatively
     * */
    public function testMakeAssociativeArray()
    {
        $this->assertEquals(["token=NULL", 'token_expire="today"'], Formatter::makeAssociativeArray(['' => '', 'token' => null, 'token_expire' => 'today']));
    }
}
