<?php

namespace Thedigit\Horizon\Listeners;

use Thedigit\Horizon\Events\JobsMigrated;
use Thedigit\Horizon\Contracts\JobRepository;

class MarkJobsAsMigrated
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
     * @param  \Thedigit\Horizon\Events\JobsMigrated  $event
     * @return void
     */
    public function handle(JobsMigrated $event)
    {
        $this->jobs->migrated($event->connectionName, $event->queue, $event->payloads);
    }
}
