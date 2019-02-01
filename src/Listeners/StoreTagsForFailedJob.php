<?php

namespace Thedigit\Horizon\Listeners;

use Thedigit\Horizon\Events\JobFailed;
use Thedigit\Horizon\Contracts\TagRepository;

class StoreTagsForFailedJob
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
     * @param  \Thedigit\Horizon\Events\JobFailed  $event
     * @return void
     */
    public function handle(JobFailed $event)
    {
        $tags = collect($event->payload->tags())->map(function ($tag) {
            return 'failed:'.$tag;
        })->all();

        $this->tags->addTemporary(
            2880, $event->payload->id(), $tags
        );
    }
}
