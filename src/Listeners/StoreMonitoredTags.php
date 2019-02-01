<?php

namespace Thedigit\Horizon\Listeners;

use Thedigit\Horizon\Events\JobPushed;
use Thedigit\Horizon\Contracts\TagRepository;

class StoreMonitoredTags
{
    /**
     * The tag repository implementation.
     *
     * @var \Thedigit\Horizon\Contracts\TagRepository
     */
    public $tags;

    /**
     * Create a new listener instance.
     *
     * @param  \Thedigit\Horizon\Contracts\TagRepository  $tags
     * @return void
     */
    public function __construct(TagRepository $tags)
    {
        $this->tags = $tags;
    }

    /**
     * Handle the event.
     *
     * @param  \Thedigit\Horizon\Events\JobPushed  $event
     * @return void
     */
    public function handle(JobPushed $event)
    {
        $monitoring = $this->tags->monitored($event->payload->tags());

        if (! empty($monitoring)) {
            $this->tags->add($event->payload->id(), $monitoring);
        }
    }
}
