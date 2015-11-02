<?php

/**
 * @package A simple ORM that performs basic CRUD operations
 * @author Surajudeen AKANDE <surajudeen.akande@andela.com>
 * @license MIT <https://opensource.org/licenses/MIT>
 * @link http://www.github.com/andela-sakande
 * */
namespace Sirolad\Test;

use Mockery;
use Sirolad\DB\DBConnect;
use Sirolad\Libraries\TableMapper;

class TableMapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tear down all mock objects
     */
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * Test to check the table exists
     * @return string
     * @return Exception
     * **/
    public function testcheckTableName()
    {
        $dbMock = Mockery::mock('Sirolad\DB\DBConnect');
        $statement = Mockery::mock('\PDOStatement');
        $dbMock->shouldReceive('query')->with('SELECT 1 FROM users LIMIT 1')->andReturn('string');
        $this->assertInternalType('string', (TableMapper::checkTableName('users', $dbMock)));
        $err = "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'test.motors' doesn't exist";
        $dbMock->shouldReceive('query')->with('SELECT 1 FROM motors LIMIT 1')->andReturn($err);
        $this->assertEquals($err, TableMapper::checkTableName('motors', $dbMock));
    }

    /**
     * Test to get classname from class namespace
     * */
    public function testGetClassName()
    {
        $this->assertInternalType("string", TableMapper::getClassName('Sirolad\Potato\User'));
    }

    /**
     * Test to map the table to the class
     * */
    public function testMapTableToClass()
    {
        $this->assertInternalType("string", TableMapper::mapTableToClass('Sirolad\Potato\Car'));
    }
}
