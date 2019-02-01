<?php

namespace Thedigit\Horizon\Http\Controllers;

use Illuminate\Http\Request;
use Thedigit\Horizon\Contracts\JobRepository;

class RecentJobsController extends Controller
{
    /**
     * The job repository implementation.
     *
     * @var \Thedigit\Horizon\Contracts\JobRepository
     */
    public $jobs;

    /**
     * Create a new controller instance.
     *
     * @param  \Thedigit\Horizon\Contracts\JobRepository  $jobs
     * @return void
     */
    public function __construct(JobRepository $jobs)
    {
        parent::__construct();

        $this->jobs = $jobs;
    }

    /**
     * Get all of the recent jobs.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function index(Request $request)
    {
        $jobs = $this->jobs->getRecent($request->query('starting_at', -1))->map(function ($job) {
            $job->payload = json_decode($job->payload);

            return $job;
        })->values();

        return [
            'jobs' => $jobs,
            'total' => $this->jobs->countRecent(),
        ];
    }
}
