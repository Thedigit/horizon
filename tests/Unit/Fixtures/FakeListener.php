<?php

namespace Thedigit\Horizon\Tests\Unit\Fixtures;

class FakeListener
{
    public function tags()
    {
        return [
            'listenerTag1',
            'listenerTag2',
        ];
    }
}
