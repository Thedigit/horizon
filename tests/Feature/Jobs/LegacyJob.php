<?php

namespace Thedigit\Horizon\Tests\Feature\Jobs;

class LegacyJob
{
    public function fire($job, $data)
    {
        $job->delete();
    }
}
