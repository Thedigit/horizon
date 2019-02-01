<?php

namespace Thedigit\Horizon\Tests\Feature;

use Mockery;
use Thedigit\Horizon\MasterSupervisor;
use Thedigit\Horizon\Tests\IntegrationTest;
use Thedigit\Horizon\Events\MasterSupervisorLooped;
use Thedigit\Horizon\Listeners\MonitorMasterSupervisorMemory;

class MonitorMasterSupervisorMemoryTest extends IntegrationTest
{
    public function test_supervisor_is_terminated_when_using_too_much_memory()
    {
        $monitor = new MonitorMasterSupervisorMemory;

        $master = Mockery::mock(MasterSupervisor::class);

        $master->shouldReceive('memoryUsage')->andReturn(192);
        $master->shouldReceive('terminate')->once()->with(12);

        $monitor->handle(new MasterSupervisorLooped($master));
    }

    public function test_supervisor_is_not_terminated_when_using_low_memory()
    {
        $monitor = new MonitorMasterSupervisorMemory;

        $master = Mockery::mock(MasterSupervisor::class);

        $master->shouldReceive('memoryUsage')->andReturn(16);
        $master->shouldReceive('terminate')->never();

        $monitor->handle(new MasterSupervisorLooped($master));
    }
}
