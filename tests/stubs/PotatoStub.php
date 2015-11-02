<?php

/**
 * @package A simple ORM that performs basic CRUD operations
 * @author Surajudeen AKANDE <surajudeen.akande@andela.com>
 * @license MIT <https://opensource.org/licenses/MIT>
 * @link http://www.github.com/andela-sakande
 * */
namespace Sirolad\Test;

use Sirolad\Potato;

/**
 * Stub class to test main class
 * */
class PotatoStub extends Potato
{
    /**
     * @var $id int
     * @return bool
     * */
    public function destroy($id)
    {
        return true;
    }

    /**
     * @var $id int
     * @return string
     * */
    public function find($id)
    {
        return 'foo';
    }
}
