<?php

namespace Thedigit\Horizon\Tests\Feature\Jobs;

class BasicJob
{
    public function handle()
    {
        //
    }

    public function tags()
    {
        return ['first', 'second'];
    }
}
