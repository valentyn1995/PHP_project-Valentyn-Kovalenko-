<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;

class TestReportSeeder extends Seeder
{
    public function run(): void
    {
        Report::insert(
            [
                [
                    'drivers_code' => 'LHM',
                    'name' => 'Lewis Hamilton',
                    'team' => 'MERCEDES',
                    'lap_time' => '00:53:12.460000',
                ],
                [
                    'drivers_code' => 'EOF',
                    'name' => 'Esteban Ocon',
                    'team' => 'FORCE INDIA MERCEDES',
                    'lap_time' => '00:54:13.028000',
                ],
                [
                    'drivers_code' => 'DRR',
                    'name' => 'Daniel Ricciardo',
                    'team' => 'RED BULL RACING TAG HEUER',
                    'lap_time' => '00:57:12.013000',
                ],
                [
                    'drivers_code' => 'KMH',
                    'name' => 'Kevin Magnussen',
                    'team' => 'HAAS FERRARI',
                    'lap_time' => '01:01:13.393000',
                ]
            ]
        );
    }
}