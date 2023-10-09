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

    public function testConsoleDeleteCommandSuccess(): void
    {
        $this->artisan('delete:data')->assertExitCode(0);
    }

    public function testConsoleDeletingDataFromDatabase(): void
    {
        $this->artisan('delete:data');

        $this->assertDatabaseCount('report', 0);
    }
}