<?php

namespace Thedigit\Horizon\SupervisorCommands;

use Thedigit\Horizon\Contracts\Restartable;

class Restart
{
    /**
     * Process the command.
     *
     * @param  \Thedigit\Horizon\Contracts\Restartable  $restartable
     * @return void
     */
    public function process(Restartable $restartable)
    {
        $restartable->restart();
    }
}
