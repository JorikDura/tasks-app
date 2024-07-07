<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class () extends Migration {
    public function up(): void
    {
        DB::statement(
            "
        CREATE INDEX IF NOT EXISTS task_cancelled_status_idx ON tasks (status)
            WHERE status = 5;
        "
        );
    }

    public function down(): void
    {
        DB::statement("DROP INDEX IF EXISTS task_cancelled_status_idx;");
    }
};
