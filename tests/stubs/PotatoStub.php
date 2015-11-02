<?php

namespace Sirolad\Test;

use Sirolad\Potato;

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

    public function find($id)
    {
        return 'foo';
    }
}
