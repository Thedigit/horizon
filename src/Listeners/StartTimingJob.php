<?php

namespace Thedigit\Horizon\Listeners;

use Thedigit\Horizon\Stopwatch;
use Thedigit\Horizon\Events\JobReserved;

class StartTimingJob
{
    /**
     * The stopwatch instance.
     *
     * @var \Thedigit\Horizon\Stopwatch
     */
    public $watch;

    /**
     * Create a new listener instance.
     *
     * @param  \Thedigit\Horizon\Stopwatch  $watch
     * @return void
     */
    public function __construct(Stopwatch $watch)
    {
        $this->watch = $watch;
    }

    /**
     * Handle the event.
     *
     * @param  \Thedigit\Horizon\Events\JobReserved  $event
     * @return void
     */
    public function handle(JobReserved $event)
    {
        $this->watch->start($event->payload->id());
    }
}
