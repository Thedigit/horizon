<?php

namespace Thedigit\Horizon\Tests\Unit;

use Mockery;
use Thedigit\Horizon\Supervisor;
use Thedigit\Horizon\Tests\UnitTest;
use Thedigit\Horizon\SupervisorCommands\Scale;

class ScaleCommandTest extends UnitTest
{
    public function test_scale_command_tells_supervisor_to_scale()
    {
        $supervisor = Mockery::mock(Supervisor::class);
        $supervisor->shouldReceive('scale')->once()->with(3);
        $scale = new Scale;
        $scale->process($supervisor, ['scale' => 3]);
    }
}
