<?php

namespace Thedigit\Horizon\Listeners;

use Thedigit\Horizon\Events\JobReserved;
use Thedigit\Horizon\Contracts\JobRepository;

class MarkJobAsReserved
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
     * @param  \Thedigit\Horizon\Events\JobReserved  $event
     * @return void
     */
    public function handle(JobReserved $event)
    {
        $this->jobs->reserved($event->connectionName, $event->queue, $event->payload);
    }
}
