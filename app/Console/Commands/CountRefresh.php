<?php

namespace App\Console\Commands;

use App\Services\CountService;
use Illuminate\Console\Command;

class CountRefresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'count:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(CountService $countService)
    {
        $count = $countService->getCount();
        $this->info('Count has updated' . json_encode($count));
        return self::SUCCESS;
    }
}
