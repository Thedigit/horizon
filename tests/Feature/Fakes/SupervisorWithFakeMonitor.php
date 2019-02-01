<?php

namespace Thedigit\Horizon\Tests\Feature\Fakes;

use Thedigit\Horizon\Supervisor;

class SupervisorWithFakeMonitor extends Supervisor
{
    public $monitoring = false;

    /**
     * {@inheritdoc}
     */
    public function monitor()
    {
        $this->monitoring = true;
    }
}
