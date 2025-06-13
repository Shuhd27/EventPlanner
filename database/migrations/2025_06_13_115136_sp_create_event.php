<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('
            DROP PROCEDURE IF EXISTS sp_create_event;

            CREATE PROCEDURE sp_create_event (
                IN p_title VARCHAR(255),
                IN p_description TEXT,
                IN p_date DATE,
                IN p_location VARCHAR(255)
            )
            BEGIN
                INSERT INTO events (title, description, date, location, created_at, updated_at)
                VALUES (p_title, p_description, p_date, p_location, NOW(), NOW());
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_create_event;');
    }
};
