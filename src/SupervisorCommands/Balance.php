<?php

namespace Thedigit\Horizon\SupervisorCommands;

use Thedigit\Horizon\Supervisor;

class Balance
{
    /**
     * Process the command.
     *
     * @param  \Thedigit\Horizon\Supervisor  $supervisor
     * @param  array  $options
     * @return void
     */
    public function process(Supervisor $supervisor, array $options)
    {
        $supervisor->balance($options);
    }
}
