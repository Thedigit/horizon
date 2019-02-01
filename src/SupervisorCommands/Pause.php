<?php

namespace Thedigit\Horizon\SupervisorCommands;

use Thedigit\Horizon\Contracts\Pausable;

class Pause
{
    /**
     * Process the command.
     *
     * @param  \Thedigit\Horizon\Contracts\Pausable  $pausable
     * @return void
     */
    public function process(Pausable $pausable)
    {
        $pausable->pause();
    }
}
