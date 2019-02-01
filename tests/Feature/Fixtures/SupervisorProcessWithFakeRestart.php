<?php

namespace Thedigit\Horizon\Tests\Feature\Fixtures;

use Thedigit\Horizon\SupervisorProcess;

class SupervisorProcessWithFakeRestart extends SupervisorProcess
{
    public $wasRestarted = false;

    public function restart()
    {
        $this->wasRestarted = true;
    }
}
