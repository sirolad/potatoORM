<?php
namespace Sirolad\Test;

use Mockery;
use Sirolad\Libraries\Formatter;

class FormatterTest extends \PHPUnit_Framework_TestCase
{
    public function testdecideS()
    {
        $this->assertEquals('user', Formatter::decideS('users'));
        $this->assertEquals('cars', Formatter::decideS('car'));
        $this->assertNotEquals('cars', Formatter::decideS('cars'));
    }

    public function testGenerateUnnamedPlaceholders()
    {
        $this->assertEquals(['?', '?', '?', '?'], Formatter::generateUnnamedPlaceholders(['username', 'password', 'email', 'date_created']));
        $this->assertNotEquals(['?', '?', '?', '?'], Formatter::generateUnnamedPlaceholders(['username', 'password', 'email']));
    }

    public function testTokenize()
    {
        $this->assertEquals('username,password,email', Formatter::tokenize('username,password,email', ','));
    }

    public function testMakeAssociativeArray()
    {
        $this->assertEquals(["token=NULL", "token_expire='today'"], Formatter::makeAssociativeArray(['' => '', 'token' => null, 'token_expire' => 'today']));
    }
}
