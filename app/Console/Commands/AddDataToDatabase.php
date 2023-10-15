<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Services\ConsoleServices\CreateDataService;

class AddDataToDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add data to database';

    public function __construct(private CreateDataService $createDataService)
    {
        parent::__construct();
    }
    
    public function handle(Request $request): void
    {
        $this->createDataService->create($request);

        $this->info('Data was create');
    }
}
