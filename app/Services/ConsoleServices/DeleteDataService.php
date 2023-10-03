<?php

declare(strict_types=1);

namespace App\Services\ConsoleServices;

use App\Models\Report;

class DeleteDataService
{
    public function delete(): void
    {
        Report::truncate();
    }
}