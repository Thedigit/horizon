<?php

namespace Thedigit\Horizon\Console;

use Thedigit\Horizon\Lock;
use Illuminate\Console\Command;
use Thedigit\Horizon\Contracts\MetricsRepository;

class SnapshotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'horizon:snapshot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store a snapshot of the queue metrics';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (app(Lock::class)->get('metrics:snapshot', 300)) {
            app(MetricsRepository::class)->snapshot();

            $this->info('Metrics snapshot stored successfully.');
        }
    }
}
