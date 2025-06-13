<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            DROP PROCEDURE IF EXISTS sp_read_events;

            CREATE PROCEDURE sp_read_events()
            BEGIN
                SELECT
                    id,
                    title,
                    description,
                    date,
                    location,
                    created_at,
                    updated_at
                FROM events
                ORDER BY date DESC;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_read_events;');
    }
};
