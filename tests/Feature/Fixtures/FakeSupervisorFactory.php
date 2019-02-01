<?php

namespace Thedigit\Horizon\Tests\Feature\Fixtures;

use Thedigit\Horizon\Tests\Feature\Fakes\SupervisorWithFakeMonitor;

class FakeSupervisorFactory
{
    public $supervisor;

    public function make($options)
    {
        return $this->supervisor = new SupervisorWithFakeMonitor($options);
    }
}
