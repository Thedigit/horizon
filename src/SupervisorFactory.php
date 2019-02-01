<?php

namespace Thedigit\Horizon;

class SupervisorFactory
{
    /**
     * Create a new supervisor instance.
     *
     * @param  \Thedigit\Horizon\SupervisorOptions  $options
     * @return \Thedigit\Horizon\Supervisor
     */
    public function make(SupervisorOptions $options)
    {
        return new Supervisor($options);
    }
}
