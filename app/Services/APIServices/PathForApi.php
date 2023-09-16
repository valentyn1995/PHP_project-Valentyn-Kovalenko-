<?php

declare(strict_types=1);

namespace App\Services\APIServices;

class PathForApi
{
    public function pathFormation()
    {
        return base_path('files_for_report');
    }
}