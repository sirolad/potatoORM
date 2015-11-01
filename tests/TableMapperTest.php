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
    public function tearDown()
    {
        Mockery::close();
    }

    public function testcheckTableName()
    {
        $dbMock = Mockery::mock('Sirolad\DB\DBConnect');
        $statement = Mockery::mock('\PDOStatement');
        $dbMock->shouldReceive('query')->with('SELECT 1 FROM cars LIMIT 1')->andReturn($statement);
        $dbMock->shouldReceive('query')->with('SELECT 1 FROM users LIMIT 1')->andReturn(false);
        $this->assertTrue(TableMapper::checkTableName('cars', $dbMock));
        $this->assertFalse(TableMapper::checkTableName('users', $dbMock));
    }

    // public function testGetClassName()
    // {
    //     $this->assertInternalType("string", TableMapper::getClassName());
    // }
}
