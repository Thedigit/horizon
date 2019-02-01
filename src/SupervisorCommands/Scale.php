<?php

namespace Thedigit\Horizon\SupervisorCommands;

use Thedigit\Horizon\Supervisor;

class Scale
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
        $supervisor->scale($options['scale']);
    }
}
