<?php

namespace Thedigit\Horizon\Listeners;

use Thedigit\Horizon\Events\JobReleased;
use Thedigit\Horizon\Contracts\JobRepository;

class MarkJobAsReleased
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
     * @param  \Thedigit\Horizon\Events\JobReleased  $event
     * @return void
     */
    public function handle(JobReleased $event)
    {
        $this->jobs->released($event->connectionName, $event->queue, $event->payload);
    }
}
