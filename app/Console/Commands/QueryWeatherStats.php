<?php

namespace App\Console\Commands;

use App\Services\QueryService;
use Illuminate\Console\Command;

class QueryWeatherStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'query:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Query from all external services';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(QueryService $queryService)
    {   
        $this->queryService = $queryService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Query started...');

        try{
            $this->queryService->queryAll();
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
            return 1;
        }

        $this->info('Query succesful!');

        return 0;
    }
}
