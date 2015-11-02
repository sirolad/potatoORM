<?php

/**
 * @package A simple ORM that performs basic CRUD operations
 * @author Surajudeen AKANDE <surajudeen.akande@andela.com>
 * @license MIT <https://opensource.org/licenses/MIT>
 * @link http://www.github.com/andela-sakande
 * */
namespace Sirolad\Test;

use Mockery;
use Sirolad\Potato;
use Sirolad\DB\DBConnect;
use Sirolad\Libraries\Formatter;
use Sirolad\Libraries\TableMapper;
use Sirolad\Exceptions\EmptyTableException;
use Sirolad\Exceptions\RecordNotFoundException;

class PotatoTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {

    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testTableName()
    {
        $this->assertInternalType("string", Potato::tableName('Sirolad\Potato\User'));
    }

    // public function testGetRecord()
    // {
    //     $this->assertInternalType('object', Potato::getRecord());
    // }

    public function testFind()
    {
        // $dbMock = Mockery::mock('Sirolad\DB\DBConnect');
        // $statement = Mockery::mock('\PDOStatement');
        // $dbMock->shouldReceive('query')->with('SELECT * FROM users LIMIT 1')->andReturn('array');
        // // $this->assertInternalType('string', (TableMapper::checkTableName('users', $dbMock)));
        // $this->assertJson(expectedJson, 'message');
        $m = Potato::getAll();
    }

    // public function testWhere()
    // {
    //     $m = Potato::where('id', 1);
    //     $d = Potato::find(4);
    // }
    // public function testGetAllException()
    // {
    //     $this->setExpectedException('Sirolad\Exceptions\EmptyTableException');
    //     $this->assertTrue(Potato::getAll());
    // }

    public function testGetAll()
    {
        $dbMock = Mockery::mock('Sirolad\Potato');
        $statement = Mockery::mock('\PDOStatement');
        $dbMock->shouldReceive('query')->with('SELECT * FROM users LIMIT 1')->andReturn('array');
        $this->assertInternalType('array', (Potato::getAll()));
        // $err = "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'test.motors' doesn't exist";
        // $dbMock->shouldReceive('query')->with('SELECT 1 FROM motors LIMIT 1')->andReturn($err);
        // $this->assertEquals($err, TableMapper::checkTableName('motors', $dbMock));
    }
}
