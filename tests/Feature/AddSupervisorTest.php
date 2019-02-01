<?php

namespace Vzool\Horizon\Tests\Feature;

use Vzool\Horizon\PhpBinary;
use Vzool\Horizon\MasterSupervisor;
use Vzool\Horizon\SupervisorOptions;
use Vzool\Horizon\Tests\IntegrationTest;
use Vzool\Horizon\Contracts\HorizonCommandQueue;
use Vzool\Horizon\MasterSupervisorCommands\AddSupervisor;

class AddSupervisorTest extends IntegrationTest
{
    public function test_add_supervisor_command_creates_new_supervisor_on_master_process()
    {
        $master = new MasterSupervisor;
        $phpBinary = PhpBinary::path();

        $master->loop();

        new AddSupervisor;
        resolve(HorizonCommandQueue::class)->push($master->commandQueue(), AddSupervisor::class, (new SupervisorOptions('my-supervisor', 'redis'))->toArray());

        $this->assertCount(0, $master->supervisors);

        $master->loop();

        $this->assertCount(1, $master->supervisors);

        $this->assertEquals(
            'exec '.$phpBinary.' artisan horizon:supervisor my-supervisor redis --delay=0 --memory=128 --queue="default" --sleep=3 --timeout=60 --tries=0 --balance=off --max-processes=1 --min-processes=1',
            $master->supervisors->first()->process->getCommandLine()
        );
    }
}
