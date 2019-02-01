<?php

namespace Thedigit\Horizon\Listeners;

use Cake\Chronos\Chronos;
use Thedigit\Horizon\Events\MasterSupervisorLooped;
use Thedigit\Horizon\Contracts\SupervisorRepository;
use Thedigit\Horizon\Contracts\MasterSupervisorRepository;

class ExpireSupervisors
{
    /**
     * Handle the event.
     *
     * @param  \Thedigit\Horizon\Events\MasterSupervisorLooped  $event
     * @return void
     */
    public function handle(MasterSupervisorLooped $event)
    {
        app(MasterSupervisorRepository::class)->flushExpired();

        app(SupervisorRepository::class)->flushExpired();
    }
}
