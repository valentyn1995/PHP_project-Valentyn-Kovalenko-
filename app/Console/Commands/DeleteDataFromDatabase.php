<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ConsoleServices\DeleteDataService;

class DeleteDataFromDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete data from database';

    /**
     * Execute the console command.
     */
    public function __construct(private DeleteDataService $deleteDataService)
    {
        parent::__construct();
    }
    public function handle(): void
    {
        $this->deleteDataService->delete();

        $this->info('Data was delete');
    }
}
