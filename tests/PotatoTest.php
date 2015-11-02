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
        $this->assertInternalType("string", Potato::tableName('Sirolad\Potato\User'));
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
    public function testinstanceCanBeCreated()
    {
        $instance = new PotatoStub();
        $instance->name = "Twale";
        $instance->location = "Lagos";
        $properties = $instance->getRecord();
        $this->assertArrayHasKey('name', $properties);
        $this->assertEquals(1, $instance->save());
        $this->assertNotEmpty($instance->getRecord());
    }

    /**
     * Test attributes can be manipulated
    **/
    public function testAttributesCanBeManipulated()
    {
        $instance = new PotatoStub();
        $instance->email = 'otemuyiwa@example.com';
        $instance->password = 'password';
        $this->assertArrayHasKey('email', $instance->getRecord());
        $this->assertNotContains('otemuyiwa', $instance->getRecord());
        unset($instance->email);
        $this->assertFalse(isset($instance->email));
    }
}
