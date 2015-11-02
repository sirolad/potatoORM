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
    public function testTableName()
    {
        $this->assertInternalType("string", Potato::tableName('Sirolad\Potato\User'));
    }

    public function testDestroy()
    {
        $mock = Mockery::mock('Sirolad\Test\PotatoStub');
        $mock->shouldReceive('destroy')->with(1)->andReturn(true);
    }

    public function testFind()
    {
        $mock = Mockery::mock('Sirolad\Test\PotatoStub');
        $mock->shouldReceive('find')->with(1)->andReturn('foo');
    }

    public function testNewInstanceCreatesInstanceWithoutAttributes()
    {
        $instance = new PotatoStub();
        $this->assertEmpty($instance->getRecord());
        $this->assertEquals(0, sizeof($instance->getRecord()));
        $this->assertEquals(0, count($instance->getRecord()));
        $this->assertArrayNotHasKey('id', $instance->getRecord());
    }

    public function testinstanceCanBeCreated()
    {
        $instance = new PotatoStub();
        $instance->name = "Tester";
        $instance->location = "M55";
        $properties = $instance->getRecord();
        $this->assertArrayHasKey('name', $properties);
        $this->assertEquals(1, $instance->save());
        $this->assertNotEmpty($instance->getRecord());
    }

    public function testAttributesCanBeManipulated()
    {
        $instance = new PotatoStub();
        $instance->email = 'dan@example.com';
        $instance->password = 'password';
        $this->assertArrayHasKey('email', $instance->getRecord());
        $this->assertNotContains('dan', $instance->getRecord());
        unset($instance->email);
        $this->assertFalse(isset($instance->email));
    }
}
