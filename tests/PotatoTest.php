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
}
