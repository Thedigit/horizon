<?php

namespace Thedigit\Horizon\Tests\Feature\Fakes;

use Thedigit\Horizon\MasterSupervisor;

class MasterSupervisorWithFakeExit extends MasterSupervisor
{
    public $exited = false;

    /**
     * End the current PHP process.
     *
     * @param  int  $status
     * @return void
     */
    protected function exitProcess($status = 0)
    {
        $this->exited = true;
    }
}
