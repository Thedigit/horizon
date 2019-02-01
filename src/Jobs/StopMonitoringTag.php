<?php

namespace Thedigit\Horizon\Jobs;

use Thedigit\Horizon\Contracts\JobRepository;
use Thedigit\Horizon\Contracts\TagRepository;

class StopMonitoringTag
{
    /**
     * The tag to stop monitoring.
     *
     * @var string
     */
    public $tag;

    /**
     * Create a new job instance.
     *
     * @param  string  $tag
     * @return void
     */
    public function __construct($tag)
    {
        $this->tag = $tag;
    }

    /**
     * Execute the job.
     *
     * @param  \Thedigit\Horizon\Contracts\JobRepository  $jobs
     * @param  \Thedigit\Horizon\Contracts\TagRepository  $tags
     * @return void
     */
    public function handle(JobRepository $jobs, TagRepository $tags)
    {
        $tags->stopMonitoring($this->tag);

        $jobs->deleteMonitored($tags->jobs($this->tag));

        $tags->forget($this->tag);
    }
}
