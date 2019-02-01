<?php

namespace Thedigit\Horizon\Tests\Feature;

use Thedigit\Horizon\JobId;
use Thedigit\Horizon\Tests\IntegrationTest;
use Laravel\Facades\Config;
use Illuminate\Support\Facades\Redis;
use Thedigit\Horizon\Horizon;

class PrefixTest extends IntegrationTest
{
    public function test_prefix_can_be_configured()
    {
        config(['horizon.prefix' => 'custom:']);

        Horizon::use('default');

        $this->assertEquals('custom:', config('database.redis.horizon.options.prefix'));
    }
}
