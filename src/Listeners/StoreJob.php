<?php

namespace Thedigit\Horizon\Listeners;

use Thedigit\Horizon\Events\JobPushed;
use Thedigit\Horizon\Contracts\JobRepository;

class StoreJob
{
    /**
     * The job repository implementation.
     *
     * @var \Thedigit\Horizon\Contracts\JobRepository
     */
    public $jobs;

    /**
     * Create a new listener instance.
     *
     * @param  \Thedigit\Horizon\Contracts\JobRepository  $jobs
     * @return void
     */
    public function __construct(JobRepository $jobs)
    {
        $this->jobs = $jobs;
    }

    /**
     * Handle the event.
     *
     * @param  \Thedigit\Horizon\Events\JobPushed  $event
     * @return void
     */
    public function handle(JobPushed $event)
    {
        $this->jobs->pushed(
            $event->connectionName, $event->queue, $event->payload
        );
    }
}
