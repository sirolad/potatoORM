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
use Sirolad\Test\PotatoStub;

class PotatoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tear down all mock objects
     */
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * Test that the exact tablename is returned
    **/
    public function testTableName()
    {
        $potato = new Potato();
        $this->assertInternalType("string", $potato->tableName());
    }

    /**
     * Test delete from database
    **/
    public function testDestroy()
    {
        $mock = Mockery::mock('Sirolad\Test\PotatoStub');
        $mock->shouldReceive('destroy')->with(1)->andReturn(true);
    }

    /**
     * Test find from database
    **/
    public function testFind()
    {
        $mock = Mockery::mock('Sirolad\Test\PotatoStub');
        $mock->shouldReceive('find')->with(1)->andReturn('foo');
    }

    /**
     * Test that instantiated class are without attributes
    **/
    public function testNewInstanceCreatesInstanceWithoutAttributes()
    {
        $instance = new PotatoStub();
        $this->assertEmpty($instance->getRecord());
        $this->assertEquals(0, sizeof($instance->getRecord()));
        $this->assertEquals(0, count($instance->getRecord()));
        $this->assertArrayNotHasKey('id', $instance->getRecord());
    }

    /**
     * Test class can be instantiated
    **/
    public function save()
    {
        $mock = Mockery::mock('Sirolad\Test\PotatoStub');
        $mock->shouldReceive('save')->with(1)->andReturn(true);
    }
}
