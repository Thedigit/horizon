<?php

namespace Thedigit\Horizon\MasterSupervisorCommands;

use Thedigit\Horizon\MasterSupervisor;
use Thedigit\Horizon\SupervisorOptions;
use Thedigit\Horizon\SupervisorProcess;
use Symfony\Component\Process\Process;

class AddSupervisor
{
    /**
     * Process the command.
     *
     * @param  \Thedigit\Horizon\MasterSupervisor  $master
     * @param  array  $options
     * @return void
     */
    public function process(MasterSupervisor $master, array $options)
    {
        $options = SupervisorOptions::fromArray($options);

        $master->supervisors[] = new SupervisorProcess(
            $options, $this->createProcess($master, $options), function ($type, $line) use ($master) {
                $master->output($type, $line);
            }
        );
    }

    /**
     * Create the Symfony process instance.
     *
     * @param  \Thedigit\Horizon\MasterSupervisor  $master
     * @param  \Thedigit\Horizon\SupervisorOptions  $options
     * @return \Symfony\Component\Process\Process
     */
    protected function createProcess(MasterSupervisor $master, SupervisorOptions $options)
    {
        $command = $options->toSupervisorCommand();

        return (new Process($command, $options->directory ?? base_path()))
                    ->setTimeout(null)
                    ->disableOutput();
    }
}
