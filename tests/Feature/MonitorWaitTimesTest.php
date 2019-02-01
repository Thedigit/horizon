<?php

namespace Thedigit\Horizon\Tests\Feature;

use Mockery;
use Cake\Chronos\Chronos;
use Thedigit\Horizon\Supervisor;
use Illuminate\Support\Facades\Event;
use Thedigit\Horizon\WaitTimeCalculator;
use Thedigit\Horizon\Tests\IntegrationTest;
use Thedigit\Horizon\Events\LongWaitDetected;
use Thedigit\Horizon\Events\SupervisorLooped;
use Thedigit\Horizon\Listeners\MonitorWaitTimes;
use Thedigit\Horizon\Contracts\MetricsRepository;
use Illuminate\Contracts\Redis\Factory as RedisFactory;

class MonitorWaitTimesTest extends IntegrationTest
{
    public function test_queues_with_long_waits_are_found()
    {
        Event::fake();

        $redis = Mockery::mock(RedisFactory::class);
        $redis->shouldReceive('setnx')->with('monitor:time-to-clear', 1)->andReturn(1);
        $redis->shouldReceive('expire')->with('monitor:time-to-clear', 60);

        $calc = Mockery::mock(WaitTimeCalculator::class);
        $calc->shouldReceive('calculate')->andReturn([
            'redis:test-queue' => 10,
            'redis:test-queue-2' => 80,
        ]);
        $this->app->instance(WaitTimeCalculator::class, $calc);

        $listener = new MonitorWaitTimes(resolve(MetricsRepository::class), $redis);
        $listener->lastMonitoredAt = Chronos::now()->subDays(1);

        $listener->handle(new SupervisorLooped(Mockery::mock(Supervisor::class)));

        Event::assertDispatched(LongWaitDetected::class, function ($event) {
            return $event->connection == 'redis' && $event->queue == 'test-queue-2';
        });
    }
}
