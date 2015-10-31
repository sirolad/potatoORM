<?php

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
        $dbConnMock = Mockery::mock('Sirolad\DB\DBConnect');
        $statement = Mockery::mock('\PDOStatement');
        $dbConnMock->shouldReceive('query')->with('SELECT 1 FROM cars LIMIT 1')->andReturn($statement);
        $dbConnMock->shouldReceive('query')->with('SELECT 1 FROM users LIMIT 1')->andReturn(false);
        //$this->assertTrue(TableMapper::checkTableName('cars', $dbConnMock));
        $this->assertFalse(TableMapper::checkTableName('users', $dbConnMock));
    }

    // public function testGetClassName()
    // {
    //     $this->assertInternalType("string", TableMapper::getClassName());
    // }
}
