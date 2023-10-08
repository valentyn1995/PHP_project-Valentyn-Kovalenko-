<?php

declare(strict_types=1);

namespace Tests\Feature\Console;

use Tests\TestCase;
use Database\Seeders\TestReportSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteDataFromDatabaseTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(TestReportSeeder::class);
    }

    public function testConsoleDeleteCommandSuccess()
    {
        $this->artisan('delete:data')->assertExitCode(0);
    }

    public function testConsoleDeletingDataFromDatabase()
    {
        $this->artisan('delete:data');

        $this->assertDatabaseCount('report', 0);
    }
}